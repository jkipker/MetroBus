<?php
	
class FrmProPost {
	public static function save_post( $action, $entry, $form ) {
		if ( $entry->post_id ) {
			$post = get_post( $entry->post_id, ARRAY_A );
			unset( $post['post_content'] );
			$new_post = self::setup_post($action, $entry, $form );
			self::insert_post( $entry, $new_post, $post, $form, $action );
		} else {
			self::create_post( $entry, $form, $action );
		}
	}

	public static function create_post( $entry, $form, $action = false ) {
		global $wpdb;

		$entry_id = is_object($entry) ? $entry->id : $entry;
		$form_id = is_object($form) ? $form->id : $form;

		if ( ! $action ) {
			$action = FrmFormAction::get_action_for_form( $form_id, 'wppost', 1 );

			if ( ! $action ) {
				return;
			}
		}

		$post = self::setup_post($action, $entry, $form);
		$post['post_type'] = $action->post_content['post_type'];

		$status = ( isset($post['post_status']) && ! empty($post['post_status']) ) ? true : false;

		if ( ! $status && $action && in_array($action->post_content['post_status'], array( 'pending', 'publish')) ) {
			$post['post_status'] = $action->post_content['post_status'];
		}

		if ( isset( $action->post_content['display_id'] ) && $action->post_content['display_id'] ) {
			$post['post_custom']['frm_display_id'] = $action->post_content['display_id'];
		} else if ( ! is_numeric( $action->post_content['post_content'] ) ) {
			// Do not set frm_display_id if the content is mapped to a single field

			//check for auto view and set frm_display_id - for reverse compatibility
			$display = FrmProDisplay::get_auto_custom_display( compact('form_id', 'entry_id') );
			if ( $display ) {
				$post['post_custom']['frm_display_id'] = $display->ID;
			}
		}

		$post_id = self::insert_post( $entry, $post, array(), $form, $action );
		return $post_id;
	}

	public static function insert_post( $entry, $new_post, $post, $form = false, $action = false ) {
		if ( ! $action ) {
			$action = FrmFormAction::get_action_for_form( $form->id, 'wppost', 1 );

			if ( ! $action ) {
				return;
			}
		}

		$post_fields = self::get_post_fields( $new_post, 'insert_post' );

		$editing = true;
		if ( empty($post) ) {
			$editing = false;
			$post = array();
		}

		foreach ( $post_fields as $post_field ) {
			if ( isset($new_post[$post_field]) ) {
				$post[$post_field] = $new_post[$post_field];
			}
			unset($post_field);
		}
		unset($post_fields);

		$dyn_content = '';
		self::post_value_overrides( $post, $new_post, $editing, $form, $entry, $dyn_content );

		$post_ID = wp_insert_post( $post );

		if ( is_wp_error( $post_ID ) || empty($post_ID) ) {
			return;
		}

		self::save_taxonomies( $new_post, $post_ID );
		self::link_post_attachments( $post_ID, $editing );
		self::save_post_meta( $new_post, $post_ID );
		self::save_post_id_to_entry($post_ID, $entry, $editing);
		// Make sure save_post_id_to_entry stays above save_dynamic_content because
		// save_dynamic_content needs updated entry object from save_post_id_to_entry
		self::save_dynamic_content( $post, $post_ID, $dyn_content, $form, $entry );
		self::delete_duplicated_meta( $action, $entry );

		return $post_ID;
	}

	public static function destroy_post( $entry_id, $entry = false ) {
		global $wpdb;

		if ( $entry ) {
			$post_id = $entry->post_id;
		} else {
			$post_id = FrmDb::get_var( $wpdb->prefix . 'frm_items', array( 'id' => $entry_id ), 'post_id' );
		}

		// delete child entries
		$child_entries = FrmDb::get_col( $wpdb->prefix .'frm_items', array( 'parent_item_id' => $entry_id ) );
		foreach ( $child_entries as $child_entry ) {
			FrmEntry::destroy( $child_entry );
		}

		// Remove hook to make things consistent
		// Due to a WP bug, this hook won't be used for parent entry when there are child entries
		remove_action( 'frm_before_destroy_entry', 'FrmProFormActionsController::trigger_delete_actions', 20, 2 );

		// Trigger delete actions for parent entry
		FrmProFormActionsController::trigger_delete_actions( $entry_id, $entry );

		if ( $post_id ) {
			wp_delete_post( $post_id );
		}
	}

	/**
	 * Insert all post variables into the post array
	 * @return array
	 */
	public static function setup_post( $action, $entry, $form ) {
		$temp_fields = FrmField::get_all_for_form($form->id);
		$fields = array();
		foreach ( $temp_fields as $f ) {
			$fields[$f->id] = $f;
			unset($f);
		}
		unset($temp_fields);

		$new_post = array(
			'post_custom' => array(),
			'taxonomies'    => array(),
			'post_category' => array(),
		);

		self::populate_post_author( $new_post );
		self::populate_post_fields( $action, $entry, $new_post );
		self::populate_custom_fields( $action, $entry, $fields, $new_post );
		self::populate_taxonomies( $action, $entry, $fields, $new_post );

		// Reverse compatability for custom code
		self::populate_from_custom_code($new_post);

		$new_post = apply_filters('frm_new_post', $new_post, compact('form', 'action', 'entry'));

		return $new_post;
	}

	private static function populate_post_author( &$post ) {
		$new_author = FrmAppHelper::get_post_param( 'frm_user_id', 0, 'absint' );
		if ( ! isset( $post['post_author'] ) && $new_author ) {
			$post['post_author'] = $new_author;
		}
	}

	private static function populate_post_fields( $action, $entry, &$new_post ) {
		$post_fields = self::get_post_fields( $new_post, 'post_fields' );

		foreach ( $post_fields as $setting_name ) {
			if ( ! is_numeric( $action->post_content[$setting_name] ) ) {
				continue;
			}

			$new_post[$setting_name] = isset( $entry->metas[$action->post_content[$setting_name]]) ? $entry->metas[$action->post_content[$setting_name]] : '';

			if ( 'post_date' == $setting_name ) {
				$new_post[$setting_name] = FrmProAppHelper::maybe_convert_to_db_date( $new_post[$setting_name], 'Y-m-d H:i:s' );
			}

			unset( $setting_name );
		}
	}

	/**
	 * Make sure all post fields get included in the new post.
	 * Add the fields dynamically if they are included in the post.
	 *
	 * @since 2.0.2
	 */
	private static function get_post_fields( $new_post, $function ) {
		$post_fields = array(
			'post_content', 'post_excerpt', 'post_title',
			'post_name', 'post_date', 'post_status',
			'post_password',
		);

		if ( $function == 'insert_post' ) {
			$post_fields = array_merge( $post_fields, array( 'post_author', 'post_type', 'post_category', 'post_parent' ) );
			$extra_fields = array_keys( $new_post );
			$exclude_fields = array( 'post_custom', 'taxonomies', 'post_category' );
			$extra_fields = array_diff( $extra_fields, $exclude_fields, $post_fields );
			$post_fields = array_merge( $post_fields, $extra_fields );
		}

		return $post_fields;
	}

	/**
	 * Add custom fields to the post array
	 */
	private static function populate_custom_fields( $action, $entry, $fields, &$new_post ) {
		// populate custom fields
		foreach ( $action->post_content['post_custom_fields'] as $custom_field ) {
			if ( empty($custom_field['field_id']) || empty($custom_field['meta_name']) || ! isset($fields[$custom_field['field_id']]) ) {
				continue;
			}

			$value = isset($entry->metas[$custom_field['field_id']]) ? $entry->metas[$custom_field['field_id']] : '';

			if ( $fields[$custom_field['field_id']]->type == 'date' ) {
				$value = FrmProAppHelper::maybe_convert_to_db_date($value);
			}

			if ( isset($new_post['post_custom'][$custom_field['meta_name']]) ) {
				$new_post['post_custom'][$custom_field['meta_name']] = (array) $new_post['post_custom'][$custom_field['meta_name']];
				$new_post['post_custom'][$custom_field['meta_name']][] = $value;
			} else {
				$new_post['post_custom'][$custom_field['meta_name']] = $value;
			}

			unset($value);
		}
	}

	private static function populate_taxonomies( $action, $entry, $fields, &$new_post ) {
		foreach ( $action->post_content['post_category'] as $taxonomy ) {
			if ( empty($taxonomy['field_id']) || empty($taxonomy['meta_name']) ) {
				continue;
			}

			$tax_type = ( isset($taxonomy['meta_name']) && ! empty($taxonomy['meta_name']) ) ? $taxonomy['meta_name'] : 'frm_tag';
			$value = isset($entry->metas[$taxonomy['field_id']]) ? $entry->metas[$taxonomy['field_id']] : '';

			if ( $fields[$taxonomy['field_id']]->type == 'tag' ) {
				$value = trim($value);
				$value = array_map('trim', explode(',', $value));

				if ( is_taxonomy_hierarchical($tax_type) ) {
					//create the term or check to see if it exists
					$terms = array();
					foreach ( $value as $v ) {
						$term_id = term_exists($v, $tax_type);

						// create new terms if they don't exist
						if ( ! $term_id ) {
							$term_id = wp_insert_term($v, $tax_type);
						}

						if ( $term_id && is_array($term_id) )  {
							$term_id = $term_id['term_id'];
						}

						if ( is_numeric($term_id) ) {
							$terms[$term_id] = $v;
						}

						unset($term_id, $v);
					}

					$value = $terms;
					unset($terms);
				}

				if ( isset($new_post['taxonomies'][$tax_type]) ) {
					$new_post['taxonomies'][$tax_type] += (array) $value;
				} else {
					$new_post['taxonomies'][$tax_type] = (array) $value;
				}
			} else {
				$value = (array) $value;

				// change text to numeric ids while importing
				if ( defined('WP_IMPORTING') ) {
					foreach ( $value as $k => $val ) {
						if ( empty($val) ) {
							continue;
						}

						$term = term_exists($val, $fields[$taxonomy['field_id']]->field_options['taxonomy']);
						if ( $term ) {
							$value[$k] = is_array($term) ? $term['term_id'] : $term;
						}

						unset($k, $val, $term);
					}
				}

				if ( 'category' == $tax_type ) {
					if ( ! empty($value) ) {
						$new_post['post_category'] = array_merge( $new_post['post_category'], $value );
					}
				} else {
					$new_value = array();
					foreach ( $value as $val ) {
						if ( $val == 0 ) {
							continue;
						}

						$term = get_term($val, $fields[$taxonomy['field_id']]->field_options['taxonomy']);

						if ( $term && ! isset($term->errors) ) {
							$new_value[$val] = $term->name;
						} else {
							$new_value[$val] = $val;
						}

						unset($term);
					}

					self::fill_taxonomies($new_post['taxonomies'], $tax_type, $new_value);
				}
			}
		}
	}

	private static function populate_from_custom_code( &$new_post ) {
		if ( isset($_POST['frm_wp_post']) ) {
			_deprecated_argument( 'frm_wp_post', '2.0', 'Use <code>frm_new_post</code> filter instead.' );
			foreach ( (array) $_POST['frm_wp_post']  as $key => $value ) {
				list($field_id, $meta_name) = explode('=', $key);
				if ( ! empty($meta_name) ) {
					$new_post[$meta_name] = $value;
				}

				unset($field_id, $meta_name, $key, $value);
			}
		}

		if ( isset($_POST['frm_wp_post_custom']) ) {
			_deprecated_argument( 'frm_wp_post_custom', '2.0', 'Use <code>frm_new_post</code> filter instead.' );
			foreach ( (array) $_POST['frm_wp_post_custom']  as $key => $value ) {
				list($field_id, $meta_name) = explode('=', $key);
				if ( ! empty($meta_name) ) {
					$new_post['post_custom'][$meta_name] = $value;
				}

				unset($field_id, $meta_name, $key, $value);
			}
		}

		if ( isset($_POST['frm_tax_input']) ) {
			_deprecated_argument( 'frm_tax_input', '2.0', 'Use <code>frm_new_post</code> filter instead.' );
			foreach ( (array) $_POST['frm_tax_input']  as $key => $value ) {
				self::fill_taxonomies($new_post['taxonomies'], $key, $value);
				unset($key, $value);
			}
		}
	}

	private static function fill_taxonomies(&$taxonomies, $tax_type, $new_value) {
		if ( isset($taxonomies[$tax_type]) ) {
			foreach ( (array) $new_value as $new_key => $new_name ) {
				$taxonomies[$tax_type][$new_key] = $new_name;
			}
		} else {
			$taxonomies[$tax_type] = $new_value;
		}
	}

    /**
     * Override the post content and date format
     */
    private static function post_value_overrides( &$post, $new_post, $editing, $form, $entry, &$dyn_content ) {
        //if empty post content and auto display, then save compiled post content
        $display_id = ( $editing ) ? get_post_meta($post['ID'], 'frm_display_id', true) : ( isset($new_post['post_custom']['frm_display_id']) ? $new_post['post_custom']['frm_display_id'] : 0 );

        if ( ! isset($post['post_content']) && $display_id ) {
            $display = FrmProDisplay::getOne( $display_id, false, true);
			if ( $display ) {
				$dyn_content = ( 'one' == $display->frm_show_count ) ? $display->post_content : $display->frm_dyncontent;
				$post['post_content'] = apply_filters( 'frm_content', $dyn_content, $form, $entry );
			}
        }

        if ( isset($post['post_date']) && ! empty($post['post_date']) && ( ! isset($post['post_date_gmt']) || $post['post_date_gmt'] == '0000-00-00 00:00:00' ) ) {
            // set post date gmt if post date is set
            $post['post_date_gmt'] = get_gmt_from_date($post['post_date']);
		}
    }
	
    /**
     * Add taxonomies after save in case user doesn't have permissions
     */
    private static function save_taxonomies( $new_post, $post_ID ) {
    	foreach ( $new_post['taxonomies'] as $taxonomy => $tags ) {
			// If setting hierarchical taxonomy or post_format, use IDs
			if ( is_taxonomy_hierarchical($taxonomy) || $taxonomy == 'post_format' ) {
    			$tags = array_keys($tags);
    		}

            wp_set_post_terms( $post_ID, $tags, $taxonomy );

    		unset($taxonomy, $tags);
        }
    }

	private static function link_post_attachments( $post_ID, $editing ) {
		global $frm_vars, $wpdb;

		$exclude_attached = array();
		if ( isset($frm_vars['media_id']) && ! empty($frm_vars['media_id']) ) {

			foreach ( (array) $frm_vars['media_id'] as $media_id ) {
				$exclude_attached = array_merge($exclude_attached, (array) $media_id);

				if ( is_array($media_id) ) {
					$attach_string = array_filter( $media_id );
					if ( ! empty($attach_string) ) {
						$where = array( 'post_type' => 'attachment', 'ID' => $attach_string );
						FrmDb::get_where_clause_and_values( $where );
						array_unshift( $where['values'], $post_ID );

						$wpdb->query( $wpdb->prepare( 'UPDATE ' . $wpdb->posts . ' SET post_parent = %d' . $where['where'], $where['values'] ) );

						foreach ( $media_id as $m ) {
							delete_post_meta( $m, '_frm_file' );
							clean_attachment_cache( $m );
							unset($m);
						}
					}
				} else {
					$wpdb->update( $wpdb->posts, array( 'post_parent' => $post_ID ), array( 'ID' => $media_id, 'post_type' => 'attachment' ) );
					delete_post_meta( $media_id, '_frm_file' );
					clean_attachment_cache( $media_id );
				}
			}
		}

		self::unlink_post_attachments($post_ID, $editing, $exclude_attached);
	}

	private static function unlink_post_attachments( $post_ID, $editing, $exclude_attached ) {
		if ( ! $editing ) {
			return;
		}

		$args = array(
			'post_type' => 'attachment', 'numberposts' => -1,
			'post_status' => null, 'post_parent' => $post_ID,
			'exclude' => $exclude_attached,
		);

		global $wpdb;

		$attachments = get_posts( $args );
		foreach ( $attachments as $attachment ) {
			$wpdb->update( $wpdb->posts, array( 'post_parent' => null ), array( 'ID' => $attachment->ID ) );
			update_post_meta( $media_id, '_frm_file', 1 );
		}
	}

	private static function save_post_meta( $new_post, $post_ID ) {
		foreach ( $new_post['post_custom'] as $post_data => $value ) {
			if ( $value == '' ) {
				delete_post_meta($post_ID, $post_data);
			} else {
				update_post_meta($post_ID, $post_data, $value);
			}

			unset($post_data, $value);
		}

		global $user_ID;
		update_post_meta( $post_ID, '_edit_last', $user_ID );
	}

	/**
	 * save post_id with the entry
	 * If entry was updated, get updated entry object
	 */
	private static function save_post_id_to_entry($post_ID, &$entry, $editing) {
		if ( $editing ) {
			return;
		}

		global $wpdb;
		$updated = $wpdb->update( $wpdb->prefix .'frm_items', array( 'post_id' => $post_ID), array( 'id' => $entry->id ) );
		if ( $updated ) {
			wp_cache_delete( $entry->id, 'frm_entry' );
			wp_cache_delete( $entry->id .'_nometa', 'frm_entry' );
			// Save new post ID for later use
			$entry->post_id = $post_ID;
		}
	}

	/**
	 * update dynamic content after all post fields are updated
	 */
	private static function save_dynamic_content( $post, $post_ID, $dyn_content, $form, $entry ) {
		if ( $dyn_content == '' ) {
			return;
		}

		$new_content = apply_filters( 'frm_content', $dyn_content, $form, $entry );
		if ( $new_content != $post['post_content'] ) {
			global $wpdb;
			$wpdb->update( $wpdb->posts, array( 'post_content' => $new_content ), array( 'ID' => $post_ID ) );
		}
	}

	/**
	 * delete entry meta so it won't be duplicated
	 */
	private static function delete_duplicated_meta( $action, $entry ) {
		global $wpdb;

		$field_ids = array();
		foreach ( $action->post_content as $name => $value ) {
			// Don't try to delete meta for the display ID since this is never a field ID
			if ( $name == 'display_id' ) {
				continue;
			}

			if ( is_numeric($value) ) {
				$field_ids[] = $value;
			} else if ( is_array( $value ) && isset( $value['field_id'] ) && is_numeric( $value['field_id'] ) ) {
				$field_ids[] = $value['field_id'];
			}
			unset($name, $value);
		}

		if ( ! empty($field_ids) ) {
			$where = array( 'item_id' => $entry->id, 'field_id' => $field_ids );
			FrmDb::get_where_clause_and_values( $where );

			$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $wpdb->prefix . 'frm_item_metas' . $where['where'], $where['values'] ) );
		}
	}
}