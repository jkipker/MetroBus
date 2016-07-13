<?php

class FrmProFieldsHelper{

    public static function get_default_value( $value, $field, $dynamic_default = true, $allow_array = false ) {
		if ( is_array( maybe_unserialize( $value ) ) ) {
			if ( FrmAppHelper::is_empty_value( $value ) || count( array_filter( $value ) ) === 0  ) {
				$value = '';
			} else {
				return $value;
			}
		}

        $prev_val = '';
		if ( $field && $dynamic_default ) {
            if ( FrmField::is_option_value_in_object( $field, 'dyn_default_value' ) ) {
                $prev_val = $value;
                $value = $field->field_options['dyn_default_value'];
            }
        }

		$pass_args = array(
			'allow_array' => $allow_array,
			'field'       => $field,
			'prev_val'    => $prev_val,
		);

		self::replace_non_standard_formidable_shortcodes( $pass_args, $value );
		self::replace_field_id_shortcodes( $value, $allow_array );
		self::do_shortcode( $value, $allow_array );
		self::maybe_force_array( $value, $field, $allow_array );

		return $value;
	}

	/**
	 * Replace Formidable shortcodes (that are not added with add_shortcode) in a string
	 *
	 * @since 2.0.24
	 * @param array $args
	 * @param string $value
	 */
	public static function replace_non_standard_formidable_shortcodes( $args, &$value ) {
		$default_args = array(
			'allow_array' => false,
			'field' => false,
			'prev_val' => '',
		);
		$args = wp_parse_args( $args, $default_args );

		$matches = self::get_shortcodes_from_string( $value );

		if ( isset( $matches[0] ) ) {
			$args['matches'] = $matches;

			foreach ( $matches[1] as $match_key => $shortcode ) {
				$args['shortcode'] = $shortcode;
				$args['match_key'] = $match_key;
				self::replace_shortcode_in_string( $value, $args  );
			}
		}
	}

	/**
	 * @since 2.0.8
	 */
	private static function get_shortcode_to_functions() {
		return array(
			'email'         => array( 'FrmProAppHelper', 'get_current_user_value'),
			'login'         => array( 'FrmProAppHelper', 'get_current_user_value'),
			'username'      => array( 'FrmProAppHelper', 'get_current_user_value'),
			'display_name'  => array( 'FrmProAppHelper', 'get_current_user_value'),
			'first_name'    => array( 'FrmProAppHelper', 'get_current_user_value'),
			'last_name'     => array( 'FrmProAppHelper', 'get_current_user_value'),
			'user_role'     => array( 'FrmProAppHelper', 'get_current_user_value'),
			'user_id'       => array( 'FrmProAppHelper', 'get_user_id'),
			'post_id'       => array( 'FrmProAppHelper', 'get_current_post_value'),
			'post_title'    => array( 'FrmProAppHelper', 'get_current_post_value'),
			'post_author_email' => 'get_the_author_meta',
			'ip'            => array( 'FrmAppHelper', 'get_ip_address'),
			'admin_email'   => array( 'FrmFieldsHelper', 'dynamic_default_values'),
			'siteurl'       => array( 'FrmFieldsHelper', 'dynamic_default_values'),
			'frmurl'        => array( 'FrmFieldsHelper', 'dynamic_default_values'),
			'sitename'      => array( 'FrmFieldsHelper', 'dynamic_default_values'),
		);
	}

	private static function get_shortcode_function_parameters() {
		return array(
			'email'         => 'user_email',
			'login'         => 'user_login',
			'username'      => 'user_login',
			'display_name'  => 'display_name',
			'first_name'    => 'user_firstname',
			'last_name'     => 'user_lastname',
			'user_role'     => 'roles',
			'post_id'       => 'ID',
			'post_title'    => 'post_title',
			'post_author_email' => 'user_email',
			'admin_email'   => 'admin_email',
			'siteurl'       => 'siteurl',
			'frmurl'        => 'frmurl',
			'sitename'      => 'sitename',
		);
	}

	/**
	 * @since 2.0.8
	 */
	private static function get_shortcodes_from_string( $string ) {
		$shortcode_functions = self::get_shortcode_to_functions();
		$match_shortcodes = implode( '|', array_keys( $shortcode_functions ) );
		$match_shortcodes .= '|user_meta|post_meta|server|auto_id|date|time|age|get';
		preg_match_all( '/\[(' . $match_shortcodes . '|get-(.?))\b(.*?)(?:(\/))?\]/s', $string, $matches, PREG_PATTERN_ORDER );
		return $matches;
	}

	/**
	 * @since 2.0.8
	 */
	private static function replace_shortcode_in_string( &$value, $args  ) {
		$shortcode_functions = self::get_shortcode_to_functions();

		if ( isset( $shortcode_functions[ $args['shortcode'] ] ) ) {
			$new_value = self::get_shortcode_value_from_function( $args['shortcode'] );
		} else {
			$new_value = self::get_other_shortcode_values( $args );
		}

		if ( is_array($new_value) ) {
			if ( count($new_value) === 1 ) {
				$new_value = reset($new_value);
			}
			$value = $new_value;
		} else {
			$value = str_replace( $args['matches'][0][ $args['match_key'] ], $new_value, $value );
		}
	}

	/**
	 * @since 2.0.8
	 */
	private static function get_shortcode_value_from_function( $shortcode ) {
		$shortcode_functions = self::get_shortcode_to_functions();
		$shortcode_atts = self::get_shortcode_function_parameters();

		return call_user_func( $shortcode_functions[ $shortcode ], isset( $shortcode_atts[ $shortcode ] ) ? $shortcode_atts[ $shortcode ] : '' );
	}

	/**
	 * @since 2.0.8
	 */
	private static function get_other_shortcode_values( $args ) {
		$atts = shortcode_parse_atts( stripslashes( $args['matches'][3][ $args['match_key'] ] ) );
		if ( isset( $atts['return_array'] ) ) {
			$args['allow_array'] = $atts['return_array'];
		}
		$args['shortcode_atts'] = $atts;
		$new_value = '';

		switch ( $args['shortcode'] ) {
			case 'user_meta':
				if ( isset( $atts['key'] ) ) {
					$new_value = FrmProAppHelper::get_current_user_value( $atts['key'], false );
				}
			break;

			case 'post_meta':
				if ( isset( $atts['key'] ) ) {
					$new_value = FrmProAppHelper::get_current_post_value( $atts['key'] );
				}
			break;

			case 'get':
				$new_value = self::do_get_shortcode( $args );
			break;

			case 'auto_id':
				$new_value = self::do_auto_id_shortcode( $args );
			break;

			case 'server':
				if ( isset( $atts['param'] ) ) {
					$new_value = FrmAppHelper::get_server_value( $atts['param'] );
				}
			break;

			case 'date':
				$new_value = FrmProAppHelper::get_date( isset( $atts['format'] ) ? $atts['format'] : '' );
			break;

			case 'time':
				$new_value = FrmProAppHelper::get_time( $atts );
			break;

			case 'age':
				$new_value = self::do_age_shortcode( $atts );
			break;

			default:
				$new_value = self::check_posted_item_meta( $args['matches'][0][ $args['match_key'] ], $args['shortcode'], $atts, $args['allow_array'] );
			break;
		}

		return $new_value;
	}

	/**
	 * @since 2.0.8
	 */
	private static function do_get_shortcode( $args ) {
		// reverse compatability for [get-param] shortcode
		if ( strpos( $args['matches'][0][ $args['match_key'] ], '[get-' ) === 0 ) {
			$val = $args['matches'][0][ $args['match_key'] ];
			$param = str_replace( '[get-', '', $val );
			if ( preg_match( '/\[/s', $param ) ) {
				$val .= ']';
			} else {
				$param = trim( $param, ']' ); //only if is doesn't create an imbalanced []
			}
			$new_value = FrmFieldsHelper::process_get_shortcode( compact( 'param' ), $args['allow_array'] );
		} else {
			$atts = $args['shortcode_atts'];
			$atts['prev_val'] = $args['prev_val'];
			$new_value = FrmFieldsHelper::dynamic_default_values( $args['shortcode'], $atts, $args['allow_array'] );
		}

		return $new_value;
	}

	/**
	 * @since 2.0.8
	 */
	private static function do_auto_id_shortcode( $args ) {
		$last_entry = FrmProEntryMetaHelper::get_max( $args['field'] );

		if ( ! $last_entry && isset( $args['shortcode_atts']['start'] ) ) {
			$new_value = absint( $args['shortcode_atts']['start'] );
		} else {
			$new_value = absint( $last_entry ) + 1;
		}

		return $new_value;
	}

	private static function do_age_shortcode( $args ) {
		if ( ! isset( $args['id'] ) ) {
			$value = '';
		} else {
			$time = FrmProAppHelper::get_date( 'U' );
			$value = 'Math.floor((' . absint( $time ) . '/(60*60*24)-[' . esc_attr( $args['id'] ) . '])/365.25)';
		}
		return $value;
	}

    /**
     * Check for shortcodes in default values but prevent the form shortcode from filtering
     *
     * @since 2.0
     */
    private static function do_shortcode( &$value, $return_array = false ) {
		$is_final_val_set = self::do_array_shortcode( $value, $return_array );
		if ( $is_final_val_set ) {
			return;
		}

        global $frm_vars;
        $frm_vars['skip_shortcode'] = true;
        if ( is_array($value) ) {
            foreach ( $value as $k => $v ) {
                $value[$k] = do_shortcode($v);
                unset($k, $v);
            }
        } else {
            $value = do_shortcode($value);
        }
        $frm_vars['skip_shortcode'] = false;
    }

	/**
	* If shortcode must return an array, bypass the WP do_shortcode function
	* This is set up to return arrays for frm-field-value shortcode in multiple select fields
	*
	* @param $value - string which will be switched to array, pass by reference
	* @param $return_array - boolean keeps track of whether or not an array should be returned
	* @return boolean to tell calling function (do_shortcode) if final value is set
	*/
	private static function do_array_shortcode( &$value, $return_array ) {
		if ( ! $return_array || is_array( $value ) ) {
			return false;
		}

		// If frm-field-value shortcode and it should return an array, bypass the WP do_shortcode function
		if ( strpos( $value, '[frm-field-value ' ) !== false ) {
			preg_match_all( '/\[(frm-field-value)\b(.*?)(?:(\/))?\]/s', $value, $matches, PREG_PATTERN_ORDER );

			foreach ( $matches[0] as $short_key => $tag ) {
				$atts = shortcode_parse_atts( $matches[2][ $short_key ] );
				$atts['return_array'] = $return_array;

				$value = FrmProEntriesController::get_field_value_shortcode( $atts );
			}

			return true;
		}

		return false;
	}

    private static function replace_field_id_shortcodes( &$value, $allow_array ) {
        if ( empty($value) ) {
            return;
        }

        if ( is_array($value) ) {
            foreach ( $value as $k => $v ) {
				self::replace_each_field_id_shortcode( $v, $allow_array );
				$value[ $k ] = $v;
                unset($k, $v);
            }
        } else {
			self::replace_each_field_id_shortcode( $value, $allow_array );
        }
    }

    private static function replace_each_field_id_shortcode( &$value, $return_array ) {
        preg_match_all( "/\[(\d*)\b(.*?)(?:(\/))?\]/s", $value, $matches, PREG_PATTERN_ORDER);
        if ( ! isset($matches[0]) ) {
            return;
        }

        foreach ( $matches[0] as $match_key => $val ) {
            $shortcode = $matches[1][$match_key];
            if ( ! is_numeric($shortcode) || ! isset($_REQUEST) || ! isset($_REQUEST['item_meta']) ) {
                continue;
            }

            $new_value = FrmAppHelper::get_param( 'item_meta['. $shortcode .']', false, 'post', 'wp_kses_post' );
            if ( ! $new_value && isset($atts['default']) ) {
                $new_value = $atts['default'];
            }

            if ( is_array($new_value) && ! $return_array ) {
                $new_value = implode(', ', $new_value);
            }

            if ( is_array($new_value) ) {
                $value = $new_value;
            } else {
                $value = str_replace($val, $new_value, $value);
            }
        }
    }

    /**
     * If this default value should be an array, we will make sure it is
     *
     * @since 2.0
     */
    private static function maybe_force_array( &$value, $field, $return_array ) {
        if ( ! $return_array || is_array($value) || strpos($value, ',') === false ) {
            // this is already in the correct format
            return;
        }

		//If checkbox, multi-select dropdown, or checkbox data from entries field and default value has a comma
		if ( FrmField::is_field_with_multiple_values( $field ) && ( in_array( $field->type, array( 'data', 'lookup' ) ) || ! in_array( $value, $field->options ) ) ) {
			//If the default value does not match any options OR if data from entries field (never would have commas in values), explode to array
			$value = explode(',', $value);
		}
    }

    private static function check_posted_item_meta( $val, $shortcode, $atts, $return_array ) {
        if ( ! is_numeric($shortcode) || ! isset($_REQUEST) || ! isset($_REQUEST['item_meta']) ) {
            return $val;
        }

        //check for posted item_meta
        $new_value = FrmAppHelper::get_param('item_meta['. $shortcode .']', false, 'post');

        if ( ! $new_value && isset($atts['default']) ) {
            $new_value = $atts['default'];
        }

        if ( is_array($new_value) && ! $return_array ) {
            $new_value = implode(', ', $new_value);
        }

        return $new_value;
    }

    /**
     * Get the input name and id
     * Called when loading a dynamic DFE field
     * @since 2.0
     */
    public static function get_html_id_from_container(&$field_name, &$html_id, $field, $hidden_field_id) {
        $id_parts = explode('-', str_replace('_container', '', $hidden_field_id));
        $plus = ( count($id_parts) == 3 ) ? '-' . end($id_parts) : ''; // this is in a sub field
        $html_id = FrmFieldsHelper::get_html_id($field, $plus);
        if ( $plus != '' ) {
            // get the name for the sub field
            $field_name .= '['. $id_parts[1] .']['. end($id_parts) .']';
        }
        $field_name .= '['. $field['id'] .']';
    }

	public static function setup_new_field_vars( $values ) {
        $values['field_options'] = maybe_unserialize($values['field_options']);
        $defaults = self::get_default_field_opts($values);

		foreach ( $defaults as $opt => $default ) {
			$values[ $opt ] = ( isset( $values['field_options'][ $opt ] ) ) ? $values['field_options'][ $opt ] : $default;
		}

        unset($defaults);

        if ( ! empty($values['hide_field']) && ! is_array($values['hide_field']) ) {
            $values['hide_field'] = (array) $values['hide_field'];
        }

        return $values;
    }

	public static function setup_new_vars( $values, $field ) {
        $values['use_key'] = false;

        foreach ( self::get_default_field_opts($values, $field) as $opt => $default ) {
            $values[$opt] = (isset($field->field_options[$opt]) && $field->field_options[$opt] != '') ? $field->field_options[$opt] : $default;
            unset($opt, $default);
        }

        $values['hide_field'] = (array) $values['hide_field'];
        $values['hide_field_cond'] = (array) $values['hide_field_cond'];
        $values['hide_opt'] = (array) $values['hide_opt'];

		if ( $values['type'] == 'data' && in_array( $values['data_type'], array( 'select', 'radio', 'checkbox' ) ) && is_numeric( $values['form_select'] ) ) {
            FrmProDynamicFieldsController::add_options_for_dynamic_field( $field, $values );
		} else if ( $values['type'] == 'lookup' ) {
			FrmProLookupFieldsController::maybe_get_initial_lookup_field_options( $values );
		} else if ( $values['type'] == 'scale' ) {
            $values['minnum'] = 1;
            $values['maxnum'] = 10;
		} else if ( $values['type'] == 'date' ) {
            $values['value'] = FrmProAppHelper::maybe_convert_from_db_date($values['value'], 'Y-m-d');
		} else if ( $values['type'] == 'time' ) {
            $values['options'] = self::get_time_options($values);
        } else if ( $values['type'] == 'user_id' && FrmAppHelper::is_admin() && current_user_can('frm_edit_entries') && ! FrmAppHelper::is_admin_page('formidable' ) ) {
            if ( self::field_on_current_page($field) ) {
                $user_ID = get_current_user_id();
                $values['type'] = 'select';
                $values['options'] = self::get_user_options();
                $values['use_key'] = true;
                $values['custom_html'] = FrmFieldsHelper::get_default_html('select');
				$values['value'] = ( $_POST && isset($_POST['item_meta'][ $field->id ] ) ) ? $_POST['item_meta'][ $field->id ] : $user_ID;
            }
		} else if ( ! empty( $values['options'] ) ) {
			foreach ( $values['options'] as $val_key => $val_opt ) {
				if ( is_array( $val_opt ) ) {
					foreach ( $val_opt as $opt_key => $opt ) {
                        $values['options'][$val_key][$opt_key] = self::get_default_value($opt, $field, false);
                        unset( $opt_key, $opt );
                    }
                }else{
                   $values['options'][$val_key] = self::get_default_value($val_opt, $field, false);
                }
				unset( $val_key, $val_opt );
            }
        }

		if ( $values['post_field'] == 'post_category' ) {
            $values['use_key'] = true;
            $values['options'] = self::get_category_options($values);
            if ( $values['type'] == 'data' && $values['data_type'] == 'select' && ( ! $values['multiple'] || $values['autocom'] ) ) {
                // add a blank option
                $values['options'] = array( '' => '') + (array) $values['options'];
            }
		} else if ( $values['post_field'] == 'post_status' ) {
            $values['use_key'] = true;
			$values['options'] = self::get_status_options( $field, $values['options'] );
        }

		if ( is_array( $values['value'] ) ) {
			foreach ( $values['value'] as $val_key => $val ) {
				$values['value'][ $val_key ] = apply_filters( 'frm_filter_default_value', $val, $field, false );
			}
		} else if ( ! empty( $values['value'] ) ) {
            $values['value'] = apply_filters('frm_filter_default_value', $values['value'], $field, false);
        }

        self::add_field_javascript( $values );

        return $values;
    }

	/**
	* Initialize the field array when a field is loaded independent of the rest of the form
	*
	* @param object $field_object
	* @return array $args
	*/
	public static function initialize_array_field( $field_object, $args = array() ) {
		$field_values = array( 'id', 'required', 'name', 'description', 'form_id', 'options', 'field_key', 'type' );
		$field = array( 'value' => '' );
		foreach ( $field_values as $field_value ) {
			$field[ $field_value ] = $field_object->{$field_value};
		}

		$field['original_type'] = $field['type'];
		$field['type'] = apply_filters( 'frm_field_type', $field['type'], $field_object, '' );
		$field['size'] = ( isset( $field_object->field_options['size'] ) && $field_object->field_options['size'] != '' ) ? $field_object->field_options['size'] : '';
		$field['blank'] = $field_object->field_options['blank'];
		$field['default_value'] = isset( $args['default_value'] ) ? $args['default_value'] : '';

		if ( isset( $args['field_id'] ) ) {
			// this might not be needed. Is field_id ever different from $field['id']?
			$field['id'] = $args['field_id'];
		}

		return $field;
	}

	/**
	* Add field-specific JavaScript to global $frm_vars
	*
	* @since 2.01.0
	* @param array $values
	*/
	private static function add_field_javascript( $values ) {
		self::setup_conditional_fields($values);
		FrmProLookupFieldsController::setup_lookup_field_js( $values );
	}

    public static function setup_edit_vars( $values, $field, $entry_id = false ) {
        $values['use_key'] = false;

		self::fill_field_options( $field, $values );

        $values['hide_field'] = (array) $values['hide_field'];
        $values['hide_field_cond'] = (array) $values['hide_field_cond'];
        $values['hide_opt'] = (array) $values['hide_opt'];

		if ( $values['type'] == 'lookup' ) {
			FrmProLookupFieldsController::maybe_get_initial_lookup_field_options( $values );

		} else if ( $values['type'] == 'data' && in_array($values['data_type'], array( 'select', 'radio', 'checkbox')) && is_numeric($values['form_select']) ) {
            FrmProDynamicFieldsController::add_options_for_dynamic_field( $field, $values );
        } else if ( $values['type'] == 'date' || $values['original_type'] == 'date' ) {
            $values['value'] = FrmProAppHelper::maybe_convert_from_db_date( $values['value'] );

        } else if ( $values['type'] == 'hidden' && FrmAppHelper::is_admin() && current_user_can('administrator') && ! FrmAppHelper::is_admin_page('formidable' ) ) {
            if ( self::field_on_current_page($field) ) {
                $values['type'] = 'text';
                $values['custom_html'] = FrmFieldsHelper::get_default_html('text');
            }
        } else if ( $values['type'] == 'time' ) {
            $values['options'] = self::get_time_options($values);
        } else if ( $values['type'] == 'user_id' && FrmAppHelper::is_admin() && current_user_can('frm_edit_entries') && ! FrmAppHelper::is_admin_page('formidable' ) ) {
            if ( self::field_on_current_page($field) ) {
                $values['type'] = 'select';
                $values['options'] = self::get_user_options();
                $values['use_key'] = true;
                $values['custom_html'] = FrmFieldsHelper::get_default_html('select');
            }
		} else if ( $values['type'] == 'tag' ) {
			if ( empty( $values['value'] ) ) {
                self::tags_to_list($values, $entry_id);
            }
        } else if ( ! empty($values['options']) && ( ! FrmAppHelper::is_admin() || ! FrmAppHelper::is_admin_page('formidable' ) ) ) {
			foreach ( $values['options'] as $val_key => $val_opt ) {
				if ( is_array( $val_opt ) ) {
					foreach ( $val_opt as $opt_key => $opt ) {
						$values['options'][ $val_key ][ $opt_key ] = self::get_default_value( $opt, $field, false );
                        unset($opt_key, $opt);
                    }
                }else{
                   $values['options'][$val_key] = self::get_default_value($val_opt, $field, false);
                }
                unset($val_key, $val_opt);
            }
        }

		if ( $values['post_field'] == 'post_category' ) {
            $values['use_key'] = true;
            $values['options'] = self::get_category_options($values);
            if ( $values['type'] == 'data' && $values['data_type'] == 'select' && ( ! $values['multiple'] || $values['autocom'] ) ) {
                $values['options'] = array( '' => '') + (array) $values['options'];
            }
		} else if ( $values['post_field'] == 'post_status' ) {
            $values['use_key'] = true;
			$values['options'] = self::get_status_options( $field, $values['options'] );
        }

		// Format the value in hidden repeating sections
		self::setup_hidden_sub_form( $values );

        self::add_field_javascript( $values );

        return $values;
    }

	/**
	* Populate the options for a field when loaded (front and back-end)
	*
	* @since 2.0.08
	* @param object $field
	* @param array $values, pass by reference
	*/
	private static function fill_field_options( $field, &$values ) {
		foreach ( self::get_default_field_opts( $values, $field ) as $opt => $default ) {
			if ( isset( $field->field_options[ $opt ] ) ) {
				$values[ $opt ] = $field->field_options[ $opt ];
			} else {
				$values[ $opt ] = $default;
			}
		}
	}

    public static function tags_to_list(&$values, $entry_id) {
        $post_id = FrmDb::get_var( 'frm_items', array( 'id' => $entry_id), 'post_id' );
        if ( ! $post_id ) {
            return;
        }

        $tags = get_the_terms( $post_id, $values['taxonomy'] );
        if ( empty($tags) ) {
            $values['value'] = '';
            return;
        }

        $names = array();
        foreach ( $tags as $tag ) {
            $names[] = $tag->name;
        }

        $values['value'] = implode(', ', $names);
    }

    public static function get_default_field_opts( $values = false, $field = false ) {
        $minnum = 1;
        $maxnum = 10;
        $step = 1;
        $align = 'block';
        $show_hide = 'show';

		$field_type = ( $values ) ? $values['type'] : $field->type;
		switch ( $field_type ) {
			case 'number':
				$minnum = 0;
				$maxnum = 9999;
				$step = 'any';
			break;
			case 'scale':
				if ( $field ) {
					$range = maybe_unserialize( $field->options );
					$minnum = $range[0];
					$maxnum = end( $range );
				}
			break;
			case 'time':
				$step = 30;
			break;
			case 'radio':
				$align = FrmStylesController::get_style_val( 'radio_align', ( $field ? $field->form_id : 'default' ) );
			break;
			case 'checkbox':
				$align = FrmStylesController::get_style_val( 'check_align', ( $field ? $field->form_id : 'default' ) );
			break;
			case 'break':
				$show_hide = 'hide';
			break;
		}

        $end_minute = 60 - (int) $step;

        $frm_settings = FrmAppHelper::get_settings();

        $opts = array(
            'slide' => 0, 'form_select' => '', 'show_hide' => $show_hide, 'any_all' => 'any', 'align' => $align,
            'hide_field' => array(), 'hide_field_cond' =>  array( '=='), 'hide_opt' => array(), 'star' => 0,
            'post_field' => '', 'custom_field' => '', 'taxonomy' => 'category', 'exclude_cat' => 0, 'ftypes' => array(),
            'data_type' => 'select', 'restrict' => 0, 'start_year' => 2000, 'end_year' => 2020, 'read_only' => 0,
            'admin_only' => '', 'locale' => '', 'attach' => false, 'minnum' => $minnum, 'maxnum' => $maxnum,
			'delete' => false,
            'step' => $step, 'clock' => 12, 'start_time' => '00:00', 'end_time' => '23:'.$end_minute,
			'unique' => 0, 'use_calc' => 0, 'calc' => '', 'calc_dec' => '', 'calc_type' => '',
            'dyn_default_value' => '', 'multiple' => 0, 'unique_msg' => $frm_settings->unique_msg, 'autocom' => 0,
            'format' => '', 'repeat' => 0, 'add_label' => __( 'Add', 'formidable' ), 'remove_label' => __( 'Remove', 'formidable' ),
            'conf_field' => '', 'conf_input' => '', 'conf_desc' => '',
            'conf_msg' => __( 'The entered values do not match', 'formidable' ), 'other' => 0,
			'in_section' => 0,
        );

		FrmProLookupFieldsController::add_autopopulate_value_field_options( $values, $field, $opts );

		FrmProLookupFieldsController::add_field_options_specific_to_lookup_field( $values, $field, $opts );

        $opts = apply_filters('frm_default_field_opts', $opts, $values, $field);
		$opts = apply_filters( 'frm_default_'. $field_type .'_field_opts', $opts, $values, $field );

		unset( $values, $field );

        return $opts;
    }

    public static function setup_input_masks($field) {
		if ( ! isset($field['format']) || empty($field['format']) || strpos($field['format'], '^') === 0 || ( $field['type'] != 'tel' && $field['type'] != 'phone' ) ) {
			return;
		}

		return self::setup_input_mask( $field['format'] );
    }

	public static function setup_input_mask( $format ) {
		global $frm_input_masks;
		$frm_input_masks[] = true;
		return ' data-frmmask="'. esc_attr( preg_replace( '/\d/', '9', $format ) ) .'"';
	}

	/**
	 * Triggered when the repeat option is toggled on the form builder page
	 *
	 * When a field is changed to repeat:
	 *  - Get the metas for the fields in the section
	 *  - Create an entry and change the entry id on those metas
	 *
	 * When a field is changed to not repeat:
	 * 	- Change the entry id on all metas for the first entry to the parent entry id
	 *	- Delete the other entries and meta
	 *
	 * @since 2.0
	 */
	public static function update_for_repeat( $args ) {
		if ( $args['checked'] ) {
			// Switching to repeatable
			self::move_fields_to_form( $args['children'], $args['form_id'] );
			self::move_entries_to_child_form( $args );
			$form_select = $args['form_id'];
		} else {
			// Switching to non-repeatable
			self::move_fields_to_form( $args['children'], $args['parent_form_id'] );
			self::move_entries_to_parent_form( $args );
			$form_select = '';
		}

		// update the repeat setting and form_select
		$section = FrmField::getOne( $args['field_id'] );
		$section->field_options['repeat'] = $args['checked'];
		$section->field_options['form_select'] = $form_select;
		FrmField::update( $args['field_id'], array( 'field_options' => $section->field_options ) );
	}

	/**
	* Move fields to a different form
	* Used when switching from repeating to non-repeating (or vice versa)
	*/
	private static function move_fields_to_form( $field_ids, $form_id ) {
		global $wpdb;

		$where = array( 'id' => $field_ids, 'type !' => 'end_divider' );
		FrmDb::get_where_clause_and_values( $where );
		array_unshift( $where['values'], $form_id );
		$wpdb->query( $wpdb->prepare( 'UPDATE ' . $wpdb->prefix . 'frm_fields SET form_id=%d ' . $where['where'], $where['values'] ) );
	}

	/**
	* Move entries from parent form to child form
	*
	* @since 2.0.09
	*/
	private static function move_entries_to_child_form( $args ) {
		global $wpdb;

		// get the ids of the entries saved in these fields
		$item_ids = FrmDb::get_col( 'frm_item_metas', array( 'field_id' => $args['children'] ), 'item_id', array( 'group_by' => 'item_id' ) );

		foreach ( $item_ids as $old_id ) {
			// Create a new entry in the child form
	        $new_id = FrmEntry::create( array( 'form_id' => $args['form_id'], 'parent_item_id' => $old_id ) );

			// Move the parent item_metas to the child form
			$where = array( 'item_id' => $old_id, 'field_id' => $args['children'] );
			FrmDb::get_where_clause_and_values( $where );
			array_unshift( $where['values'], $new_id );
			$c = $wpdb->query( $wpdb->prepare( 'UPDATE ' . $wpdb->prefix . 'frm_item_metas SET item_id = %d ' . $where['where'], $where['values'] ) );

			if ( $c ) {
				// update the section field meta with the new entry ID
				$u = FrmEntryMeta::update_entry_meta( $old_id, $args['field_id'], null, $new_id );
				if ( ! $u ) {
					// add the row if it wasn't there to update
					FrmEntryMeta::add_entry_meta( $old_id, $args['field_id'], null, $new_id );
				}
			}
		}
	}

	/**
	* Delete entries from repeating sections and transfer first row to parent entries
	*/
	private static function move_entries_to_parent_form( $args ) {
		global $wpdb;

		// get the ids of the entries saved in child fields
		$items = FrmDb::get_results( $wpdb->prefix . 'frm_item_metas m LEFT JOIN ' . $wpdb->prefix . 'frm_items i ON i.id=m.item_id', array( 'field_id' => $args['children'] ), 'item_id,parent_item_id', array( 'order_by' => 'i.created_at ASC' ) );

		$updated_ids = array();
		foreach ( $items as $item ) {
			$child_id = $item->item_id;
			$parent_id = $item->parent_item_id;
			if ( ! in_array( $parent_id, $updated_ids ) ) {
				// Change the item_id in frm_item_metas to match the parent item ID
				$wpdb->query( $wpdb->prepare( 'UPDATE ' . $wpdb->prefix . 'frm_item_metas SET item_id = %d WHERE item_id = %d', $parent_id, $child_id ) );
				$updated_ids[] = $parent_id;
			}

			// Delete the child entry
			FrmEntry::destroy( $child_id );
		}

		// delete all the metas for the repeat section
		$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $wpdb->prefix . 'frm_item_metas WHERE field_id=%d', $args['field_id'] ) );

		// Delete the child form
		FrmForm::destroy( $args['form_id'] );
	}

	/**
	* Format the value in hidden repeating sections when value isn't posted
	* @since 2.0
	*/
	private static function setup_hidden_sub_form( &$values ) {
		$is_hidden_repeat_with_saved_value = (
			$values['original_type'] == 'divider' &&
			$values['repeat'] &&
			$values['type'] == 'hidden' &&
			! isset( $values['value']['form'] ) &&
			! empty ( $values['value'] )
		);

		if ( ! $is_hidden_repeat_with_saved_value ) {
			return;
		}

		// Begin formatting field value
		$values['value'] = array(
			'id'   => $values['value'],
			'form' => $values['form_select'],
		);

		// Get child fields
		$child_fields = FrmField::get_all_for_form( $values['form_select'] );

		// Loop through children and entries to get values
		foreach ( (array) $values['value']['id'] as $entry_id ) {
			$values['value'][ 'i' . $entry_id ] = array();
			$values['value'][ 'i' . $entry_id ][0] = '';
			$entry = FrmEntry::getOne( $entry_id, true );
			foreach ( $child_fields as $child ) {
				$values['value'][ 'i' . $entry_id ][ $child->id ] = isset( $entry->metas[ $child->id ] ) ? $entry->metas[ $child->id ] : '';

				if ( $child->type == 'date' ) {
					$current_value = $values['value'][ 'i' . $entry_id ][ $child->id ];
					$values['value'][ 'i' . $entry_id ][ $child->id ] = FrmProAppHelper::maybe_convert_from_db_date( $current_value );
				}
			}
		}
	}

	/**
	 * Set up the $frm_vars['rules'] array
	 *
	 * @param array $field
	 */
	public static function setup_conditional_fields( $field ) {
		// TODO: prevent this from being called at all on the form builder page
		if ( FrmAppHelper::is_admin_page('formidable' ) ) {
			return;
		}

		global $frm_vars;

		if ( false == self::are_logic_rules_needed_for_this_field( $field, $frm_vars ) ) {
			return;
		}

		self::maybe_initialize_global_rules_array( $frm_vars );

		$logic_rules = self::get_logic_rules_for_field( $field, $frm_vars );

		foreach ( $field['hide_field'] as $i => $logic_field_id ) {
			$logic_field = self::get_field_from_conditional_logic( $logic_field_id );
			if ( ! $logic_field ) {
				continue;
			}
			$add_field = true;

			self::add_condition_to_logic_rules( $field, $i, $logic_rules );

			self::maybe_initialize_logic_field_rules( $logic_field, $field['parent_form_id'], $frm_vars );

			self::add_to_logic_field_dependents( $logic_field_id, $field['id'], $frm_vars );
		}
		unset( $i, $logic_field_id, $logic_field );

		if ( isset( $add_field ) && $add_field == true ) {

			// Add current field's logic rules to global rules array
			$frm_vars['rules'][ $field['id'] ] = $logic_rules;

			self::set_logic_rule_status_to_complete( $field['id'], $frm_vars );
			self::maybe_add_script_for_confirmation_field( $field, $logic_rules, $frm_vars );
			self::add_field_to_global_dependent_ids( $field, $logic_rules['fieldType'], $frm_vars );
		}
	}

	/**
	 * Check if global conditional logic rules are needed for a field
	 *
	 * @since 2.01.0
	 * @param array $field
	 * @param array $frm_vars
	 * @return bool
	 */
	private static function are_logic_rules_needed_for_this_field( $field, $frm_vars ) {
		$logic_rules_needed = true;

        if ( empty( $field['hide_field'] ) || ( empty( $field['hide_opt'] ) && empty( $field['form_select'] ) ) ) {
        	// Field doesn't have conditional logic on it
            $logic_rules_needed = false;

        } else if ( isset( $frm_vars['rules'][ $field['id'] ]['status'] ) && 'complete' == $frm_vars['rules'][ $field['id'] ]['status'] ) {
        	// Field has already been checked
        	$logic_rules_needed = false;

        } else if ( FrmAppHelper::doing_ajax() && ( ! isset( $frm_vars['footer_loaded'] ) || $frm_vars['footer_loaded'] !== true ) ) {
        	// Don't load rules again when adding a row in a repeating section or turning the page in a "Submit with ajax" form
        	$logic_rules_needed = false;
        }

        return $logic_rules_needed;
	}

	/**
	 * Initialize the $frm_vars rules array if it isn't already initialized
	 *
	 * @since 2.01.0
	 * @param array $frm_vars
	 */
	private static function maybe_initialize_global_rules_array( &$frm_vars ) {
        if ( ! isset( $frm_vars['rules'] ) || ! $frm_vars['rules'] ) {
			$frm_vars['rules'] = array();
		}
	}

	/**
	 * Get the logic rules for the current field
	 *
	 * @since 2.01.0
	 * @param array $field
	 * @param array $frm_vars
	 * @return array
	 */
	private static function get_logic_rules_for_field( $field, $frm_vars ) {
		if ( ! isset( $frm_vars['rules'][ $field['id'] ] ) ) {
			$logic_rules = self::initialize_logic_rules_for_field_array( $field, $field['parent_form_id'] );
		} else {
			$logic_rules = $frm_vars['rules'][ $field['id'] ];
		}

		return $logic_rules;
	}

	/**
	 * Initialize the logic rules for a field
	 *
	 * @since 2.01.0
	 * @param array $field
	 * @param int $form_id
	 * @return array
	 */
	private static function initialize_logic_rules_for_field_array( $field, $form_id ) {
        $original_type = self::get_original_field_type( $field );

		$logic_rules = array(
        	'fieldId' => $field['id'],
			'fieldKey' => $field['field_key'],
			'fieldType' => $original_type,
			'inputType' => self::get_the_input_type_for_logic_rules( $field, $original_type ),
			'isMultiSelect' => FrmField::is_multiple_select( $field ),
			'formId' => $form_id,
			'inSection' => isset( $field['in_section'] ) ? $field['in_section'] : '0',
			'inEmbedForm' => isset( $field['in_embed_form'] ) ? $field['in_embed_form'] : '0',
			'isRepeating' => ( $form_id != $field['form_id'] ),
			'dependents' => array(),
			'showHide' => isset( $field['show_hide'] ) ? $field['show_hide'] : 'show',
			'anyAll' => isset( $field['any_all'] ) ? $field['any_all'] : 'any',
			'conditions' => array(),
        );

        // Maybe add section key
        if ( $logic_rules['inSection'] !== '0' && $logic_rules['isRepeating'] ) {
        	$logic_rules['inSectionKey'] = FrmField::get_key_by_id( $logic_rules['inSection'] );
        }

        return $logic_rules;
	}

	/**
	 * Get the original field type
	 *
	 * @since 2.01.0
	 * @param array $field
	 * @return string
	 */
	private static function get_original_field_type( $field ) {
		if ( isset( $field['original_type'] ) ) {
			$field_type = $field['original_type'];
		} else {
			$field_type = $field['type'];
		}

		return $field_type;
	}

	/**
	 * Get the input type from a field
	 *
	 * @since 2.01.0
	 * @param array $field
	 * @param string $field_type
	 * @return string
	 */
	private static function get_the_input_type_for_logic_rules( $field, $field_type ) {
		if ( $field_type == 'data' || $field_type == 'lookup' ) {
			$cond_type = $field['data_type'];
		} else if ( $field_type == 'scale' ) {
			$cond_type = 'radio';
		} else {
			$cond_type = $field_type;
		}
		$cond_type = apply_filters( 'frm_logic_' . $field_type . '_input_type', $cond_type );

		return $cond_type;
	}

	/**
	 * Set the logic rule status to complete
	 *
	 * @since 2.01.0
	 * @param int $field_id
	 * @param array $frm_vars
	 */
	private static function set_logic_rule_status_to_complete( $field_id, &$frm_vars ) {
		$frm_vars['rules'][ $field_id ]['status'] = 'complete';
	}

	/**
	 * Get the field object for a logic field
	 *
	 * @since 2.01.0
	 * @param mixed $logic_field_id
	 * @return boolean|object
	 */
	private static function get_field_from_conditional_logic( $logic_field_id ) {
		// TODO: maybe get rid of the getOne call here if the field already exists in $frm_vars['rules']?
		if ( ! is_numeric( $logic_field_id ) ) {
			$logic_field = false;
		} else {
			$logic_field = FrmField::getOne( $logic_field_id );
		}

		return $logic_field;
	}

	/**
	 * Add a row of conditional logic to the logic_rules array
	 *
	 * @since 2.01.0
	 * @param array $field
	 * @param int $i
	 * @param array $logic_rules
	 */
	private static function add_condition_to_logic_rules( $field, $i, &$logic_rules ) {
		$value = self::get_default_value( $field['hide_opt'][ $i ], $field, false );
		$logic_rules['conditions'][] = array(
			'fieldId'  => $field['hide_field'][ $i ],
			'operator' => $field['hide_field_cond'][ $i ],
			'value'    => $value,
		);
	}

	/**
	 * Add a logic field to the frm_vars rules array
	 *
	 * @since 2.01.0
	 * @param object $logic_field
	 * @param int $form_id
	 * @param array $frm_vars
	 */
	private static function maybe_initialize_logic_field_rules( $logic_field, $form_id, &$frm_vars ) {
		if ( ! isset( $frm_vars['rules'][ $logic_field->id ] ) ) {
			$frm_vars['rules'][ $logic_field->id ] = self::initialize_logic_rules_for_fields_object( $logic_field, $form_id );
		}
	}

	/**
	 * Initialize the logic rules for a field object
	 *
	 * @since 2.01.0
	 * @param object $field
	 * @param int $form_id
	 * @return array
	 */
	private static function initialize_logic_rules_for_fields_object( $field, $form_id ) {
		$field_options = $field->field_options;
		$field = get_object_vars( $field );
		unset( $field['field_options'] );
		$field = $field + $field_options;

		return self::initialize_logic_rules_for_field_array( $field, $form_id );
	}

	/**
	 * Add dependent field to logic field's dependents
	 *
	 * @since 2.01.0
	 * @param int $logic_field_id
	 * @param int $dep_field_id
	 * @param array $frm_vars
	 */
	private static function add_to_logic_field_dependents( $logic_field_id, $dep_field_id, &$frm_vars ) {
		$frm_vars['rules'][ $logic_field_id ]['dependents'][] = $dep_field_id;
	}

	/**
	 * Add rules for a confirmation field
	 *
	 * @since 2.01.0
	 * @param array $field
	 * @param array $logic_rules
	 * @param array $frm_vars
	 */
	private static function maybe_add_script_for_confirmation_field( $field, $logic_rules, &$frm_vars ){
		// TODO: maybe move confirmation field inside of field div
		if ( ! FrmField::is_option_empty( $field, 'conf_field' ) ) {

			// Add the rules for confirmation field
			$conf_field_rules = $logic_rules;
			$conf_field_rules['fieldId'] = 'conf_' . $logic_rules['fieldId'];
			$conf_field_rules['fieldKey'] = 'conf_' . $logic_rules['fieldKey'];
			$frm_vars['rules'][ 'conf_' . $field['id'] ] = $conf_field_rules;

			// Add to all logic field dependents
			self::add_conf_field_to_logic_field_dependents( $conf_field_rules, $frm_vars );
		}
	}

	/**
	 * Add confirmation field as a dependent for all of its logic fields
	 *
	 * @since 2.01.0
	 * @param array $conf_field_rules
	 * @param array $frm_vars
	 */
	private static function add_conf_field_to_logic_field_dependents( $conf_field_rules, &$frm_vars ) {
		foreach ( $conf_field_rules['conditions'] as $condition ) {
			self::add_to_logic_field_dependents( $condition['fieldId'], $conf_field_rules['fieldId'], $frm_vars );
		}
	}

	/**
	 * Add dependent field to the dep_logic_fields or dep_dynamic_fields array
	 *
	 * @since 2.01.0
	 * @param array $field
	 * @param string $original_field_type
	 * @param array $frm_vars
	 */
	private static function add_field_to_global_dependent_ids( $field, $original_field_type, &$frm_vars ) {
		if ( $original_field_type == 'data' ) {
			// Add to dep_dynamic_fields
			if ( ! isset( $frm_vars['dep_dynamic_fields'] ) ) {
				$frm_vars['dep_dynamic_fields'] = array();
			}
			$frm_vars['dep_dynamic_fields'][] = $field['id'];
		} else {
			// Add to dep_logic_fields
			if ( ! isset( $frm_vars['dep_logic_fields'] ) ) {
				$frm_vars['dep_logic_fields'] = array();
			}
			$frm_vars['dep_logic_fields'][] = $field['id'];

			if ( FrmField::is_option_true_in_array( $field, 'conf_field' ) ) {
				$frm_vars['dep_logic_fields'][] = 'conf_' . $field['id'];
			}
		}
	}

	public static function get_category_options( $field ) {
		if ( is_object( $field ) ) {
			$field = (array) $field;
			$field = array_merge( $field, $field['field_options'] );
		}

        $post_type = FrmProFormsHelper::post_type($field['form_id']);
        if ( ! isset($field['exclude_cat']) ) {
            $field['exclude_cat'] = 0;
        }

        $exclude = (is_array($field['exclude_cat'])) ? implode(',', $field['exclude_cat']) : $field['exclude_cat'];
        $exclude = apply_filters('frm_exclude_cats', $exclude, $field);

        $args = array(
            'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false,
            'exclude' => $exclude, 'type' => $post_type
        );

		if ( $field['type'] != 'data' ) {
            $args['parent'] = '0';
		}

        $args['taxonomy'] = FrmProAppHelper::get_custom_taxonomy($post_type, $field);
        if ( ! $args['taxonomy'] ) {
            return;
        }

        $args = apply_filters('frm_get_categories', $args, $field);

        $categories = get_categories($args);

        $options = array();
		foreach ( $categories as $cat ) {
			$options[ $cat->term_id ] = $cat->name;
		}

        $options = apply_filters('frm_category_opts', $options, $field, array( 'cat' => $categories, 'args' => $args) );

        return $options;
    }

	public static function get_child_checkboxes( $args ) {
        $defaults = array(
            'field' => 0, 'field_name' => false, 'opt_key' => 0, 'opt' => '',
            'type' => 'checkbox', 'value' => false, 'exclude' => 0, 'hide_id' => false,
            'tax_num' => 0
        );
        $args = wp_parse_args($args, $defaults);

        if ( ! $args['field'] || ! isset($args['field']['post_field']) || $args['field']['post_field'] != 'post_category' ) {
            return;
        }

        if ( ! $args['value'] ) {
            $args['value'] = isset($args['field']['value']) ? $args['field']['value'] : '';
        }

        if ( ! $args['exclude'] ) {
            $args['exclude'] = is_array($args['field']['exclude_cat']) ? implode(',', $args['field']['exclude_cat']) : $args['field']['exclude_cat'];
            $args['exclude'] = apply_filters('frm_exclude_cats', $args['exclude'], $args['field']);
        }

        if ( ! $args['field_name'] ) {
            $args['field_name'] = 'item_meta['. $args['field']['id'] .']';
        }

        if ( $args['type'] == 'checkbox' ) {
            $args['field_name'] .= '[]';
        }
        $post_type = FrmProFormsHelper::post_type($args['field']['form_id']);
        $taxonomy = 'category';

        $cat_atts = array(
            'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false,
            'parent' => $args['opt_key'], 'exclude' => $args['exclude'], 'type' => $post_type,
        );
        if ( ! $args['opt_key'] ) {
            $cat_atts['taxonomy'] = FrmProAppHelper::get_custom_taxonomy($post_type, $args['field']);
			if ( ! $cat_atts['taxonomy'] ) {
                echo '<p>'. __( 'No Categories', 'formidable' ) .'</p>';
                return;
            }

            $taxonomy = $cat_atts['taxonomy'];
        }

        $children = get_categories($cat_atts);
        unset($cat_atts);
    
        $level = $args['opt_key'] ? 2 : 1;
    	foreach ( $children as $key => $cat ) {  ?>
    	<div class="frm_catlevel_<?php echo (int) $level ?>"><?php self::_show_category( array(
            'cat' => $cat, 'field' => $args['field'], 'field_name' => $args['field_name'],
            'exclude' => $args['exclude'], 'type' => $args['type'], 'value' => $args['value'],
            'level' => $level, 'onchange' => '', 'post_type' => $post_type,
            'taxonomy' => $taxonomy, 'hide_id' => $args['hide_id'], 'tax_num' => $args['tax_num'],
        )) ?></div>
<?php   }
    }

    /**
    * Get the max depth for any given taxonomy (recursive function)
    *
    * Since 2.0
    *
    * @param string $cat_name - taxonomy name
    * @param int $parent - parent ID, 0 by default
    * @param int $cur_depth - depth of current taxonomy path
    * @param int $max_depth - max depth of given taxonomy
    * @return int $max_depth - max depth of given taxonomy
    */
	public static function get_category_depth( $cat_name, $parent = 0, $cur_depth = 0, $max_depth = 0 ) {
        if ( ! $cat_name ) {
            $cat_name = 'category';
        }

        // Return zero if taxonomy is not hierarchical
        if ( $parent == 0 && ! is_taxonomy_hierarchical( $cat_name ) ) {
            $max_depth = 0;
            return $max_depth;
        }

        // Get all level one categories first
        $categories = get_categories( array( 'number' => 10, 'taxonomy' => $cat_name, 'parent' => $parent, 'orderby' => 'name', 'order' => 'ASC', 'hide_empty' => false ) );

        //Only go 5 levels deep at the most
        if ( empty( $categories ) || $cur_depth == 5 ) {
            // Only update the max depth, if the current depth is greater than the max depth so far
            if ( $cur_depth > $max_depth ) {
                $max_depth = $cur_depth;
            }

            return $max_depth;
        }

        // Increment the current depth
        $cur_depth++;

        foreach ( $categories as $key => $cat ) {
            $parent = $cat->cat_ID;
            // Get children
            $max_depth = self::get_category_depth( $cat_name, $parent, $cur_depth, $max_depth );
        }
        return $max_depth;
    }

    public static function _show_category($atts) {
    	if ( ! is_object($atts['cat']) ) {
    	    return;
    	}

    	if ( is_array($atts['value']) ) {
    		$checked = (in_array($atts['cat']->cat_ID, $atts['value'])) ? 'checked="checked" ' : '';
    	} else if ( $atts['cat']->cat_ID == $atts['value'] ) {
    	    $checked = 'checked="checked" ';
    	} else {
    	    $checked = '';
    	}

    	$sanitized_name = ( isset($atts['field']['id']) ? $atts['field']['id'] : $atts['field']['field_options']['taxonomy'] ) .'-'. $atts['cat']->cat_ID;
        // Makes sure ID is unique for excluding checkboxes in Categories/Taxonomies in Create Post action
        if ( $atts['tax_num'] ) {
            $sanitized_name .= '-' . $atts['tax_num'];
        }

    	?>
    	<div class="frm_<?php echo esc_attr( $atts['type'] ) ?>" id="frm_<?php echo esc_attr( $atts['type'] .'_'. $sanitized_name ) ?>">
    	    <label for="field_<?php echo esc_attr( $sanitized_name ) ?>"><input type="<?php echo esc_attr( $atts['type'] ) ?>" name="<?php echo esc_attr( $atts['field_name'] ) ?>" <?php
    	    echo ( isset($atts['hide_id']) && $atts['hide_id'] ) ? '' : 'id="field_'. esc_attr( $sanitized_name ) .'"';
    	    ?> value="<?php echo esc_attr( $atts['cat']->cat_ID ) ?>" <?php
    	    echo $checked;
    	    do_action('frm_field_input_html', $atts['field']);
    	    //echo ($onchange);
    	    ?> /><?php echo esc_html( $atts['cat']->cat_name ) ?></label>
<?php
    	$children = get_categories( array(
    	    'type' => $atts['post_type'], 'orderby' => 'name',
    	    'order' => 'ASC', 'hide_empty' => false, 'exclude' => $atts['exclude'],
    	    'parent' => $atts['cat']->cat_ID, 'taxonomy' => $atts['taxonomy'],
    	));

    	if ( $children ) {
    	    $atts['level']++;
    	    foreach ( $children as $key => $cat ) {
    	        $atts['cat'] = $cat; ?>
    	<div class="frm_catlevel_<?php echo esc_attr( $atts['level'] ) ?>"><?php self::_show_category( $atts ); ?></div>
<?php       }
        }
    	echo '</div>';
    }

	public static function get_status_options( $field, $options = array() ) {
        $post_type = FrmProFormsHelper::post_type($field->form_id);
        $post_type_object = get_post_type_object($post_type);

        if ( ! $post_type_object ) {
            return $options;
        }

		$new_options = array();
		foreach ( $options as $opt_key => $opt ) {
			if ( is_array( $opt ) ){
				$opt_key = isset( $opt['value'] ) ? $opt['value'] : ( isset( $opt['label'] ) ? $opt['label'] : reset( $opt ) );
			} else {
				$opt_key = $opt;
			}
			if ( in_array( $opt_key, array( 'publish', 'private' ) ) ) {
				$new_options[ $opt_key ] = $opt;
			}
		}

		if ( ! empty( $new_options ) ) {
			return $new_options;
		}

        $can_publish = current_user_can($post_type_object->cap->publish_posts);
        $options = get_post_statuses(); //'draft', pending, publish, private

        // Contributors only get "Unpublished" and "Pending Review"
        if ( ! $can_publish ) {
        	unset($options['publish']);
			if ( isset( $options['future'] ) ) {
				unset( $options['future'] );
			}
        }
        return $options;
    }

	public static function get_user_options() {
        global $wpdb;
        $users = get_users( array( 'fields' => array( 'ID','user_login','display_name'), 'blog_id' => $GLOBALS['blog_id'], 'orderby' => 'display_name'));
        $options = array( '' => '');
		foreach ( $users as $user ) {
			$options[ $user->ID ] = ( ! empty( $user->display_name ) ) ? $user->display_name : $user->user_login;
		}
        return $options;
    }

    public static function get_linked_options( $values, $field, $entry_id = false ) {
		_deprecated_function( __FUNCTION__, '2.01.0', 'FrmProDynamicFieldsController::get_independent_options' );
		return FrmProDynamicFieldsController::get_independent_options( $values, $field, $entry_id );
    }

    public static function include_blank_option($options, $field) {
        _deprecated_function( __FUNCTION__, '2.01.0', 'FrmProDynamicFieldsController::include_blank_option' );
		return FrmProDynamicFieldsController::include_blank_option( $options, $field );
    }

	public static function get_time_options( $values ) {
		if ( empty( $values['start_time'] ) ) {
			$values['start_time'] = '00:00';
		}

		if ( empty( $values['end_time'] ) ) {
			$values['end_time'] = '23:59';
		}

        $time = strtotime($values['start_time']);
        $end_time = strtotime($values['end_time']);
        $step = explode(':', $values['step']);
        $step = (isset($step[1])) ? ($step[0] * 3600 + $step[1] * 60) : ($step[0] * 60);
        if ( empty($step) ) {
            // force an hour step if none was defined to prevent infinite loop
            $step = 60;
        }
        $format = ($values['clock'] == 24) ? 'H:i' : 'h:i A';

        $options = array( '' );
		while ( $time <= $end_time ) {
            $options[] = date($format, $time);
            $time += $step;
        }

        return $options;

        /*
        //Separate dropdowns
        $step = $values['step'];
        $hour_step = floor($step / 60);
        if(!$hour_step)
            $hour_step = 1;
        $start_time = $values['start_time'];
        $end_time = $values['end_time'];
        $show24Hours = ((isset($values['clock']) and $values['clock'] == 24) ? true : false);
        $separator = ':';

        $start = explode($separator, $start_time);
        $end = explode($separator, $end_time);

        if($end[0] < $start[0])
            $end[0] += 12;

        $options = array();
        $options['H'] = range($start[0], $end[0], $hour_step);
        foreach($options['H'] as $k => $h){
            if(!$show24Hours and $h > 12)
                $options['H'][$k] = $h - 12;

            if(!$options['H'][$k]){
                unset($options['H'][$k]); //remove 0
                continue;
            }

            if($options['H'][$k] < 10)
                $options['H'][$k] = '0'. $options['H'][$k];

            unset($k);
            unset($h);
        }
        $options['H'] = array_unique($options['H']);
        sort($options['H']);
        array_unshift($options['H'], '');

        if($step > 60){
            if($step %60 == 0){
                //the step is an even hour
                $step = 60;
            }else{
                //get the number of minutes
                $step = $step - ($hour_step*60);
            }
        }

        $options['m'] = range($start[1], 59, $step);
        foreach($options['m'] as $k => $m){
            if($m < 10)
                $options['m'][$k] = '0'. $m;
            unset($k);
            unset($m);
        }

        array_unshift($options['m'], '');

        if(!$show24Hours)
            $options['A'] = array( '', 'AM', 'PM');

        return $options;*/
    }

    public static function posted_field_ids( $where ) {
		$form_id = FrmAppHelper::get_post_param( 'form_id', 0, 'absint' );
		if ( $form_id && FrmProFormsHelper::has_another_page( $form_id ) ) {
			$where['fi.field_order <'] = FrmAppHelper::get_post_param( 'frm_page_order_' . $form_id, 0, 'absint' );
        }
        return $where;
    }

	public static function set_field_js( $field, $id = 0 ) {
        global $frm_vars;

        if ( ! isset($frm_vars['datepicker_loaded']) || ! is_array($frm_vars['datepicker_loaded']) ) {
            return;
        }

        $field_key = '';
        if ( isset($frm_vars['datepicker_loaded']['^field_'. $field['field_key']]) && $frm_vars['datepicker_loaded']['^field_'. $field['field_key']] ) {
            $field_key = '^field_'. $field['field_key'];
        } else if ( isset($frm_vars['datepicker_loaded']['field_'. $field['field_key']]) && $frm_vars['datepicker_loaded']['field_'. $field['field_key']] ) {
            $field_key = 'field_'. $field['field_key'];
        }

        if ( empty($field_key) ) {
            return;
        }

		$field[ 'start_year' ] = self::convert_to_static_year( $field[ 'start_year' ] );
		$field[ 'end_year' ] = self::convert_to_static_year( $field[ 'end_year' ] );

		$default_date = self::get_default_cal_date( $field['start_year'], $field['end_year'] );

        $field_js = array(
            'start_year' => $field['start_year'], 'end_year' => $field['end_year'],
            'locale' => $field['locale'], 'unique' => $field['unique'],
            'field_id' => $field['id'], 'entry_id' => $id, 'default_date' => $default_date,
        );
        $frm_vars['datepicker_loaded'][$field_key] = $field_js;
    }

	/**
	 * If using -100, +10, or maybe just 10 for the start or end year
	 * @since 2.0.12
	 */
	public static function convert_to_static_year( $year ) {
		if ( strlen( $year ) != 4 || strpos( $year, '-' ) !== false || strpos( $year, '+' ) !== false ) {
			$year = date( 'Y', strtotime( $year .' years' ) );
		}
		return (int) $year;
	}

	/**
	* Set the default date for jQuery calendar
	*
	* @since 2.0.12
	* @param int $start_year
	* @param int $end_year
	* @return string $default_date
	*/
	private static function get_default_cal_date( $start_year, $end_year ) {
		$current_year = (int) date('Y');

		// If current year falls inside of the date range, make the default date today's date
		if ( $current_year >= $start_year && $current_year <= $end_year ) {
			$default_date = '';
		} else {
			$default_date = 'January 1, ' . $start_year . ' 00:00:00';
		}

		return $default_date;
	}

    public static function get_form_fields( $fields, $form_id, $error = false ) {
		global $frm_vars;

		$page_numbers = self::get_base_page_info( compact( 'fields', 'form_id', 'error' ) );

		$ajax = FrmProFormsHelper::has_form_setting( array( 'form_id' => $form_id, 'setting_name' => 'ajax_submit', 'expected_setting' => 1 ) );

		foreach ( (array) $fields as $k => $f ) {

			// prevent sub fields from showing
			if ( $f->form_id != $form_id ) {
				unset( $fields[ $k ] );
			}

			if ( $ajax ) {
				self::set_ajax_field_globals( $f );
			}

			if ( $f->type != 'break' ) {
				continue;
			}

			$page_numbers['page_breaks'][ $f->field_order ] = $f;

			self::get_next_and_prev_page( $f, $error, $page_numbers );

			unset( $f, $k );
		}
		unset( $ajax );

		if ( empty( $page_numbers['page_breaks'] ) ) {
			// there are no page breaks, so let's not check the pagination
			return $fields;
		}

        if ( ! $page_numbers['prev_page_obj'] && $page_numbers['prev_page'] ) {
            $page_numbers['prev_page'] = 0;
        }

		self::skip_conditional_pages( $page_numbers );
		self::set_prev_page_global( $form_id, $page_numbers );
		self::set_next_page_to_field_order( $form_id, $page_numbers );

		self::set_page_num_global( $page_numbers );

        unset( $page_numbers['page_breaks'] );

		self::set_fields_to_hidden( $fields, $page_numbers );

        return $fields;
    }

	/**
	 * @param array $atts - includes form_id, error, fields
	 */
	public static function get_base_page_info( $atts ) {
		$page_numbers = array(
			'page_breaks' => array(), 'go_back' => false, 'next_page' => false,
			'set_prev' => 0, 'set_next' => false,
			'get_last' => false, 'prev_page_obj' => false,
			'prev_page' => FrmAppHelper::get_param( 'frm_page_order_' . $atts['form_id'], false, 'get', 'absint' ),
		);

		if ( FrmProFormsHelper::going_to_prev( $atts['form_id'] ) ) {
			$page_numbers['go_back'] = true;
			$page_numbers['next_page'] = FrmAppHelper::get_param( 'frm_next_page' );
			$page_numbers['prev_page'] = $page_numbers['set_prev'] = $page_numbers['next_page'] - 1;
		} else if ( FrmProFormsHelper::saving_draft() && ! $atts['error'] ) {
			$page_numbers['next_page'] = FrmAppHelper::get_param( 'frm_page_order_' . $atts['form_id'], false );

			// If next_page is zero, assume user clicked "Save Draft" on last page of form
			if ( $page_numbers['next_page'] == 0 ) {
				$page_numbers['next_page'] = count( $atts['fields'] );
			}

			$page_numbers['prev_page'] = $page_numbers['set_prev'] = $page_numbers['next_page'] - 1;
		}

        if ( $atts['error'] ) {
            $page_numbers['set_prev'] = $page_numbers['prev_page'];

            if ( $page_numbers['prev_page'] ) {
                $page_numbers['prev_page'] = $page_numbers['prev_page'] - 1;
            } else {
                $page_numbers['prev_page'] = 999;
                $page_numbers['get_last'] = true;
            }
        }

		return $page_numbers;
	}

	/**
	 * When a form is loaded with ajax, we need all the info for
	 * the fields included in the footer with the first page
	 */
	private static function set_ajax_field_globals( $f ) {
		global $frm_vars;
		$ajax_now = ! FrmAppHelper::doing_ajax();
		if ( ! $ajax_now && isset( $frm_vars['inplace_edit'] ) && $frm_vars['inplace_edit'] ) {
			$ajax_now = true;
		}

		switch ( $f->type ) {
			case 'date':
				if ( ! FrmField::is_read_only( $f ) ) {
					if ( ! isset( $frm_vars['datepicker_loaded'] ) || ! is_array( $frm_vars['datepicker_loaded'] ) ) {
						$frm_vars['datepicker_loaded'] = array();
					}
					$frm_vars['datepicker_loaded'][ 'field_' . $f->field_key ] = $ajax_now;
				}
			break;
			case 'time':
				if ( isset( $f->field_options['unique'] ) && $f->field_options['unique'] ) {
					if ( ! isset( $frm_vars['timepicker_loaded'] ) ) {
						$frm_vars['timepicker_loaded'] = array();
					}
					$frm_vars['timepicker_loaded'][ 'field_' . $f->field_key ] = $ajax_now;
				}
			break;
			case 'phone':
				if ( isset( $f->field_options['format'] ) && ! empty( $f->field_options['format'] ) && strpos( $f->field_options['format'], '^' ) !== 0 ) {
					global $frm_input_masks;
					$frm_input_masks[] = $ajax_now;
				}
			break;
		}
	}

	private static function get_next_and_prev_page( $f, $error, &$page_numbers ) {
        if ( ( $page_numbers['prev_page'] || $page_numbers['go_back'] ) && ! $page_numbers['get_last'] ) {
            if ( ( ( $error || $page_numbers['go_back'] ) && $f->field_order < $page_numbers['prev_page'] ) || ( ! $error && ! $page_numbers['go_back'] && ! $page_numbers['prev_page_obj'] && $f->field_order == $page_numbers['prev_page'] ) ) {
                $page_numbers['prev_page_obj'] = true;
                $page_numbers['prev_page'] = $f->field_order;
            } else if ( $page_numbers['set_prev'] && $f->field_order < $page_numbers['set_prev'] ) {
                $page_numbers['prev_page_obj'] = true;
                $page_numbers['prev_page'] = $f->field_order;
            } else if ( ( $f->field_order > $page_numbers['prev_page'] ) && ! $page_numbers['set_next'] && ( ! $page_numbers['next_page'] || is_numeric( $page_numbers['next_page'] ) ) ) {
                $page_numbers['next_page'] = $f;
                $page_numbers['set_next'] = true;
            }
		} else if ( $page_numbers['get_last'] ) {
            $page_numbers['prev_page_obj'] = true;
            $page_numbers['prev_page'] = $f->field_order;
            $page_numbers['next_page'] = false;
        } else if ( ! $page_numbers['next_page'] ) {
            $page_numbers['next_page'] = $f;
        } else if ( is_numeric( $page_numbers['next_page'] ) && $f->field_order == $page_numbers['next_page'] ) {
            $page_numbers['next_page'] = $f;
        }
	}

	private static function skip_conditional_pages( &$page_numbers ) {
		if ( $page_numbers['prev_page'] ) {
            $current_page = $page_numbers['page_breaks'][ $page_numbers['prev_page'] ];
            if ( self::is_field_hidden( $current_page, stripslashes_deep( $_POST ) ) ) {
                $current_page = apply_filters( 'frm_get_current_page', $current_page, $page_numbers['page_breaks'], $page_numbers['go_back'] );
				if ( ! $current_page || $current_page->field_order != $page_numbers['prev_page'] ) {
					$page_numbers['prev_page'] = $current_page ? $current_page->field_order : 0;
                    foreach ( $page_numbers['page_breaks'] as $o => $pb ) {
                        if ( $o > $page_numbers['prev_page'] ) {
                            $page_numbers['next_page'] = $pb;
                            break;
                        }
                    }

					if ( $page_numbers['next_page']->field_order <= $page_numbers['prev_page'] ) {
                        $page_numbers['next_page'] = false;
					}
                }
            }
        }
	}

	private static function set_prev_page_global( $form_id, $page_numbers ) {
		global $frm_vars;
		if ( $page_numbers['prev_page'] ) {
			$frm_vars['prev_page'][ $form_id ] = $page_numbers['prev_page'];
		} else {
			unset( $frm_vars['prev_page'][ $form_id ] );
		}
	}

	private static function set_next_page_to_field_order( $form_id, &$page_numbers ) {
		global $frm_vars;
		if ( $page_numbers['next_page'] ) {
			if ( is_numeric( $page_numbers['next_page'] ) && isset( $page_numbers['page_breaks'][ $page_numbers['next_page'] ] ) ) {
				$page_numbers['next_page'] = $page_numbers['page_breaks'][ $page_numbers['next_page'] ];
			}

			if ( ! is_numeric( $page_numbers['next_page'] ) ) {
				$frm_vars['next_page'][ $form_id ] = $page_numbers['next_page'];
				$page_numbers['next_page'] = $page_numbers['next_page']->field_order;
			}
		}else{
			unset( $frm_vars['next_page'][ $form_id ] );
		}
	}

	private static function set_page_num_global( $page_numbers ) {
		global $frm_page_num;
        $pages = array_keys( $page_numbers['page_breaks'] );
        $frm_page_num = $page_numbers['prev_page'] ? ( array_search( $page_numbers['prev_page'], $pages ) + 2 ) : 1;
	}

	private static function set_fields_to_hidden( &$fields, $page_numbers ) {
		if ( $page_numbers['next_page'] || $page_numbers['prev_page'] ) {
			foreach ( $fields as $f ) {
				if ( $f->type == 'hidden' || $f->type == 'user_id' ) {
                    continue;
				}

				if ( self::hide_on_page( $page_numbers, $f ) ) {
					$f->field_options['original_type'] = $f->type;
					$f->type = 'hidden';
                }

                unset($f);
            }
        }
	}

	/**
	 * Check if a field should be hidden on the current page
	 */
	private static function hide_on_page( $page_numbers, $f ) {
		return ( $page_numbers['prev_page'] && $page_numbers['next_page'] && ( $f->field_order < $page_numbers['prev_page'] ) && ( $f->field_order > $page_numbers['next_page'] ) ) || ( $page_numbers['prev_page'] && $f->field_order < $page_numbers['prev_page'] ) || ( $page_numbers['next_page'] && $f->field_order > $page_numbers['next_page'] );
	}

	public static function get_current_page( $next_page, $page_breaks, $go_back, $order = 'asc' ) {
        $first = $next_page;
        $set_back = false;

        if ( $go_back && $order == 'asc' ) {
            $order = 'desc';
            $page_breaks = array_reverse( $page_breaks, true );
        }

		foreach ( $page_breaks as $pb ) {
			if ( $go_back && $pb->field_order < $next_page->field_order ) {
				$next_page = $pb;
				$set_back = true;
				break;
			} else if ( ! $go_back && $pb->field_order > $next_page->field_order && $pb->field_order != $first->field_order ) {
				$next_page = $pb;
				break;
			}
			unset( $pb );
		}

        if ( $go_back && ! $set_back ) {
            $next_page = 0;
        }

		if ( self::skip_next_page( $next_page ) ) {
			if ( $first == $next_page ) {
				// the last page is conditional
				$next_page = -1;
			} else {
				$next_page = self::get_current_page( $next_page, $page_breaks, $go_back, $order );
			}
		}

        return $next_page;
    }

	private static function skip_next_page( $next_page ) {
		return $next_page && self::is_field_hidden( $next_page, stripslashes_deep( $_POST ) );
	}

    public static function show_custom_html($show, $field_type) {
        if ( in_array($field_type, array( 'hidden', 'user_id', 'break', 'end_divider')) ) {
            $show = false;
        }
        return $show;
    }

	public static function get_default_html( $default_html, $type ) {
		if ( $type == 'divider' ) {
            $default_html = <<<DEFAULT_HTML
<div id="frm_field_[id]_container" class="frm_form_field frm_section_heading form-field[error_class]">
<h3 class="frm_pos_[label_position][collapse_class]">[field_name]</h3>
[if description]<div class="frm_description">[description]</div>[/if description]
[collapse_this]
</div>
DEFAULT_HTML;
		} else if ( $type == 'html' ) {
            $default_html = '<div id="frm_field_[id]_container" class="frm_form_field form-field">[description]</div>';
        } else if ( $type == 'form' ) {
            $default_html = <<<DEFAULT_HTML
<div id="frm_field_[id]_container" class="frm_form_field form-field [required_class][error_class]">
[input]
</div>
DEFAULT_HTML;
        }

        return $default_html;
    }

    /**
    * Check if field is radio or Dynamic radio
    *
    * Since 2.0
    *
    * @param array $field
    * @return boolean true if field type is radio or Dynamic radio
    */
    public static function is_radio( $field ) {
        return ( $field['type'] == 'radio' || ( $field['type'] == 'data' && $field['data_type'] == 'radio' ) || ( $field['type'] == 'lookup' && $field['data_type'] == 'radio' ) );
    }

    /**
    * Check if field is checkbox or Dynamic checkbox
    *
    * Since 2.0
    *
    * @param array $field
    * @return boolean true if field type is checkbox or Dynamic checkbox
    */
    public static function is_checkbox( $field ) {
        return ( $field['type'] == 'checkbox' || ( $field['type'] == 'data' && $field['data_type'] == 'checkbox' ) || ( $field['type'] == 'lookup' && $field['data_type'] == 'checkbox' ) );
    }

	/**
	 * Check if the field is a dynamic list field
	 * @since 2.0.5
	 */
	public static function is_list_field( $field ) {
		_deprecated_function( __FUNCTION__, '2.0.9', 'FrmProField::is_list_field' );
		return FrmProField::is_list_field( $field );
	}

	public static function is_read_only( $field ) {
		_deprecated_function( __FUNCTION__, '2.0.9', 'FrmField::is_read_only' );
		return FrmField::is_read_only( $field );
	}

	public static function before_replace_shortcodes( $html, $field ) {
		$is_radio = self::is_radio( $field );
		$is_checkbox = self::is_checkbox( $field );

		if ( isset( $field['align'] ) && ( $is_radio || $is_checkbox ) ) {
            $required_class = '[required_class]';

			$radio_align = ( $is_radio && $field['align'] != FrmStylesController::get_style_val( 'radio_align', $field['form_id'] ) );
			$check_align = ( $is_checkbox && $field['align'] != FrmStylesController::get_style_val( 'check_align', $field['form_id'] ) );

			if ( $radio_align || $check_align ) {
				$required_class .= ( $field['align'] == 'inline' ) ? ' horizontal_radio' : ' vertical_radio';
                $html = str_replace('[required_class]', $required_class, $html);
            }
        }

		if ( isset( $field['classes'] ) && strpos( $field['classes'], 'frm_grid' ) !== false ) {
            $opt_count = count($field['options']) + 1;
            $html = str_replace('[required_class]', '[required_class] frm_grid_'. $opt_count, $html);
			if ( strpos( $html, ' horizontal_radio' ) ) {
                $html = str_replace(' horizontal_radio', ' vertical_radio', $html);
			}
            unset($opt_count);
        }

        return $html;
    }

    public static function replace_html_shortcodes($html, $field, $atts) {
        if ( 'divider' == $field['type'] ) {
            global $frm_vars;

            $html = str_replace( array( 'frm_none_container', 'frm_hidden_container', 'frm_top_container', 'frm_left_container', 'frm_right_container'), '', $html);

            if ( isset($frm_vars['collapse_div']) && $frm_vars['collapse_div'] ) {
                $html = "</div>\n". $html;
                $frm_vars['collapse_div'] = false;
            }

			if ( isset($frm_vars['div']) && $frm_vars['div'] && $frm_vars['div'] != $field['id'] ) {
				// close the div if it's from a different section
				$html = "</div>\n". $html;
				$frm_vars['div'] = false;
			}

			if ( FrmField::is_option_true( $field, 'slide' ) ) {
                $trigger = ' frm_trigger';
                $collapse_div = '<div class="frm_toggle_container" style="display:none;">';
            } else {
                $trigger = $collapse_div = '';
            }

			if ( FrmField::is_option_true( $field, 'repeat' ) ) {
                $errors = isset($atts['errors']) ? $atts['errors'] : array();
                $field_name = 'item_meta['. $field['id'] .']';
                $html_id = FrmFieldsHelper::get_html_id($field);
                $frm_settings = FrmAppHelper::get_settings();

                ob_start();
                include(FrmAppHelper::plugin_path() .'/classes/views/frm-fields/input.php');
                $input = ob_get_contents();
                ob_end_clean();

				if ( FrmField::is_option_true( $field, 'slide' ) ) {
                    $input = $collapse_div . $input .'</div>';
                }

                $html = str_replace('[collapse_this]', $input, $html);

            } else {
				self::remove_close_div( $field, $html );

                if ( strpos($html, '[collapse_this]') !== false ) {
                    $html = str_replace('[collapse_this]', $collapse_div, $html);

                    // indicate that a second div is open
                    if ( ! empty($collapse_div) ) {
                        $frm_vars['collapse_div'] = $field['id'];
                    }
                }
            }

			self::maybe_add_collapse_icon( $trigger, $field, $html );

            $html = str_replace('[collapse_class]', $trigger, $html);
		} else if ( $field['type'] == 'html' ) {
			if ( apply_filters( 'frm_use_wpautop', true ) ) {
				$html = wpautop( $html );
			}
            $html = apply_filters('frm_get_default_value', $html, (object) $field, false);
            $html = do_shortcode($html);
		} else if ( FrmField::is_option_true( $field, 'conf_field' ) ) {
			$html .= self::get_confirmation_field_html( $field, $atts );
		}

        if ( strpos($html, '[collapse_this]') ) {
            $html = str_replace('[collapse_this]', '', $html);
        }

        return $html;
	}

	/**
	 * Get the HTML for a confirmation field
	 *
	 * @param array $field
	 * @param array $atts
	 * @return string
	 */
	private static function get_confirmation_field_html( $field, $atts ) {
		$conf_field = self::create_confirmation_field_array( $field, $atts );

		$args = self::generate_repeat_args_for_conf_field( $field, $atts );

		// Replace shortcodes
		$conf_html = FrmFieldsHelper::replace_shortcodes( $field['custom_html'], $conf_field, $atts['errors'], '', $args);

		// Add a couple of classes
		$label_class = 'frm_primary_label';
		if ( strpos( $conf_html, $label_class ) === false ) {
			$label_class = 'frm_pos_';
		}
		$conf_html = str_replace( $label_class, 'frm_conf_label ' . $label_class, $conf_html );

		$container_class = 'frm_form_field';
		if ( strpos( $conf_html, $container_class ) === false ) {
			$container_class = 'form-field';
		}
		$conf_html = str_replace( $container_class, $container_class . ' frm_conf_field', $conf_html );

		// Remove label if stacked. Hide if inline.
		if ( $field['conf_field'] == 'inline' ) {
			$conf_html = str_replace( $container_class, $container_class . ' frm_hidden_container', $conf_html );
		} else {
		   $conf_html = str_replace( $container_class, $container_class . ' frm_none_container', $conf_html );
		}

		return $conf_html;
	}

	/**
	 * Create a confirmation field array to prepare for replace_shortcodes function
	 *
	 * @since 2.0.25
	 * @param array $field
	 * @param array $atts
	 * @return array
	 */
	private static function create_confirmation_field_array( $field, $atts ) {
		$conf_field = $field;

		$conf_field['id'] = 'conf_' . $field['id'];
		$conf_field['name'] = __( 'Confirm', 'formidable' ) . ' ' . $field['name'];
		$conf_field['description'] = $field['conf_desc'];
		$conf_field['field_key'] = 'conf_' . $field['field_key'];

		if ( $conf_field['classes'] ) {
			$conf_field['classes'] = str_replace( array( 'first_', 'frm_first' ), '', $conf_field['classes'] );
		} else if ( $conf_field['conf_field'] == 'inline' ) {
			$conf_field['classes'] = ' frm_half';
		}

		//Prevent loop
		$conf_field['conf_field'] = 'stop';

		// Filter default value/placeholder text
		$field['conf_input'] = apply_filters('frm_get_default_value', $field['conf_input'], (object) $field, false);

		//If clear on focus, set default value. Otherwise, set value.
		if ( $conf_field['clear_on_focus'] == 1 ) {
			$conf_field['default_value'] = $field['conf_input'];
			$conf_field['value'] = '';
		} else {
			$conf_field['value'] = $field['conf_input'];
		}

		//If going back and forth between pages, keep value in confirmation field
		if ( ( ! isset( $conf_field['reset_value'] ) || ! $conf_field['reset_value'] ) && isset( $_POST['item_meta'] ) ) {
			$temp_args = array();
			if ( isset( $atts['section_id'] ) ) {
				$temp_args = array( 'parent_field_id' => $atts['section_id'], 'key_pointer' => str_replace( '-', '', $atts['field_plus_id'] ) );
			}
			FrmEntriesHelper::get_posted_value( $conf_field['id'], $conf_field['value'], $temp_args );
		}

		return $conf_field;
	}

	/**
	 * Generate the repeat args for a confirmation field
	 *
	 * @since 2.0.25
	 * @param array $field
	 * @param array $atts
	 * @return array
	 */
	private static function generate_repeat_args_for_conf_field( $field, $atts ) {
		//If inside of repeating section
		$args = array();
		if ( isset( $atts['section_id'] ) ) {
			$args['field_name'] = preg_replace('/\[' . $field['id'] . '\]$/', '', $atts['field_name']);
			$args['field_name'] = $args['field_name'] . '[conf_' . $field['id'] . ']';
			$args['field_id'] = 'conf_' . $atts['field_id'];
			$args['field_plus_id'] = $atts['field_plus_id'];
			$args['section_id'] = $atts['section_id'];
		}

		return $args;
	}

	/**
	* Remove the close div from HTML (specifically for divider field types)
	*
	* @since 2.0.09
	* @param string $html - pass by reference
	*/
	private static function remove_close_div( $field, &$html ) {
		$end_div = '/\<\/div\>(\s*)?$/';
		if ( preg_match( $end_div, $html ) ) {
			global $frm_vars;
			// indicate that the div is open
			$frm_vars['div'] = $field['id'];

			$html = preg_replace( $end_div, '', $html );
		}
	}

	/**
	* Add the collapse icon next to collapsible section headings
	*
	* @since 2.0.14
	*
	* @param string $trigger
	* @param array $field
	* @param string $html, pass by reference
	*/
	private static function maybe_add_collapse_icon( $trigger, $field, &$html ) {
		if ( ! empty( $trigger ) ) {
			$style = FrmStylesController::get_form_style( $field['form_id'] );

			preg_match_all( "/\<h[2-6]\b(.*?)(?:(\/))?\>(.*?)(?:(\/))?\<\/h[2-6]>/su", $html, $headings, PREG_PATTERN_ORDER);

			if ( isset( $headings[3] ) && ! empty( $headings[3] ) ) {
				$header_text = reset( $headings[3] );
				$old_header_html = reset( $headings[0] );

				if ( 'before' == $style->post_content['collapse_pos'] ) {
					$new_header_html = str_replace( $header_text, '<i class="frm_icon_font frm_arrow_icon"></i> ' . $header_text, $old_header_html );
				} else {
					$new_header_html = str_replace( $header_text, $header_text . '<i class="frm_icon_font frm_arrow_icon"></i> ', $old_header_html );
				}

				$html = str_replace( $old_header_html, $new_header_html, $html );

			}
		}
	}

	public static function get_export_val( $val, $field, $entry = array() ) {
		if ( $field->type == 'user_id' ) {
            $val = self::get_display_name($val, 'user_login');
		} else if ( $field->type == 'file' ) {
            $val = self::get_file_name($val, false);
		} else if ( $field->type == 'date' ) {
            $wp_date_format = apply_filters('frm_csv_date_format', 'Y-m-d');
            $val = self::get_date($val, $wp_date_format);
		} else if ( $field->type == 'data' ) {
            $new_val = maybe_unserialize($val);

			if ( empty( $new_val ) && ! empty( $entry ) && FrmProField::is_list_field( $field ) ) {
				FrmProEntriesHelper::get_dynamic_list_values( $field, $entry, $new_val );
			}

			if ( is_numeric( $new_val ) ) {
                $val = self::get_data_value($new_val, $field); //replace entry id with specified field
			} else if ( is_array( $new_val ) ) {
                $field_value = array();
				foreach ( $new_val as $v ) {
                    $field_value[] = self::get_data_value($v, $field);
                    unset($v);
                }
                $val = implode(', ', $field_value);
            }
		}

        return $val;
    }

	public static function get_file_icon( $media_id ) {
        if ( ! $media_id || ! is_numeric( $media_id ) ) {
            return;
        }

        $attachment = get_post($media_id);
        if ( ! $attachment ) {
            return;
        }

        $image = $orig_image = wp_get_attachment_image($media_id, 'thumbnail', true);

        //if this is a mime type icon
        if ( $image && ! preg_match("/wp-content\/uploads/", $image) ) {
            $label = basename($attachment->guid);
            $image .= " <span id='frm_media_$media_id' class='frm_upload_label'><a href='". wp_get_attachment_url($media_id) ."'>$label</a></span>";
        } else if ( $image ) {
			$image = '<a href="' . esc_url( wp_get_attachment_url( $media_id ) ) . '" class="frm_file_link">' . $image . '</a>';
        }

        $image = apply_filters('frm_file_icon', $image, array( 'media_id' => $media_id, 'image' => $orig_image));

        return $image;
    }

    public static function get_file_name( $media_ids, $short = true ) {
        $value = '';
        foreach ( (array) $media_ids as $media_id ) {
            if ( ! is_numeric($media_id) ) {
                continue;
            }

            $attachment = get_post($media_id);
            if ( ! $attachment ) {
                continue;
            }

            $url = wp_get_attachment_url($media_id);

            $label = $short ? basename($attachment->guid) : $url;
			$action = FrmAppHelper::simple_get( 'action', 'sanitize_title' );
			$frm_action = FrmAppHelper::simple_get( 'frm_action', 'sanitize_title' );

            if ( $frm_action == 'csv' || $action == 'frm_entries_csv' ) {
                if ( !empty($value) ) {
                    $value .= ', ';
                }
            } else if ( FrmAppHelper::is_admin() ) {
				$url = '<a href="' . esc_url( $url ) . '">' . $label . '</a>';
				if ( strpos( FrmAppHelper::simple_get( 'page', 'sanitize_title' ), 'formidable' ) === 0 ) {
					$url .= '<br/><a href="' . esc_url( admin_url( 'media.php?action=edit&attachment_id=' . $media_id ) ) . '">' . __( 'Edit Uploaded File', 'formidable' ) . '</a>';
                }
            } else if ( !empty($value) ) {
                $value .= "<br/>\r\n";
            }

            $value .= $url;

            unset($media_id);
	    }

	    return $value;
    }

	/**
	* Get the value that will be displayed for a Dynamic Field
	*/
	public static function get_data_value( $value, $field, $atts = array() ) {
		// Make sure incoming data is in the right format
        if ( ! is_object($field) ) {
            $field = FrmField::getOne($field);
        }

		$linked_field_id = self::get_linked_field_id( $atts, $field );

		// If value is an entry ID and the Dynamic field is not mapped to a taxonomy
        if ( ctype_digit( $value ) && ( ! isset( $field->field_options['form_select'] ) || $field->field_options['form_select'] != 'taxonomy' ) && $linked_field_id ) {

			$linked_field = FrmField::getOne( $linked_field_id );

			// Get the value to display
			self::get_linked_field_val( $linked_field, $atts, $value );
        }

		// Implode arrays
		if ( is_array( $value ) ) {
            $value = implode( ( isset( $atts['sep'] ) ? $atts['sep'] : ', ' ), $value );
		}

        return $value;
    }

	/**
	* Get the ID of the linked field to display
	* Called by self::get_data_value
	*
	* @param $atts array
	* @param $field object
	* @return $linked_field_id int or false
	*/
	private static function get_linked_field_id( $atts, $field ) {
		// If show=25 or show="user_email" is set, then get that value
		if ( isset( $atts['show'] ) && $atts['show'] ) {
			$linked_field_id = $atts['show'];

		// If show=25 is NOT set, then just get the ID of the field selected in the Dynamic field's options
		} else if ( isset( $field->field_options['form_select'] ) && is_numeric( $field->field_options['form_select'] ) ) {
		    $linked_field_id = $field->field_options['form_select'];

		// The linked field ID could be false if Dynamic field is mapped to a taxonomy, using really old settings, or if settings were not completed
		} else {
			$linked_field_id = false;
		}
		return $linked_field_id;
	}

	/**
	* Get the value in the linked field
	* Called by self::get_data_value
	*
	* @param $linked_field object or false
	* @param $atts array
	* @param $value int
	*/
	private static function get_linked_field_val( $linked_field, $atts, &$value ) {
		$is_final_val = false;

		// If linked field is a post field
		if ( $linked_field && isset( $linked_field->field_options['post_field'] ) && $linked_field->field_options['post_field']  ) {
			$value = self::get_linked_post_field_val( $value, $atts, $linked_field );

		// If linked field
		} else if ( $linked_field ) {
		    $value = FrmEntryMeta::get_entry_meta_by_field( $value, $linked_field->id );

			if ( $value === null ) {
				return;
			}

		// No linked field (using show=ID, show="first_name", show="user_email", etc.)
		} else {
		    $user_id = FrmDb::get_var( 'frm_items', array( 'id' => $value), 'user_id' );
		    if ( $user_id ) {
				$show = isset( $atts['show'] ) ? $atts['show'] : 'display_name';
				$value = self::get_display_name( $user_id, $show, array( 'blank' => true ) );
		    } else {
		        $value = '';
		    }
			$is_final_val = true;
		}

		if ( ! $is_final_val ) {
			self::get_linked_field_display_val( $linked_field, $atts, $value );
		}
	}

	/**
	* Get the displayed value for Dynamic field that imports data from a post field
	* Called from self::get_linked_field_val
	*/
	private static function get_linked_post_field_val( $value, $atts, $linked_field ) {
		global $wpdb;
		$post_id = FrmDb::get_var($wpdb->prefix .'frm_items', array( 'id' => $value), 'post_id');
		if ( $post_id ) {
		    if ( ! isset($atts['truncate']) ) {
		        $atts['truncate'] = false;
		    }

		    $new_value = FrmProEntryMetaHelper::get_post_value($post_id, $linked_field->field_options['post_field'], $linked_field->field_options['custom_field'], array( 'form_id' => $linked_field->form_id, 'field' => $linked_field, 'type' => $linked_field->type, 'truncate' => $atts['truncate']));
		}else{
		    $new_value = FrmEntryMeta::get_entry_meta_by_field($value, $linked_field->id);
		}
		return $new_value;
	}

	/**
	* Get display value for linked field
	* Called by self::get_linked_field_val
	*/
	private static function get_linked_field_display_val( $linked_field, $atts, &$value ) {
		if ( $linked_field ) {
			if ( isset($atts['show']) && ! is_numeric($atts['show']) ) {
			    $atts['show'] = $linked_field->id;
			} else if ( isset($atts['show']) && ( (int) $atts['show'] == $linked_field->id || $atts['show'] == $linked_field->field_key ) ) {
			    unset($atts['show']);
			}

			// If user ID field, show display name by default
			if ( $linked_field->type == 'user_id' ) {
				unset( $atts['show'] );
			}

			if ( ! isset($atts['show']) && isset($atts['show_info']) ) {
			    $atts['show'] = $atts['show_info'];
				// Prevent infinite recursion
				unset( $atts['show_info'] );
			}

			$value = FrmFieldsHelper::get_display_value( $value, $linked_field, $atts );
		}
	}

    public static function get_date( $date, $date_format = false ) {
        if ( empty($date) ) {
            return $date;
        }

        if ( ! $date_format ) {
            $date_format = apply_filters( 'frm_date_format', get_option( 'date_format' ) );
        }

        if ( is_array($date) ) {
            $dates = array();
            foreach ( $date as $d ) {
                $dates[] = self::get_single_date($d, $date_format);
                unset($d);
            }
            $date = $dates;
        } else {
            $date = self::get_single_date($date, $date_format);
        }

        return $date;
    }

    public static function get_single_date($date, $date_format) {
		if ( preg_match( '/^\d{1-2}\/\d{1-2}\/\d{4}$/', $date ) ) {
            $frmpro_settings = new FrmProSettings();
            $date = FrmProAppHelper::convert_date($date, $frmpro_settings->date_format, 'Y-m-d');
        }

        return date_i18n($date_format, strtotime($date));
    }

    public static function get_display_name( $user_id, $user_info = 'display_name', $args = array() ) {
        $defaults = array(
            'blank' => false, 'link' => false, 'size' => 96
        );

        $args = wp_parse_args($args, $defaults);

        $user = get_userdata($user_id);
        $info = '';

        if ( $user ) {
            if ( $user_info == 'avatar' ) {
                $info = get_avatar( $user_id, $args['size'] );
            } else {
                $info = isset($user->$user_info) ? $user->$user_info : '';
            }

            if ( empty($info) && ! $args['blank'] ) {
                $info = $user->user_login;
            }
        }

        if ( $args['link'] ) {
			$info = '<a href="' .  esc_url( admin_url('user-edit.php?user_id=' . $user_id ) ) . '">' . $info . '</a>';
        }

        return $info;
    }

    public static function get_subform_ids(&$subforms, $field) {
        if ( isset($field->field_options['form_select']) && is_numeric($field->field_options['form_select']) ) {
            $subforms[] = $field->field_options['form_select'];
        }
    }

	public static function get_field_options( $form_id, $value = '', $include = 'not', $types = array(), $args = array() ) {
		$inc_embed = $inc_repeat = isset( $args['inc_sub'] ) ? $args['inc_sub'] : 'exclude';
		$fields = FrmField::get_all_for_form( (int) $form_id, '', $inc_embed, $inc_repeat );

		if ( empty( $fields ) ) {
			return;
		}

		if ( empty( $types) ) {
			$types = array( 'break', 'divider', 'end_divider', 'data', 'file', 'captcha', 'form' );
		} else if ( ! is_array( $types ) ) {
			$types = explode( ',', $types );
			$temp_types = $types;
			foreach ( $temp_types as $k => $t ) {
				$types[ $k ] = trim( $types[ $k ], "'" );
				unset( $k, $t );
			}
			unset( $temp_types );
		}

		foreach ( $fields as $field ) {
			$stop = ( $include != 'not' && ! in_array( $field->type, $types ) ) || ( $include == 'not' && in_array( $field->type, $types ) );
			if ( $stop || FrmProField::is_list_field( $field ) ) {
				continue;
			}
			unset( $stop );

            ?>
            <option value="<?php echo (int) $field->id ?>" <?php selected($value, $field->id) ?>><?php echo esc_html( FrmAppHelper::truncate($field->name, 50) ) ?></option>
        <?php
        }
    }

    public static function get_field_stats( $id, $type = 'total', $user_id = false, $value = false, $round = 100, $limit = '', $atts = array(), $drafts = false ) {
        global $wpdb, $frm_post_ids;

        $field = FrmField::getOne($id);

        if ( ! $field ) {
            return 0;
        }

        $id = $field->id;

        if ( isset($atts['thousands_sep']) && $atts['thousands_sep'] ) {
            $thousands_sep = $atts['thousands_sep'];
            unset($atts['thousands_sep']);
            $round = ( $round == 100 ? 2 : $round );
        }

        $where = array();
        if ( $value ) {
            $slash_val = ( strpos($value, '\\') === false ) ? addslashes($value) : $value;
			if ( FrmField::is_field_with_multiple_values( $field ) ) {
				$where[] = array( 'or' => 1, 'meta_value like' => $value, 'meta_value like ' => $slash_val );
                //add extra slashes to match values that are escaped in the database
            } else {
                //$where_value = $wpdb->prepare(" meta_value = %s", addcslashes( $slash_val, '_%' ) );
				$where[] = array( 'or' => 1, 'meta_value' => $value, 'meta_value ' => addcslashes( $slash_val, '_%' ) );
            }
            unset($slash_val);
        }

        //if(!$frm_post_ids)
            $frm_post_ids = array();

        $post_ids = array();

		if ( isset( $frm_post_ids[ $id ] ) ) {
            $form_posts = $frm_post_ids[$id];
        }else{
            $where_post = array( 'form_id' => $field->form_id, 'post_id >' => 1);
            if ( $drafts != 'both' ) {
                $where_post['is_draft'] = $drafts;
            }
            if ( $user_id ) {
                $where_post['user_id'] = $user_id;
            }

            $form_posts = FrmDb::get_results( 'frm_items', $where_post, 'id,post_id' );

            $frm_post_ids[$id] = $form_posts;
        }

		foreach ( (array) $form_posts as $form_post ) {
			$post_ids[ $form_post->id ] = $form_post->post_id;
		}

		if ( $value ) {
			$atts[ $id ] = $value;
		}

        if ( ! empty( $atts ) ) {
            $entry_ids = array();

			if ( isset( $atts['entry_id'] ) && $atts['entry_id'] && is_numeric( $atts['entry_id'] ) ) {
                $entry_ids[] = $atts['entry_id'];
			}

            $after_where = false;

			foreach ( $atts as $orig_f => $val ) {
                // Accommodate for times when users are in Visual tab
                $val = str_replace( array( '&gt;','&lt;'), array( '>','<'), $val );

                // If first character is a quote, but the last character is not a quote
				if ( ( strpos( $val, '"' ) === 0 && substr( $val, -1 ) != '"' ) || ( strpos( $val, "'" ) === 0 && substr( $val, -1 ) != "'" ) ) {
                    //parse atts back together if they were broken at spaces
                    $next_val = array( 'char' => substr($val, 0, 1), 'val' => $val);
                    continue;
                // If we don't have a previous value that needs to be parsed back together
                } else if ( ! isset($next_val) ) {
                    $temp = FrmAppHelper::replace_quotes($val);
					foreach ( array( '"', "'" ) as $q ) {
                        // Check if <" or >" exists in string and string does not end with ".
						if ( substr( $temp, -1 ) != $q && ( strpos( $temp, '<' . $q ) || strpos( $temp, '>' . $q ) ) ) {
                            $next_val = array( 'char' => $q, 'val' => $val);
                            $cont = true;
                        }
                        unset($q);
                    }
                    unset($temp);

                    if ( isset( $cont ) ) {
                        unset($cont);
                        continue;
                    }
                }

                // If we have a previous value saved that needs to be parsed back together (due to WordPress pullling it apart)
				if ( isset( $next_val ) ) {
					if ( substr( FrmAppHelper::replace_quotes( $val ), -1 ) == $next_val['char'] ) {
                        $val = $next_val['val'] .' '. $val;
                        unset($next_val);
					} else {
                        $next_val['val'] .= ' '. $val;
                        continue;
                    }
                }

                $entry_ids = self::get_field_matches(compact('entry_ids', 'orig_f', 'val', 'id', 'atts', 'field', 'form_posts', 'after_where', 'drafts'));
                $after_where = true;
            }

			if ( empty( $entry_ids ) ) {
				if ( $type == 'star' ) {
                    $stat = '';
                    ob_start();
                    include(FrmAppHelper::plugin_path() .'/pro/classes/views/frmpro-fields/star_disabled.php');
                    $contents = ob_get_contents();
                    ob_end_clean();
                    return $contents;
                }else{
                    return 0;
                }
            }

			foreach ( $post_ids as $entry_id => $post_id ) {
                if ( ! in_array($entry_id, $entry_ids) ) {
                    unset($post_ids[$entry_id]);
                }
            }

			$where['it.item_id'] = $entry_ids;
        }

        $join = '';

        if ( is_numeric( $id ) ) {
			$where['field_id'] = $id;
        }else{
            $join .= ' LEFT OUTER JOIN '. $wpdb->prefix .'frm_fields fi ON it.field_id=fi.id';
			$where['fi.field_key'] = $id;
        }

		if ( $user_id ) {
			$where['en.user_id'] = $user_id;
		}

        $join .= ' LEFT OUTER JOIN '. $wpdb->prefix .'frm_items en ON en.id=it.item_id';
        if ( $drafts != 'both' ) {
			$where['en.is_draft'] = $drafts;
        }

		$field_metas = FrmDb::get_col( $wpdb->prefix .'frm_item_metas it '. $join, $where, 'meta_value', array( 'order_by' => 'it.created_at DESC', 'limit' => $limit ) );

		if ( ! empty( $post_ids ) ) {
			if ( FrmField::is_option_true( $field, 'post_field' ) ) {
				if ( $field->field_options['post_field'] == 'post_custom' ) { //get custom post field value
                    $post_values = FrmDb::get_col( $wpdb->postmeta, array( 'meta_key' => $field->field_options['custom_field'], 'post_id' => $post_ids), 'meta_value' );
				} else if ( $field->field_options['post_field'] == 'post_category' ) {
					$post_query = array( 'tt.taxonomy' => $field->field_options['taxonomy'], 'tr.object_id' => $post_ids);

                    if ( $value ) {
						$post_query[] = array( 'or' => 1, 't.term_id' => $value, 't.slug' => $value, 't.name' => $value );
                    }

					$post_values = FrmDb::get_col( $wpdb->terms . ' AS t INNER JOIN ' . $wpdb->term_taxonomy . ' AS tt ON tt.term_id = t.term_id INNER JOIN ' . $wpdb->term_relationships . ' AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id', $post_query, 'tr.object_id' );
                    $post_values = array_unique($post_values);
                }else{
                    $post_values = FrmDb::get_results( $wpdb->posts, array( 'ID' => $post_ids), $field->field_options['post_field'] );
                }

                $field_metas = array_merge($post_values, $field_metas);
            }
        }

		if ( $type != 'star' ) {
            unset($field);
		}

		if ( empty( $field_metas ) ) {
            if ( $type == 'star' ) {
                $stat = '';
                ob_start();
                include(FrmAppHelper::plugin_path() .'/pro/classes/views/frmpro-fields/star_disabled.php');
                $contents = ob_get_contents();
                ob_end_clean();
                return $contents;
			} else {
                return 0;
            }
        }

        $count = count($field_metas);
        $total = array_sum($field_metas);

		switch ( $type ) {
            case 'average':
            case 'mean':
            case 'star':
                $stat = ($total / $count);
            break;
            case 'median':
                rsort($field_metas);
                $n = ceil($count / 2); // Middle of the array
				if ( $count % 2 ) {
                    $stat = $field_metas[$n-1]; // If number is odd
				} else {
                    $n2 = floor($count / 2); // Other middle of the array
                    $stat = ($field_metas[$n-1] + $field_metas[$n2-1]) / 2;
                }
                $stat = maybe_unserialize($stat);
                if (is_array($stat))
                    $stat = 0;
            break;
            case 'deviation':
                $mean = ($total / $count);
                $stat = 0.0;
				foreach ( $field_metas as $i ) {
                    $stat += pow($i - $mean, 2);
				}

				if ( $count > 1 ) {
                    $stat /= ( $count - 1 );

                    $stat = sqrt($stat);
				} else {
                    $stat = 0;
                }
            break;
            case 'minimum':
                $stat = min($field_metas);
            break;
            case 'maximum':
                $stat = max($field_metas);
            break;
            case 'count':
                $stat = $count;
            break;
            case 'unique':
                $stat = array_unique($field_metas);
                $stat = count($stat);
            break;
            case 'total':
            default:
                $stat = $total;
        }

        $stat = round($stat, $round);
		if ( $type == 'star' ) {
            ob_start();
            include(FrmAppHelper::plugin_path() .'/pro/classes/views/frmpro-fields/star_disabled.php');
            $contents = ob_get_contents();
            ob_end_clean();
            return $contents;
        }
        if ( ( $round && $round < 5 ) || isset($thousands_sep) ) {
            $thousands_sep = ( isset($thousands_sep) ? $thousands_sep : ',');
            $stat = number_format($stat, $round, '.', $thousands_sep);
        }

        return $stat;
    }

	public static function get_field_matches( $args ) {
        extract( $args );

        $f = $orig_f;
        $where_is = '=';

        //If using <, >, <=, >=, or != TODO: %, !%.
        //Note: $f will be numeric if using <, >, <=, >=, != OR if using x=val, but the code in the if/else statement will not actually do anything to x=val.
        if ( is_numeric( $f ) ) {//Note: $f will count up for certain atts
            $orig_val = $val;
            $lpos = strpos($val, '<');
            $gpos = strpos($val, '>');
            $not_pos = strpos($val, '!=');
            $dash_pos = strpos( $val, '-' );

			if ( $not_pos !== false ) { //If string contains !=

                //If entry IDs have not been set by a previous $atts
        		if ( empty( $entry_ids ) && $after_where == 0) {
                    $query = array( 'form_id' => $field->form_id);
                    //By default, don't get drafts
                    if ( $drafts != 'both' ) {
                        $query['is_draft'] = $drafts;
                    }
                    $entry_ids = FrmDb::get_col( 'frm_items', $query );
                    unset($query);
        		}

				$where_is = '!=';
				$str = explode( $where_is, $orig_val );
				$f = $str[0];
                $val = $str[1];
			} else if ( $lpos !== false || $gpos !== false ) { //If string contains greater than or less than
                $where_is = ( ( $gpos !== false && $lpos !== false && $lpos > $gpos ) || $lpos === false ) ? '>' : '<';
                $str = explode($where_is, $orig_val);

                if ( count( $str ) == 2 ) {
                    $f = $str[0];
                    $val = $str[1];
                } else if ( count( $str ) == 3 ) {
                    //3 parts assumes a structure like '-1 month'<255<'1 month'
                    $val = str_replace($str[0] . $where_is, '', $orig_val);
                    $entry_ids = self::get_field_matches(compact('entry_ids', 'orig_f', 'val', 'id', 'atts', 'field', 'form_posts', 'after_where', 'drafts'));

                    $after_where = true;

                    $f = $str[1];
                    $val = $str[0];
                    $where_is = ($where_is == '<') ? '>' : '<';
                }

                if ( strpos( $val, '=' ) === 0 ) {
                    $where_is .= '=';
                    $val = substr( $val, 1 );
                }

            // If field key contains a dash, then it won't be put in as $f automatically (WordPress quirk maybe?)
            // Use $f < 5 to decrease the likelihood of this section being used when $f is a field ID (like x=val)
            } else if ( $dash_pos !== false && strpos( $val, '=' ) !== false && $f < 5 ) {
                $str = explode( $where_is, $orig_val );
                $f = $str[0];
                $val = $str[1];
            }
        }

        // If this function has looped through at least once, and there aren't any entry IDs
        if ( $after_where && ! $entry_ids ) {
            return array();
        }

        //If using field key
        if ( ! is_numeric( $f ) ) {
            if ( in_array( $f, array( 'created_at', 'updated_at' ) ) ) {
                global $wpdb;

                $val = FrmAppHelper::replace_quotes( $val );
                $val = str_replace( array( '"', "'"), "", $val );
                $val = date( 'Y-m-d', strtotime($val) );

				$query = array(
					'form_id' => $field->form_id,
					$f . FrmDb::append_where_is( $where_is ) => $val,
				);

                // Entry IDs may be set even if after_where isn't true
                if ( $entry_ids ) {
					$query['id'] = $entry_ids;
                }

				$entry_ids = FrmDb::get_col( 'frm_items', $query );
                return $entry_ids;
            } else {
                //check for field keys
                $this_field = FrmField::getOne($f);
                if ( $this_field ) {
                    $f = $this_field->id;
                } else {
                    //If no field ID
                    return $entry_ids;
                }
                unset($this_field);
            }
        }
        unset($orig_f);

        //Prepare val
		$val = FrmAppHelper::replace_quotes( $val );
		$val = trim( trim( $val, "'" ), '"' );

        $where_atts = apply_filters('frm_stats_where', array( 'where_is' => $where_is, 'where_val' => $val), array( 'id' => $id, 'atts' => $atts));
        $val = $where_atts['where_val'];
        $where_is = $where_atts['where_is'];
        unset($where_atts);

        $entry_ids = FrmProAppHelper::filter_where($entry_ids, array(
            'where_opt' => $f, 'where_is' => $where_is, 'where_val' => $val,
            'form_id' => $field->form_id, 'form_posts' => $form_posts,
            'after_where' => $after_where, 'drafts' => $drafts,
        ));

        unset($f);
        unset($val);

        return $entry_ids;
    }

    public static function value_meets_condition($observed_value, $cond, $hide_opt) {
        _deprecated_function( __FUNCTION__, '2.0', 'FrmFieldsHelper::value_meets_condition' );
        return FrmFieldsHelper::value_meets_condition($observed_value, $cond, $hide_opt);
    }

	public static function get_shortcode_select( $form_id, $target_id = 'content', $type = 'all' ) {
        $field_list = array();
		$exclude = FrmField::no_save_fields();

        if ( is_numeric($form_id) ) {
            if ( $type == 'field_opt' ) {
                $exclude[] = 'data';
                $exclude[] = 'checkbox';
            }

            $field_list = FrmField::get_all_for_form($form_id, '', 'include');
        }

        $linked_forms = array();
        ?>
        <select class="frm_shortcode_select frm_insert_val" data-target="<?php echo esc_attr( $target_id ) ?>">
            <option value="">&mdash; <?php _e( 'Select a value to insert into the box below', 'formidable' ) ?> &mdash;</option>
            <?php if ( $type != 'field_opt' && $type != 'calc' ) { ?>
            <option value="id"><?php _e( 'Entry ID', 'formidable' ) ?></option>
            <option value="key"><?php _e( 'Entry Key', 'formidable' ) ?></option>
            <option value="post_id"><?php _e( 'Post ID', 'formidable' ) ?></option>
            <option value="ip"><?php _e( 'User IP', 'formidable' ) ?></option>
            <option value="created-at"><?php _e( 'Entry creation date', 'formidable' ) ?></option>
            <option value="updated-at"><?php _e( 'Entry update date', 'formidable' ) ?></option>

			<optgroup label="<?php esc_attr_e( 'Form Fields', 'formidable' ) ?>">
            <?php }

            if ( ! empty($field_list) ) {
            foreach ( $field_list as $field ) {
                if ( in_array($field->type, $exclude) ) {
                    continue;
                }

				if ( $type != 'calc' && FrmProField::is_list_field( $field ) ) {
                    continue;
                }

            ?>
                <option value="<?php echo esc_attr( $field->id ) ?>"><?php echo esc_html( $field_name =  FrmAppHelper::truncate( $field->name, 60 ) ) ?> (<?php _e( 'ID', 'formidable' ) ?>)</option>
                <option value="<?php echo esc_attr( $field->field_key ) ?>"><?php echo esc_html( $field_name ) ?> (<?php _e( 'Key', 'formidable' ) ?>)</option>
                <?php if ( $field->type == 'file' && $type != 'field_opt' && $type != 'calc' ) { ?>
                    <option class="frm_subopt" value="<?php echo esc_attr( $field->field_key ) ?> size=thumbnail"><?php _e( 'Thumbnail', 'formidable' ) ?></option>
                    <option class="frm_subopt" value="<?php echo esc_attr( $field->field_key ) ?> size=medium"><?php _e( 'Medium', 'formidable' ) ?></option>
                    <option class="frm_subopt" value="<?php echo esc_attr( $field->field_key ) ?> size=large"><?php _e( 'Large', 'formidable' ) ?></option>
                    <option class="frm_subopt" value="<?php echo esc_attr( $field->field_key ) ?> size=full"><?php _e( 'Full Size', 'formidable' ) ?></option>
                <?php } else if ( $field->type == 'data' && $type != 'calc' ) {
					//get all fields from linked form
                    if ( isset($field->field_options['form_select']) && is_numeric($field->field_options['form_select']) ) {

                        $linked_form = FrmDb::get_var( 'frm_fields', array( 'id' => $field->field_options['form_select']), 'form_id' );
                        if ( ! in_array($linked_form, $linked_forms) ) {
                            $linked_forms[] = $linked_form;
							$linked_fields = FrmField::getAll( array( 'fi.type not' => FrmField::no_save_fields(), 'fi.form_id' => (int) $linked_form ) );
                            foreach ( $linked_fields as $linked_field ) { ?>
                    <option class="frm_subopt" value="<?php echo esc_attr( $field->id .' show='. $linked_field->id ) ?>"><?php echo esc_html( FrmAppHelper::truncate($linked_field->name, 60) ) ?> (<?php _e( 'ID', 'formidable' ) ?>)</option>
                    <option class="frm_subopt" value="<?php echo esc_attr( $field->field_key .' show='. $linked_field->field_key ) ?>"><?php echo esc_html( FrmAppHelper::truncate($linked_field->name, 60) ) ?> (<?php _e( 'Key', 'formidable' ) ?>)</option>
                    <?php
                            }
                        }
                    }
                }
            }
            }

            if ( $type != 'field_opt' && $type != 'calc' ) { ?>
            </optgroup>
			<optgroup label="<?php esc_attr_e( 'Helpers', 'formidable' ) ?>">
                <option value="editlink"><?php _e( 'Admin link to edit the entry', 'formidable' ) ?></option>
                <?php if ( $target_id == 'content' ) { ?>
                <option value="detaillink"><?php _e( 'Link to view single page if showing dynamic entries', 'formidable' ) ?></option>
                <?php }

                if ( $type != 'email' ) { ?>
                <option value="evenodd"><?php _e( 'Add a rotating \'even\' or \'odd\' class', 'formidable' ) ?></option>
                <?php } else if ( $target_id == 'email_message' ) { ?>
                <option value="default-message"><?php _e( 'Default Email Message', 'formidable' ) ?></option>
                <?php } ?>
                <option value="siteurl"><?php _e( 'Site URL', 'formidable' ) ?></option>
                <option value="sitename"><?php _e( 'Site Name', 'formidable' ) ?></option>
            </optgroup>
            <?php } ?>
        </select>
    <?php
    }

    public static function replace_shortcodes( $content, $entry, $shortcodes, $display = false, $show = 'one', $odd = '', $args = array() ) {
        global $post;

        if ( $display ) {
            $param_value = ($display->frm_type == 'id') ? $entry->id : $entry->item_key;

            if ( $entry->post_id ) {
                $args['detail_link'] = get_permalink($entry->post_id);
            } else {
                $param = ( isset($display->frm_param) && ! empty($display->frm_param) ) ? $display->frm_param : 'entry';
                if ( $post ) {
					$args['detail_link'] = esc_url_raw( add_query_arg( $param, $param_value, get_permalink( $post->ID ) ) );
                } else {
                    $args['detail_link'] = esc_url_raw( add_query_arg( $param, $param_value ) );
                }
                //if( FrmProAppHelper::rewriting_on() && $frmpro_settings->permalinks )
                //    $args['detail_link'] = get_permalink($post->ID) .$param_value .'/';
            }
        }
        $args['odd'] = $odd;
        $args['show'] = $show;

        foreach ( $shortcodes[0] as $short_key => $tag ) {
            self::replace_single_shortcode($shortcodes, $short_key, $tag, $entry, $display, $args, $content);
        }

        if ( empty($shortcodes[0]) ) {
            return $content;
        }

        return FrmFieldsHelper::replace_content_shortcodes($content, $entry, $shortcodes);
    }

    public static function replace_single_shortcode($shortcodes, $short_key, $tag, $entry, $display, $args, &$content) {
        global $post;

        $conditional = preg_match('/^\[if/s', $shortcodes[0][$short_key]) ? true : false;
        $foreach = preg_match('/^\[foreach/s', $shortcodes[0][$short_key]) ? true : false;
        $atts = shortcode_parse_atts( $shortcodes[3][$short_key] );

        $tag = FrmFieldsHelper::get_shortcode_tag($shortcodes, $short_key, compact('conditional', 'foreach'));
        if ( strpos($tag, '-') ) {
            $switch_tags = array(
                'post-id', 'created-at', 'updated-at',
                'created-by', 'updated-by', 'parent-id',
                'is-draft',
            );
            if ( in_array($tag, $switch_tags) ) {
                $tag = str_replace('-', '_', $tag);
            }
            unset($switch_tags);
        }

        $tags = array(
            'event_date', 'entry_count', 'detaillink', 'editlink', 'deletelink',
            'created_at', 'updated_at', 'created_by', 'updated_by',
            'evenodd', 'post_id', 'parent_id', 'id', 'is_draft',
        );

        if ( in_array($tag, $tags) ) {
            $args['entry'] = $entry;
            $args['tag'] = $tag;
            $args['conditional'] = $conditional;
			$function = 'do_shortcode_' . $tag;
			self::$function( $content, $atts, $shortcodes, $short_key, $args, $display );
            return;
        }

        $field = FrmField::getOne( $tag );
        if ( ! $field ) {
            return;
        }

		if ( ! $foreach && ! $conditional && isset( $atts['show'] ) && ( $atts['show'] == 'field_label' || $atts['show'] == 'description' ) ) {
			// get the field label or description and return before any other checking
			$replace_with = ( $atts['show'] == 'field_label' ) ? $field->name : $field->description;
			$content = str_replace($shortcodes[0][$short_key], $replace_with, $content);
			return;
		}

		$sep = isset( $atts['sep'] ) ? $atts['sep'] : ', ';

        if ( $field->form_id == $entry->form_id ) {
            $replace_with = FrmProEntryMetaHelper::get_post_or_meta_value($entry, $field, $atts);
        } else {
            // get entry ids linked through repeat field or embeded form
            $child_entries = FrmProEntry::get_sub_entries($entry->id, true);
            $replace_with = FrmProEntryMetaHelper::get_sub_meta_values($child_entries, $field, $atts);
			$replace_with = FrmAppHelper::array_flatten( $replace_with );
        }

        $atts['entry_id'] = $entry->id;
        $atts['entry_key'] = $entry->item_key;
        $atts['post_id'] = $entry->post_id;

		self::maybe_get_show_from_array( $replace_with, $atts );

		$replace_with = apply_filters('frmpro_fields_replace_shortcodes', $replace_with, $tag, $atts, $field);

		if ( isset( $atts['show'] ) && $atts['show'] == 'count' ) {
			$replace_with = is_array( $replace_with ) ? count( $replace_with ) : ! empty( $replace_with );
		} else if ( is_array( $replace_with ) && ! $foreach ) {
			$keep_array = apply_filters( 'frm_keep_value_array', false, compact( 'field', 'replace_with' ) );
			$keep_array = apply_filters( 'frm_keep_' . $field->type . '_value_array', $keep_array, compact( 'field', 'replace_with' ) );

			if ( ! $keep_array && $field->type != 'file' ) {
				$replace_with = FrmAppHelper::array_flatten( $replace_with );
				$replace_with = implode( $sep, $replace_with );
			} else if ( empty( $replace_with ) ) {
				$replace_with = '';
			}
		}

        if ( $foreach ) {
            $atts['short_key'] = $shortcodes[0][$short_key];
            $args['display'] = $display;
            self::check_conditional_shortcode($content, $replace_with, $atts, $tag, 'foreach', $args);
        } else if ( $conditional ) {
            $atts['short_key'] = $shortcodes[0][$short_key];
            self::check_conditional_shortcode($content, $replace_with, $atts, $tag, 'if', array( 'field' => $field ));
        } else {
			if ( empty( $replace_with ) && $replace_with != '0' ) {
                $replace_with = '';
                if ( $field->type == 'number' ) {
                    $replace_with = '0';
                }
            } else {
                $replace_with = FrmFieldsHelper::get_display_value($replace_with, $field, $atts);
            }

            self::trigger_shortcode_atts($atts, $display, $args, $replace_with);
            $content = str_replace($shortcodes[0][$short_key], $replace_with, $content);
        }
    }

    public static function replace_calendar_date_shortcode($content, $date) {
        preg_match_all("/\[(calendar_date)\b(.*?)(?:(\/))?\]/s", $content, $matches, PREG_PATTERN_ORDER);
        if ( empty($matches) ) {
            return $content;
        }

        foreach ( $matches[0] as $short_key => $tag ) {
            $atts = shortcode_parse_atts( $matches[2][$short_key] );
            self::do_shortcode_event_date($content, $atts, $matches, $short_key, array( 'event_date' => $date));
        }
        return $content;
    }

    public static function do_shortcode_event_date(&$content, $atts, $shortcodes, $short_key, $args) {
        $event_date = '';
        if ( isset($args['event_date']) ) {
            if ( ! isset($atts['format']) ) {
                $atts['format'] = get_option('date_format');
            }
            $event_date = self::get_date($args['event_date'], $atts['format']);
        }
        $content = str_replace($shortcodes[0][$short_key], $event_date, $content);
    }

    public static function do_shortcode_entry_count(&$content, $atts, $shortcodes, $short_key, $args) {
        $content = str_replace($shortcodes[0][$short_key], ( isset($args['record_count']) ? $args['record_count'] : '' ), $content);
    }

    public static function do_shortcode_detaillink(&$content, $atts, $shortcodes, $short_key, $args, $display) {
        if ( $display && $args['detail_link'] ) {
            $content = str_replace($shortcodes[0][$short_key], $args['detail_link'], $content);
        }
    }

    public static function do_shortcode_editlink(&$content, $atts, $shortcodes, $short_key, $args) {
        global $post;

        $replace_with = '';
        $link_text = isset($atts['label']) ? $atts['label'] : false;
        if ( ! $link_text ) {
            $link_text = isset($atts['link_text']) ? $atts['link_text'] : __( 'Edit');
        }

        $class = isset($atts['class']) ? $atts['class'] : '';
        $page_id = isset($atts['page_id']) ? $atts['page_id'] : ($post ? $post->ID : 0);

        if ( (isset($atts['location']) && $atts['location'] == 'front') || ( isset($atts['prefix']) && ! empty($atts['prefix']) ) || ( isset($atts['page_id']) && ! empty($atts['page_id']) ) ) {
            $edit_atts = $atts;
            $edit_atts['id'] = isset( $args['foreach_loop'] ) ? $args['entry']->parent_item_id : $args['entry']->id;
            $edit_atts['page_id'] = $page_id;

            $replace_with = FrmProEntriesController::entry_edit_link($edit_atts);
        } else {
            if ( $args['entry']->post_id ) {
                $replace_with = get_edit_post_link($args['entry']->post_id);
            } else if ( current_user_can('frm_edit_entries') ) {
				$replace_with = admin_url( 'admin.php?page=formidable-entries&frm_action=edit&id=' . $args['entry']->id );
            }

            if ( ! empty($replace_with) ) {
				$replace_with = '<a href="' . esc_url( $replace_with ) . '" class="frm_edit_link ' . esc_attr( $class ) . '">' . $link_text . '</a>';
            }

        }

        $content = str_replace($shortcodes[0][$short_key], $replace_with, $content);
    }

    public static function do_shortcode_deletelink(&$content, $atts, $shortcodes, $short_key, $args) {
        global $post;

        $page_id = isset($atts['page_id']) ? $atts['page_id'] : ($post ? $post->ID : 0);

        if ( ! isset( $atts['label'] ) ) {
            $atts['label'] = false;
        }
        $delete_atts = $atts;
        $delete_atts['id'] = $args['entry']->id;
        $delete_atts['page_id'] = $page_id;

        $replace_with = FrmProEntriesController::entry_delete_link($delete_atts);

        $content = str_replace($shortcodes[0][$short_key], $replace_with, $content);
    }

    public static function do_shortcode_evenodd(&$content, $atts, $shortcodes, $short_key, $args) {
        $content = str_replace($shortcodes[0][$short_key], $args['odd'], $content);
    }

    public static function do_shortcode_post_id(&$content, $atts, $shortcodes, $short_key, $args) {
        $content = str_replace($shortcodes[0][$short_key], $args['entry']->post_id, $content);
    }

    public static function do_shortcode_parent_id(&$content, $atts, $shortcodes, $short_key, $args) {
        $content = str_replace($shortcodes[0][$short_key], $args['entry']->parent_item_id, $content);
    }

    public static function do_shortcode_id(&$content, $atts, $shortcodes, $short_key, $args) {
        $content = str_replace($shortcodes[0][$short_key], $args['entry']->id, $content);
    }

    public static function do_shortcode_created_at(&$content, $atts, $shortcodes, $short_key, $args) {
        if ( isset($atts['format']) ) {
            $time_format = ' ';
        } else {
            $atts['format'] = get_option('date_format');
            $time_format = '';
        }

        if ( $args['conditional'] ) {
            $atts['short_key'] = $shortcodes[0][$short_key];
            self::check_conditional_shortcode($content, $args['entry']->{$args['tag']}, $atts, $args['tag']);
        } else {
            if ( isset($atts['time_ago']) ) {
                $date = FrmAppHelper::human_time_diff( strtotime($args['entry']->{$args['tag']}) );
            } else {
                $date = FrmAppHelper::get_formatted_time($args['entry']->{$args['tag']}, $atts['format'], $time_format);
            }

            $content = str_replace($shortcodes[0][$short_key], $date, $content);
        }
    }

    public static function do_shortcode_updated_at(&$content, $atts, $shortcodes, $short_key, $args) {
        self::do_shortcode_created_at($content, $atts, $shortcodes, $short_key, $args);
    }

    public static function do_shortcode_created_by(&$content, $atts, $shortcodes, $short_key, $args) {
        $replace_with = FrmFieldsHelper::get_display_value($args['entry']->{$args['tag']}, (object) array( 'type' => 'user_id'), $atts);

        if ( $args['conditional'] ) {
            $atts['short_key'] = $shortcodes[0][$short_key];
            self::check_conditional_shortcode($content, $args['entry']->{$args['tag']}, $atts, $args['tag']);
        } else {
            $content = str_replace($shortcodes[0][$short_key], $replace_with, $content);
        }
    }

    public static function do_shortcode_updated_by(&$content, $atts, $shortcodes, $short_key, $args) {
        self::do_shortcode_created_by($content, $atts, $shortcodes, $short_key, $args);
    }


	/**
 	* Process the is_draft shortcode
 	*
 	* @since 2.0.22
	* @param string $content
	* @param array $atts
	* @param array $shortcodes
	* @param string $short_key
	* @param array $args
	*/
	public static function do_shortcode_is_draft( &$content, $atts, $shortcodes, $short_key, $args ) {
		if ( $args['conditional'] ) {
			$atts['short_key'] = $shortcodes[0][ $short_key ];
			self::check_conditional_shortcode( $content, $args['entry']->is_draft, $atts, 'is_draft' );
		} else {
			$content = str_replace( $shortcodes[0][ $short_key ], $args['entry']->is_draft, $content );
		}
	}

	public static function get_file_from_atts( $atts, $field, &$replace_with ) {
		_deprecated_function( __FUNCTION__, '2.0.19', 'FrmProFieldsHelper::get_file_html_from_atts' );
		if ( $field->type == 'file' ) {
			self::get_file_html_from_atts( $atts, $replace_with );
		}
	}

	public static function get_media_from_id( $replace_with, $size, $atts = array() ) {
		_deprecated_function( __FUNCTION__, '2.0.19', 'FrmProFieldsHelper::get_displayed_file_html' );
		$replace_with = (array) $replace_with;
		return self::get_displayed_file_html( $replace_with, $size, $atts );
	}

	/**
	* Get the HTML for a file upload field depending on the $atts
	*
	* @since 2.0.19
	*
	* @param array $atts
	* @param string|array|int $replace_with
	*/
	private static function get_file_html_from_atts( $atts, &$replace_with ) {
		$show_id = isset( $atts['show'] ) && $atts['show'] == 'id';
		if ( ! $show_id && ! empty( $replace_with ) ) {
			//size options are thumbnail, medium, large, or full
			$size = isset($atts['size']) ? $atts['size'] : (isset($atts['show']) ? $atts['show'] : 'thumbnail');

			$new_atts = array(
				'show_filename' => ( isset($atts['show_filename']) && $atts['show_filename'] ) ? true : false,
				'show_image' => ( isset( $atts['show_image'] ) && $atts['show_image'] ) ? true : false,
				'add_link' => ( isset( $atts['add_link'] ) && $atts['add_link'] ) ? true : false
			);

			self::modify_atts_for_reverse_compatibility( $atts, $new_atts );

			$ids = (array) $replace_with;
			$replace_with = self::get_displayed_file_html( $ids, $size, $new_atts );
		}

		if ( is_array( $replace_with ) ) {
			$replace_with = array_filter( $replace_with );
		}
	}

	/**
	* Maintain reverse compatibility for html=1, links=1, and show=label
	*
	* @since 2.0.19
	*
	* @param array $atts
	* @param array $new_atts
	*/
	private static function modify_atts_for_reverse_compatibility( $atts, &$new_atts ) {
		// For show=label
		if ( ! $new_atts['show_filename'] && isset( $atts['show'] ) && $atts['show'] == 'label' ) {
			$new_atts['show_filename'] = true;
		}

		// For html=1
		$inc_html = ( isset( $atts['html'] ) && $atts['html'] );
		if ( $inc_html && ! $new_atts['show_image'] ) {

			if ( $new_atts['show_filename'] ) {
				// For show_filename with html=1
				$new_atts['show_image'] = false;
				$new_atts['add_link'] = true;
			} else {
				// html=1 without show_filename=1
				$new_atts['show_image'] = true;
				$new_atts['add_link_for_non_image'] = true;
			}
		}

		// For links=1
		$show_links = ( isset( $atts['links'] ) && $atts['links'] );
		if ( $show_links && ! $new_atts['add_link'] ) {
			$new_atts['add_link'] = true;
		}
	}

	/**
	 * @since 2.0.23
	 * when a value is saved as an array, allow show=something to
	 * return a specified value from the array
	 */
	private static function maybe_get_show_from_array( &$replace_with, $atts ) {
		if ( is_array( $replace_with ) && isset( $atts['show'] ) ) {
			if ( isset( $replace_with[ $atts['show'] ] ) ) {
				$replace_with = $replace_with[ $atts['show'] ];
			} else if ( isset( $atts['blank'] ) && $atts['blank'] ) {
				$replace_with = '';
			}
		}
	}

    public static function check_conditional_shortcode(&$content, $replace_with, $atts, $tag, $condition = 'if', $args = array() ) {
        $defaults = array( 'field' => false);
        $args = wp_parse_args($args, $defaults);

        if ( 'if' == $condition ) {
            $replace_with = self::conditional_replace_with_value( $replace_with, $atts, $args['field'], $tag );
            $replace_with = apply_filters('frm_conditional_value', $replace_with, $atts, $args['field'], $tag);
        }

        $start_pos = strpos($content, $atts['short_key']);

		// Replace identical conditional and foreach shortcodes in this loop
        while( $start_pos !== false ) {

			$start_pos_len = strlen($atts['short_key']);
			$end_pos = strpos($content, '[/'. $condition .' '. $tag .']', $start_pos);
			$end_pos_len = strlen('[/'. $condition .' '. $tag .']');

			if ( $end_pos === false ) {
				$end_pos = strpos($content, '[/'. $condition .']', $start_pos);
				$end_pos_len = strlen('[/'. $condition .']');

				if ( $end_pos === false ) {
					return;
				}
			}

			$total_len = ( $end_pos + $end_pos_len ) - $start_pos;

			if ( empty($replace_with) ) {
				$content = substr_replace($content, '', $start_pos, $total_len);
			} else if ( 'foreach' == $condition ) {
				$content_len = $end_pos - ( $start_pos + $start_pos_len );
				$repeat_content = substr($content, $start_pos + $start_pos_len, $content_len);
				self::foreach_shortcode($replace_with, $args, $repeat_content);
				$content = substr_replace($content, $repeat_content, $start_pos, $total_len);
			} else {
				$content = substr_replace($content, '', $end_pos, $end_pos_len);
				$content = substr_replace($content, '', $start_pos, $start_pos_len);
			}

			$start_pos = strpos($content, $atts['short_key']);
        }
    }

    /**
     * Loop through each entry linked through a repeating field when using [foreach]
     */
    public static function foreach_shortcode($replace_with, $args, &$repeat_content) {
        $foreach_content = '';

        $sub_entries = is_array( $replace_with ) ? $replace_with : explode(',', $replace_with);
        foreach ( $sub_entries as $sub_entry ) {
            $sub_entry = trim($sub_entry);
            if ( ! is_numeric($sub_entry) ) {
                continue;
            }

            $entry = FrmEntry::getOne($sub_entry);
			if ( ! $entry ) {
				continue;
			}

			$args['foreach_loop'] = true;

            $shortcodes = FrmProDisplaysHelper::get_shortcodes($repeat_content, $entry->form_id);
            $repeating_content = $repeat_content;
            foreach ( $shortcodes[0] as $short_key => $tag ) {
                self::replace_single_shortcode($shortcodes, $short_key, $tag, $entry, $args['display'], $args, $repeating_content);
            }
            $foreach_content .= $repeating_content;
        }

        $repeat_content = $foreach_content;
    }

    public static function conditional_replace_with_value($replace_with, $atts, $field, $tag) {
        $conditions = array(
            'equals', 'not_equal',
            'like', 'not_like',
            'less_than', 'greater_than',
        );

        if ( $field && $field->type == 'data' ) {
            $old_replace_with = $replace_with;

			// Only get the displayed value if it hasn't been set yet
			if ( is_numeric( $replace_with ) || is_numeric( str_replace( array( ',', ' '), array( '', '' ), $replace_with ) ) || is_array( $replace_with ) ) {
				$replace_with = FrmFieldsHelper::get_display_value($replace_with, $field, $atts);
				if ( $old_replace_with == $replace_with ) {
					$replace_with = '';
				}
			}
        } else if ( ($field && $field->type == 'user_id') || in_array($tag, array( 'updated_by', 'created_by')) ) {
            // check if conditional is for current user
            if ( isset($atts['equals']) && $atts['equals'] == 'current' ) {
                $atts['equals'] = get_current_user_id();
            }

            if ( isset($atts['not_equal']) && $atts['not_equal'] == 'current' ) {
                $atts['not_equal'] = get_current_user_id();
            }
        } else if ( (in_array($tag, array( 'created-at', 'created_at', 'updated-at', 'updated_at')) || ( $field && $field->type == 'date') ) ) {
            foreach ( $conditions as $att_name ) {
                if ( isset($atts[$att_name]) && $atts[$att_name] != '' && !preg_match('/^\d{4}-\d{2}-\d{2}$/', trim($atts[$att_name])) ) {
					if ( $atts[ $att_name ] == 'NOW' ) {
						$atts[ $att_name ] = FrmProAppHelper::get_date( 'Y-m-d' );
					} else {
						$atts[ $att_name ] = date_i18n( 'Y-m-d', strtotime( $atts[ $att_name ] ) );
					}
                }
                unset($att_name);
            }
        }

        self::eval_conditions($conditions, $atts, $replace_with, $field);

        return $replace_with;
    }

    private static function eval_conditions($conditions, $atts, &$replace_with, $field) {
        foreach ( $conditions as $condition ) {
            if ( ! isset($atts[$condition]) ) {
                continue;
            }

			$function = 'eval_' . $condition . '_condition';
			self::$function( $atts, $replace_with, $field );
        }
    }

    private static function eval_equals_condition($atts, &$replace_with, $field) {
        if ( $replace_with != $atts['equals'] ) {
            if ( $field && $field->type == 'data' ) {
                $replace_with = FrmFieldsHelper::get_display_value($replace_with, $field, $atts);
                if ( $replace_with != $atts['equals'] ) {
                    $replace_with = '';
                }
            } else if ( isset($field->field_options['post_field']) && $field->field_options['post_field'] == 'post_category' ) {
                $cats = explode(', ', $replace_with);
                $replace_with = '';
                foreach ( $cats as $cat ) {
                    if ( $atts['equals'] == strip_tags($cat) ) {
                        $replace_with = true;
                        return;
                    }
                }
            } else {
                $replace_with = '';
            }
        } else if ( ( $atts['equals'] == '' && $replace_with == '' ) || ( $atts['equals'] == '0' && $replace_with == '0' ) ) {
            //if the field is blank, give it a value
            $replace_with = true;
        }
    }

    private static function eval_not_equal_condition($atts, &$replace_with, $field) {
        if ( $replace_with == $atts['not_equal'] ) {
            $replace_with = '';
        } else if ( $replace_with == '' && $atts['not_equal'] !== '' ) {
			$replace_with = true;
        } else if ( ! empty($replace_with) && isset($field->field_options['post_field']) && $field->field_options['post_field'] == 'post_category' ) {
            $cats = explode(', ', $replace_with);
            foreach ( $cats as $cat ) {
                if ( $atts['not_equal'] == strip_tags($cat) ) {
                    $replace_with = '';
                    return;
                }

                unset($cat);
            }
		}
    }

    private static function eval_like_condition($atts, &$replace_with) {
        if ( $atts['like'] == '' ) {
            return;
        }

		if ( stripos( $replace_with, $atts['like'] ) === false ) {
             $replace_with = '';
        }
    }

    private static function eval_not_like_condition($atts, &$replace_with) {
        if ( $atts['not_like'] == '' ) {
            return;
        }

        if ( $replace_with == '' ) {
            $replace_with = true;
        } else if ( strpos($replace_with, $atts['not_like']) !== false ) {
            $replace_with = '';
        }
    }

    private static function eval_less_than_condition($atts, &$replace_with) {
        if ( $atts['less_than'] <= $replace_with ) {
            $replace_with = '';
        } else if ( $atts['less_than'] > 0 && $replace_with == '0' ) {
            $replace_with = true;
        }
    }

    private static function eval_greater_than_condition($atts, &$replace_with) {
        if ( $atts['greater_than'] >= $replace_with ) {
            $replace_with = '';
        }
    }

    public static function trigger_shortcode_atts($atts, $display, $args, &$replace_with) {
        $frm_atts = array(
            'sanitize', 'sanitize_url',
            'truncate', 'clickable',
        );
        $included_atts = array_intersect($frm_atts, array_keys($atts));

        foreach ( $included_atts as $included_att ) {
			$function = 'atts_' . $included_att;
			$replace_with = self::$function( $replace_with, $atts, $display, $args );
        }
    }

    public static function atts_sanitize($replace_with) {
        return sanitize_title_with_dashes($replace_with);
    }

    public static function atts_sanitize_url($replace_with) {
        if ( seems_utf8($replace_with) ) {
            $replace_with = utf8_uri_encode($replace_with, 200);
        }
        return urlencode($replace_with);
    }

    public static function atts_truncate($replace_with, $atts, $display, $args) {
        if ( isset($atts['more_text']) ) {
            $more_link_text = $atts['more_text'];
        } else {
            $more_link_text = isset($atts['more_link_text']) ? $atts['more_link_text'] : '. . .';
        }

		// If we're on the listing page of a Dynamic View, use detail link for truncate link
		if ( $display && $display->frm_show_count == 'dynamic' && $args['show'] == 'all' ) {
			$more_link_text = ' <a href="' . esc_url( $args['detail_link'] ) . '">' . $more_link_text . '</a>';
            return FrmAppHelper::truncate($replace_with, (int) $atts['truncate'], 3, $more_link_text);
        }

        $replace_with = wp_specialchars_decode(strip_tags($replace_with), ENT_QUOTES);
		$part_one = FrmAppHelper::mb_function( array( 'mb_substr', 'substr' ), array( $replace_with, 0, (int) $atts['truncate'] ) );
		$part_two = FrmAppHelper::mb_function( array( 'mb_substr', 'substr' ), array( $replace_with, (int) $atts['truncate'] ) );

        if ( ! empty($part_two) ) {
            $replace_with = $part_one .'<a href="#" onclick="jQuery(this).next().css(\'display\', \'inline\');jQuery(this).css(\'display\', \'none\');return false;" class="frm_text_exposed_show"> '. $more_link_text .'</a><span style="display:none;">'. $part_two .'</span>';
        }

        return $replace_with;
    }

    public static function atts_clickable($replace_with) {
		return make_clickable( $replace_with );
    }

	/**
	* Get HTML for a file upload field depending on atts and file type
	*
	* @since 2.0.19
	*
	* @param array $ids
	* @param string $size
	* @param array $atts
	* @return array|string
	*/
	public static function get_displayed_file_html( $ids, $size = 'thumbnail', $atts = array() ) {
		$defaults = array(
			'show_filename' => false,
			'show_image' => false,
			'add_link' => false,
			'add_link_for_non_image' => false,
		);
		$atts = wp_parse_args( $atts, $defaults );
		$atts['size'] = $size;

		$img_html = array();
		foreach ( (array) $ids as $id ) {
			if ( ! is_numeric( $id ) ) {
				if ( ! empty( $id ) ) {
					// If a custom value was set with a hook, don't remove it
					$img_html[] = $id;
				}
				continue;
			}

			$img = self::get_file_display( $id, $atts );

			if ( isset( $img ) ) {
				$img_html[] = $img;
			}
		}
		unset( $img, $id );

		if ( count( $img_html ) == 1 ) {
			$img_html = reset( $img_html );
		}

		return $img_html;
	}

	/**
	* Get the HTML to display an uploaded in a File Upload field
	*
	* @since 2.02
	*
	* @param int $id
	* @param array $atts
	* @return string $img_html
	*/
	private static function get_file_display( $id, $atts ) {
		if ( empty( $id ) ) {
			return '';
		}

		$img_html = $image_url = '';
		$image = wp_get_attachment_image_src( $id, $atts['size'], false );
		$is_non_image = empty( $image );

		if ( $atts['show_image'] ) {
			$img_html = wp_get_attachment_image( $id, $atts['size'], $is_non_image );
		}

		// If show_filename=1 is included
		if ( $atts['show_filename'] ) {
			$label = self::get_single_file_name( $id );
			if ( $atts['show_image'] ) {
				$img_html .= ' <span id="frm_media_' . absint( $id ) . '" class="frm_upload_label">' . $label . '</span>';
			} else {
				$img_html .= $label;
			}
		}

		// If neither show_image or show_filename are included, get file URL
		if ( empty( $img_html ) ) {
			if ( $is_non_image ) {
				$img_html = $image_url = wp_get_attachment_url( $id );
			} else {
				$img_html = $image['0'];
			}
		}

		// If add_link=1 is included
		if ( $atts['add_link'] || ( $is_non_image && $atts['add_link_for_non_image'] ) ) {
			if ( empty( $image_url ) ) {
				$image_url = wp_get_attachment_url( $id );
			}
			$img_html = '<a href="' . esc_url( $image_url ) . '" class="frm_file_link">' . $img_html . '</a>';
		}

		$atts['media_id'] = $id;
		$img_html = apply_filters( 'frm_image_html_array', $img_html, $atts );

		return $img_html;
	}

	/**
	* Get the file name for a single media ID
	*
	* @since 2.0.19
	*
	* @param int $id
	* @return boolean|string $filename
	*/
	private static function get_single_file_name( $id ) {
		$attachment = get_post( $id );
		if ( ! $attachment ) {
			$filename = false;
		} else {
			$filename = basename( $attachment->guid );
		}
		return $filename;
	}

    public static function get_display_value( $replace_with, $field, $atts = array() ) {
		$field_type = is_array( $field ) ? $field['type'] : $field->type;
        $function_name = 'get_'. $field_type .'_display_value';
        if ( method_exists(__CLASS__, $function_name) ) {
			$replace_with = self::$function_name( $replace_with, $atts, $field );
        }

        return $replace_with;
    }

	public static function get_user_id_display_value($replace_with, $atts) {
		$user_info = isset($atts['show']) ? $atts['show'] : 'display_name';
		$replace_with = self::get_display_name($replace_with, $user_info, $atts);

		if ( is_array( $replace_with ) ) {
			$sep = isset( $atts['sep'] ) ? $atts['sep'] : ', ';
			$replace_with = implode( $sep, $replace_with );
		}

		return $replace_with;
	}

	public static function get_time_display_value( $replace_with, $atts, $field ) {
		$time_clock = ( isset( $field->field_options['clock'] ) ) ? $field->field_options['clock'] : 12;
		$defaults = array(
			'format' => ( $time_clock == 24 ) ? 'H:i' : 'g:i A',
		);
		$atts = wp_parse_args( $atts, $defaults );

		if ( strpos( $replace_with, ',' ) ) {
			$replace_with = explode( ',', $replace_with );
		}

		if ( is_array( $replace_with ) ) {
			foreach ( $replace_with as $k => $v ) {
				$replace_with[ $k ] = FrmProAppHelper::format_time( $replace_with[ $k ], $atts['format'] );
			}
		} else {
			$replace_with = FrmProAppHelper::format_time( $replace_with, $atts['format'] );
		}
		return $replace_with;

	}

    public static function get_date_display_value($replace_with, $atts) {
		if ( $replace_with === false ) {
			return $replace_with;
		}

        $defaults = array(
            'format'    => false,
        );
        $atts = wp_parse_args($atts, $defaults);

        if ( ! isset($atts['time_ago']) ) {
			if ( strpos( $replace_with, ',' ) ) {
				$replace_with = explode( ',', $replace_with );
			}

            if ( is_array($replace_with) ) {
                foreach ( $replace_with as $k => $v ) {
                    $replace_with[$k] = self::get_date($v, $atts['format']);
                }
            } else {
                $replace_with = self::get_date($replace_with, $atts['format']);
            }
            return $replace_with;
        }

        $replace_with = self::get_date($replace_with, 'Y-m-d H:i:s');
        $replace_with = FrmAppHelper::human_time_diff( strtotime($replace_with), strtotime(date_i18n('Y-m-d')) );

        return $replace_with;
    }

    public static function get_file_display_value($replace_with, $atts) {
        if ( ! is_numeric($replace_with) && ! is_array($replace_with) ) {
            return $replace_with;
        }

		$showing_image = ( isset( $atts['html'] ) && $atts['html'] ) || ( isset( $atts['show_image'] ) && $atts['show_image'] );
		$default_sep = $showing_image ? ' ' : ', ';
		$atts['sep'] = isset( $atts['sep'] ) ? $atts['sep'] : $default_sep;

		self::get_file_html_from_atts( $atts, $replace_with );

        if ( is_array($replace_with) ) {
            $replace_with = implode($atts['sep'], $replace_with);

			if ( $showing_image ) {
				$replace_with = '<div class="frm_file_container">' . $replace_with . '</div>';
			}
        }

        return $replace_with;
    }

	public static function get_image_display_value( $replace_with, $atts ) {
		$defaults = array(
			'html'  => false,
		);
		$atts = wp_parse_args( $atts, $defaults );

		if ( $atts['html'] ) {
			$images = '';
			foreach ( (array) $replace_with as $url ) {
				$images .= '<img src="' . esc_attr( $url ) . '" class="frm_image_from_url" alt="" /> ';
			}
			$replace_with = $images;
		}

		return $replace_with;
	}

    public static function get_number_display_value($replace_with, $atts) {
        $defaults = array(
            'dec_point' => '.', 'thousands_sep' => '',
            'sep'       => ', ',
        );
        $atts = wp_parse_args($atts, $defaults);

        $new_val = array();
        $replace_with = array_filter( (array) $replace_with, 'strlen' );

        foreach ( $replace_with as $v ) {
            if ( strpos($v, $atts['sep']) ) {
                $v = explode($atts['sep'], $v);
            }

            foreach ( (array) $v as $n ) {
                if ( ! isset($atts['decimal']) ) {
                    $num = explode('.', $n);
                    $atts['decimal'] = isset($num[1]) ? strlen($num[1]) : 0;
                }

				if ( is_numeric( $n ) ) {
					$n = number_format($n, $atts['decimal'], $atts['dec_point'], $atts['thousands_sep']);
				}

                $new_val[] = $n;
            }

            unset($v);
        }
        $new_val = array_filter( (array) $new_val, 'strlen' );

        return implode($atts['sep'], $new_val);
    }

    public static function get_data_display_value($replace_with, $atts, $field) {
        //if ( is_numeric($replace_with) || is_array($replace_with) )

        if ( ! isset($field->field_options['form_select']) || $field->field_options['form_select'] == 'taxonomy' ) {
            return $replace_with;
        }

        $sep = isset($atts['sep']) ? $atts['sep'] : ', ';
        $atts['show'] = isset($atts['show']) ? $atts['show'] : false;

        if ( ! empty($replace_with) && ! is_array($replace_with) ) {
            $replace_with = explode($sep, $replace_with);
        }

        $linked_ids = (array) $replace_with;
        $replace_with = array();

        if ( $atts['show'] == 'id' ) {
            // keep the values the same since we already have the ids
            $replace_with = $linked_ids;
        } else if ( in_array($atts['show'], array( 'key', 'created-at', 'created_at', 'updated-at', 'updated_at, updated-by, updated_by', 'post_id')) ) {

            $nice_show = str_replace('-', '_', $atts['show']);

            foreach ( $linked_ids as $linked_id ) {
                $linked_entry = FrmEntry::getOne($linked_id);

                if ( isset($linked_entry->{$atts['show']}) ) {
                    $replace_with[] = $linked_entry->{$atts['show']};
                } else if ( isset($linked_entry->{$nice_show}) ) {
                    $replace_with[] = $linked_entry->{$nice_show};
                } else {
                    $replace_with[] = $linked_entry->item_key;
                }
            }
        } else {
            foreach ( $linked_ids as $linked_id ) {
                $new_val = self::get_data_value($linked_id, $field, $atts);

                if ( $linked_id == $new_val ) {
                    continue;
                }
				if ( is_array( $new_val ) ) {
                    $new_val = implode($sep, $new_val);
                }

                $replace_with[] = $new_val;

                unset($new_val);
            }
        }

        return implode($sep, $replace_with);
    }

	/**
	* Check if a field is hidden through the frm_is_field_hidden hook
	*
	* @since 2.0.13
	* @param boolean $hidden
	* @param object $field
	* @param array $values
	* @return boolean $hidden
	*/
	public static function route_to_is_field_hidden( $hidden, $field, $values ) {
		$hidden = self::is_field_hidden( $field, $values );
		return $hidden;
	}

	/**
	 * Check if a field is conditionally hidden
	 *
	 * @param object $field
	 * @param array $values
	 * @return bool
	 */
	public static function is_field_hidden( $field, $values ) {
		return ! self::is_field_conditionally_shown( $field, $values );
	}

	/**
	 * Check if a field is conditionally shown
	 *
	 * @since 2.02.03
	 * @param object $field
	 * @param array $values
	 * @return bool
	 */
	private static function is_field_conditionally_shown( $field, $values ) {
		if ( ! self::field_needs_conditional_logic_checking( $field ) ) {
			return true;
		}

		self::prepare_conditional_logic( $field );

		$logic_outcomes = self::get_conditional_logic_outcomes( $field, $values );

		$visible = self::is_field_visible_from_logic_outcomes( $field, $logic_outcomes );

		if ( $visible && ! self::dynamic_field_has_options( $field, $values ) ) {
			$visible = false;
		}

		return $visible;
	}

	/**
	 * Check if a field needs to have the conditional logic checked
	 *
	 * @since 2.02.03
	 * @param object $field
	 * @return bool
	 */
	private static function field_needs_conditional_logic_checking( $field ) {
		$needs_check = true;

		if ( $field->type == 'user_id' || $field->type == 'hidden' || ! isset( $field->field_options['hide_field'] ) || empty( $field->field_options['hide_field'] ) ) {
			$needs_check = false;
		}

		return $needs_check;
	}

	/**
	 * Prepare conditional logic settings
	 *
	 * @since 2.02.03
	 * @param object $field
	 */
	private static function prepare_conditional_logic( &$field ) {
		$field->field_options['hide_field'] = (array) $field->field_options['hide_field'];

		if ( isset( $field->field_options['hide_field_cond'] ) ) {
			$field->field_options['hide_field_cond'] = (array) $field->field_options['hide_field_cond'];
		} else {
			$field->field_options['hide_field_cond'] = array( '==');
		}

		$field->field_options['hide_opt'] = (array) $field->field_options['hide_opt'];
	}

	/**
	 * Get the conditional logic outcomes for a field
	 *
	 * @since 2.02.03
	 * @param object $field
	 * @param array $values
	 * @return array
	 */
	private static function get_conditional_logic_outcomes( $field, $values ) {
		$logic_outcomes = array();
		foreach ( $field->field_options['hide_field'] as $logic_key => $logic_field ) {

			$observed_value = self::get_observed_logic_value( $field, $values, $logic_field );
			$logic_value = self::get_conditional_logic_value( $field, $logic_key, $observed_value );
			$operator = $field->field_options['hide_field_cond'][ $logic_key ];

			$logic_outcomes[] = FrmFieldsHelper::value_meets_condition( $observed_value, $operator, $logic_value );
		}

		return $logic_outcomes;
	}

	/**
	 * Check if a field is conditionally shown based on the conditional logic outcomes
	 *
	 * @since 2.02.03
	 * @param object $field
	 * @param array $logic_outcomes
	 * @return bool
	 */
	private static function is_field_visible_from_logic_outcomes( $field, $logic_outcomes ) {
		$action = isset( $field->field_options['show_hide'] ) ? $field->field_options['show_hide'] : 'show';
		$any_all = isset( $field->field_options['any_all'] ) ? $field->field_options['any_all'] : 'any';
		$visible = ( 'show' == $action ) ? true : false;

		self::check_logic_outcomes( $any_all, $logic_outcomes, $visible );

		return $visible;
	}

	/**
	 * Check if a Dynamic field has options at validation
	 *
	 * @since 2.02.03
	 * @param object $field
	 * @param array $values
	 * @return bool
	 */
	private static function dynamic_field_has_options( $field, $values ) {
		$has_options = true;

		if ( $field->type != 'data' || $field->field_options['data_type'] == 'data' ) {
			return $has_options;
		}

		foreach ( $field->field_options['hide_field'] as $logic_field_id ) {
			if ( ! self::is_dynamic_field( $logic_field_id ) ) {
				continue;
			}

			if ( ! self::logic_field_retrieves_options( $field, $values, $logic_field_id ) ) {
				$has_options = false;
				break;
			}
		}

		$args = array( 'field' => $field, 'values' => $values );
		$has_options = apply_filters( 'frm_dynamic_field_has_options', $has_options, $args );

		return $has_options;
	}

	/**
	 * Get the value for a single row of conditional logic
	 *
	 * @since 2.02.03
	 * @param object $field
	 * @param int $key
	 * @param string|array $observed_value
	 * @return string|array
	 */
	private static function get_conditional_logic_value( $field, $key, $observed_value ) {
		$logic_value = $field->field_options['hide_opt'][ $key ];
		self::get_logic_value_for_dynamic_field( $field, $key, $observed_value, $logic_value );

		return $logic_value;
	}

	/**
	 * Get the observed value from a logic field
	 *
	 * @since 2.02.03
	 * @param object $field
	 * @param array $values
	 * @param int $logic_field_id
	 * @return bool
	 */
	private static function get_observed_logic_value( $field, $values, $logic_field_id ) {
		$observed_value = '';
		if ( isset( $values['item_meta'][ $logic_field_id ] ) ) {
			// logic field is not repeating/embedded
			$observed_value = $values['item_meta'][ $logic_field_id ];
		} else if ( isset( $field->temp_id ) && $field->id != $field->temp_id ) {
			// logic field is repeating/embedded
			$id_parts = explode( '-', $field->temp_id );
			if ( isset( $_POST['item_meta'][ $id_parts[1] ][ $id_parts[2] ] ) && isset( $_POST['item_meta'][ $id_parts[1] ][ $id_parts[2] ][ $logic_field_id ] ) ) {
				$observed_value = stripslashes_deep( $_POST['item_meta'][ $id_parts[1] ][ $id_parts[2] ][ $logic_field_id ] );
			}
		}

		return $observed_value;
	}

	/**
	 * Get the value for a single row of conditional logic when field and parent is Dynamic
	 *
	 * @since 2.02.03
	 * @param object $field
	 * @param int $key
	 * @param mixed $observed_value
	 * @param string $logic_value
	 */
	private static function get_logic_value_for_dynamic_field( $field, $key, $observed_value, &$logic_value ) {
		if ( $field->type != 'data' || $field->field_options['data_type'] == 'data' ) {
			return;
		}

		if ( ! self::is_dynamic_field( $field->field_options['hide_field'][ $key ] ) ) {
			return;
		}

		// If logic is "Dynamic field is equal to anything"
		if ( empty( $field->field_options['hide_opt'][ $key ] ) ) {
			$logic_value = $observed_value;

			// If no value is set in parent field, make sure logic doesn't return true
			if ( empty( $observed_value ) && $field->field_options['hide_field_cond'][$key] == '==' ) {
				$logic_value = 'anything';
			}
		}

		$hide_field = FrmField::getOne( $field->field_options['hide_field'][ $key ] );
		$logic_value = apply_filters( 'frm_is_dynamic_field_empty', $logic_value, compact( 'field', 'key', 'hide_field', 'observed_value' )  );
		if ( has_filter( 'frm_is_dynamic_field_empty' ) ) {
			_deprecated_function( 'The frm_is_dynamic_field_empty filter', '2.02.03', 'the frm_dynamic_field_has_options filter' );
		}
	}

	/**
	 * Check whether a field is visible or not from conditional logic outcomes
	 *
	 * @since 2.02.03
	 * @param string $any_all
	 * @param array $logic_outcomes
	 * @param bool $visible
	 */
	private static function check_logic_outcomes( $any_all, $logic_outcomes, &$visible ) {
		if ( 'any' == $any_all ) {
			if ( ! in_array( true, $logic_outcomes ) ) {
				$visible = ! $visible;
			}
		} else {
			if ( in_array( false, $logic_outcomes ) ) {
				$visible = ! $visible;
			}
		}
	}

	/**
	 * Check if a field is Dynamic
	 *
	 * @since 2.02.03
	 * @param int $field_id
	 * @return bool
	 */
	private static function is_dynamic_field( $field_id ) {
		$field_type = FrmField::get_type( $field_id );
		return ( $field_type && $field_type == 'data' );
	}

	/**
	 * Check if a Dynamic logic field retrieves options for the child
	 *
	 * @since 2.02.03
	 * @param object $field
	 * @param array $values
	 * @param int $logic_field_id
	 * @return bool
	 */
	private static function logic_field_retrieves_options( $field, $values, $logic_field_id ) {
		$observed_value = self::get_observed_logic_value( $field, $values, $logic_field_id );

		if ( empty( $observed_value ) ) {
			return false;
		}

		if ( ! is_array( $observed_value ) ) {
			$observed_value = explode( ',', $observed_value );
		}

		$linked_field_id = isset( $field->field_options['form_select'] ) ? $field->field_options['form_select'] : '';

		if ( $linked_field_id == 'taxonomy' ) {
			// Category fields
			$has_options = self::does_parent_taxonomy_have_children( $field->field_options['taxonomy'], $observed_value );
		} else {
			// Standard dynamic fields
			$linked_field = FrmField::getOne( $linked_field_id );
			$field_options = array();
			FrmProEntryMetaHelper::meta_through_join( $logic_field_id, $linked_field, $observed_value, $field, $field_options );
			$has_options = ! empty( $field_options );
		}

		return $has_options;
	}

	/**
	 * Checks if child categories exist for a given taxonomy and parent taxonomy IDs
	 *
	 * @since 2.02.03
	 *
	 * @param string $taxonomy
	 * @param array $parent_taxonomy_ids
	 * @return array
	 */
	private static function does_parent_taxonomy_have_children( $taxonomy, $parent_taxonomy_ids ) {
		$has_children = false;

		if ( empty( $parent_taxonomy_ids ) ) {
			return $has_children;
		}

		$child_categories = array();
		foreach ( $parent_taxonomy_ids as $parent_id ) {
			$args = array(
				'parent' => (int) $parent_id,
				'taxonomy' => $taxonomy,
				'hide_empty' => 0,
			);
			$new_cats = get_categories( $args );
			$child_categories = array_merge( $new_cats, $child_categories );

			// Stop as soon as there are options
			if ( ! empty( $child_categories ) ) {
				$has_children = true;
				break;
			}
		}

		return $has_children;
	}

    public static function &is_field_visible_to_user($field) {
        $visible = true;

		if ( FrmField::is_option_empty( $field, 'admin_only' ) ) {
            return $visible;
        }

        if ( $field->field_options['admin_only'] == 1 ) {
            $field->field_options['admin_only'] = 'administrator';
        }

        if ( ( $field->field_options['admin_only'] == 'loggedout' && is_user_logged_in() ) ||
            ( $field->field_options['admin_only'] == 'loggedin' && ! is_user_logged_in() ) ||
            ( ! in_array($field->field_options['admin_only'], array( 'loggedout', 'loggedin', '') ) &&
            ! FrmAppHelper::user_has_permission( $field->field_options['admin_only'] ) ) ) {
                $visible = false;
        }

        return $visible;
    }

	public static function is_repeating_field( $field ) {
		_deprecated_function( __FUNCTION__, '2.0.09', 'FrmField::is_repeating_field' );
		return FrmField::is_repeating_field( $field );
	}

	/**
	* Load JavaScript for hidden subfields
	* Applies to repeating sections and embed form fields
	*
	* @since 2.01.0
	* @param array $field
	*/
	public static function load_hidden_sub_field_javascript( $field ) {
		if ( ( $field['original_type'] == 'divider' && $field['repeat'] == true ) || $field['original_type'] == 'form' ) {
			// TODO: clean this up

			$sub_fields = FrmField::get_all_for_form( $field['form_select'] );
			foreach ( $sub_fields as $s_field ) {
				$temp = get_object_vars( $s_field );
				$field_array = $temp['field_options'];
				unset( $temp['field_options'] );
				$field_array = $field_array + $temp;
				$field_array['original_type'] = $field_array['type'];
				$field_array['type'] = 'hidden';
				$field_array['parent_form_id'] = $field['form_id'];
				if ( ! isset( $field_array['value'] ) ) {
					$field_array['value'] = '';
				}

				if ( $field['original_type'] == 'form' ) {
					$field_array['in_embed_form'] = $field['id'];
				}

				self::add_field_javascript( $field_array );
			}
		}
	}


    /**
     * Loop through value in hidden field and display arrays in separate fields
     * @since 2.0
     */
	public static function insert_hidden_fields( $field, $field_name, $checked, $opt_key = false ) {
		if ( is_array( $checked ) ) {
			foreach ( $checked as $k => $checked2 ) {
                $checked2 = apply_filters('frm_hidden_value', $checked2, $field);
                self::insert_hidden_fields($field, $field_name .'['. $k .']', $checked2, $k);
                unset($k, $checked2);
            }
        } else {
        	$html_id = $field['html_id'];
			self::hidden_html_id( $field, $field_name, $opt_key, $html_id );
?>
<input type="hidden" name="<?php echo esc_attr( $field_name ) ?>" id="<?php echo esc_attr( $html_id ) ?>" value="<?php echo esc_attr( $checked ) ?>" <?php do_action( 'frm_field_input_html', $field )?> />
<?php
			self::insert_extra_hidden_fields( $field, $opt_key );
        }
    }

	/**
	 * The html id needs to be the same as when the fields are displayed normally
	 * so the calculations will work correctly
	 *
	 * @since 2.0.5
	 *
	 * @param array $field
	 * @param string $field_name
	 * @param string|boolean $opt_key
	 * @param string $html_id
	 */
	private static function hidden_html_id( $field, $field_name, $opt_key, &$html_id ) {
		$html_id_end = $opt_key;
		if ( isset( $field['original_type'] ) ) {

			if ( $opt_key === false && in_array( $field['original_type'], array( 'radio', 'checkbox', 'scale' ) ) ) {
				$html_id_end = 0;
			} else if ( $field['original_type'] == 'divider' ) {
				$parts = explode( '][', $field_name . '[' );

				if ( count( $parts ) > 2 ) {
					if ( $parts[1] === 'form' || $parts[1] === 'id' ) {
						// Do nothing
					} else if ( $parts[2] === 'other' ) {
						self::get_html_id_for_hidden_other_fields( $parts, $opt_key, $html_id );
						return;
					} else {
						$field_id = absint( $parts[2] );

						if ( $field_id === 0 ) {
							$html_id .= '-rowid';
							$html_id_end = $parts[1];
						} else {
							$field_key = FrmField::get_key_by_id( $field_id );
							if ( $field_key ) {
								$html_id = 'field_' . $field_key;
								$html_id_end = $parts[1];

								// allow for a multi-dimensional array for the ids
								if ( isset( $parts[3] ) && $parts[3] != '' ) {
									$html_id_end .= '-' . $parts[3];
								}
							}
						}
					}
				}
			}
		}
		if ( $html_id_end !== false ) {
			$html_id .= '-' . $html_id_end;
		}
	}

	/**
	* Get the HTML ID for hidden other fields inside of repeating sections
	*
	* @since 2.0.8
	* @param array $parts (array of the field name)
	* @param string|boolean|int $opt_key
	* @param string $html_id, pass by reference
	*/
	private static function get_html_id_for_hidden_other_fields( $parts, $opt_key, &$html_id ) {
		$field_id = absint( $parts[3] );
		$field_key = FrmField::get_type( $field_id, 'field_key' );

		if ( $field_key ) {
			$html_id = 'field_' . $field_key . '-' . $parts[1];

			// If checkbox field or multi-select dropdown
			if ( $opt_key && FrmFieldsHelper::is_other_opt( $opt_key ) ) {
				$html_id .= '-' . $opt_key . '-otext';
			} else {
				$html_id .= '-otext';
			}
		}
	}

	/**
	* Add confirmation and "other" hidden fields to help carry all data throughout the form
	* Note: This doesn't control the HTML for fields in repeating sections
	*
	* @since 2.0
	*
	* @param array $field
	* @param string $opt_key
	* @param string $html_id
	*/
	public static function insert_extra_hidden_fields( $field, $opt_key = false ) {
		// If we're dealing with a repeating section, hidden fields are already taken care of
		if ( isset( $field['original_type'] ) && $field['original_type'] == 'divider' ) {
			return;
		}

		//If confirmation field on previous page, store value in hidden field
		if ( FrmField::is_option_true( $field, 'conf_field' ) && isset( $_POST['item_meta']['conf_' . $field['id']] ) ) {
		    self::insert_hidden_confirmation_fields( $field );

		//If Other field on previous page, store value in hidden field
		} else if ( FrmField::is_option_true( $field, 'other' ) && isset( $_POST['item_meta']['other'][ $field['id'] ] ) ) {
			self::insert_hidden_other_fields( $field, $opt_key );
		}
    }

	/**
	* Insert hidden confirmation fields
	*
	* @since 2.0.8
	* @param array $field
	*/
	private static function insert_hidden_confirmation_fields( $field ){
		if ( isset( $field['reset_value'] ) && $field['reset_value'] ) {
			$value = '';
		} else {
			$value = $_POST['item_meta'][ 'conf_' . $field['id'] ];
		}

		include( FrmAppHelper::plugin_path() .'/pro/classes/views/frmpro-fields/front-end/hidden-conf-field.php' );
	}

	/**
	* Insert hidden Other fields
	*
	* @since 2.0.8
	* @param array $field
	* @param string|int|boolean $opt_key
	* @param string $html_id
	*/
	private static function insert_hidden_other_fields( $field, $opt_key ){
		$other_id = FrmFieldsHelper::get_other_field_html_id( $field['original_type'], $field['html_id'], $opt_key );

		// Checkbox and multi-select dropdown fields
		if ( $opt_key && ! is_numeric( $opt_key ) && isset( $_POST['item_meta']['other'][ $field['id'] ][ $opt_key ] ) && $_POST['item_meta']['other'][ $field['id'] ][ $opt_key ] ) {
			$posted_val = stripslashes_deep( $_POST['item_meta']['other'][ $field['id'] ][ $opt_key ] );
		    ?>
			<input type="hidden" name="item_meta[other][<?php echo esc_attr( $field['id'] ) ?>][<?php echo esc_attr( $opt_key ) ?>]" id="<?php echo esc_attr( $other_id ) ?>" value="<?php echo esc_attr( $posted_val ); ?>" />
		    <?php

		// Radio fields and regular dropdowns
		} else if ( ! is_array( $field['value'] ) && ! is_array( $_POST['item_meta']['other'][ $field['id'] ] ) ) {
			$posted_val = stripslashes_deep( $_POST['item_meta']['other'][ $field['id'] ] );
			?>
			<input type="hidden" name="item_meta[other][<?php echo esc_attr( $field['id'] ) ?>]" id="<?php echo esc_attr( $other_id ) ?>" value="<?php echo esc_attr( $posted_val ); ?>" />
		    <?php
		}
	}

    /**
     * Check if the field is in a child form and return the parent form id
     * @since 2.0
     * @return int The ID of the form or parent form
     */
    public static function get_parent_form_id($field) {
        $form = FrmForm::getOne($field->form_id);

        // include the parent form ids if this is a child field
        $form_id = $field->form_id;
        if ( ! empty($form->parent_form_id) ) {
            $form_id = $form->parent_form_id;
        }

        return $form_id;
    }

    /**
     * Get the parent section field
     *
     * @since 2.0
     * @return Object|false The section field object if there is one
     */
    public static function get_parent_section($field, $form_id = 0) {
		if ( ! $form_id ) {
            $form_id = $field->form_id;
        }

		$query = array( 'fi.field_order <' => $field->field_order - 1, 'fi.form_id' => $form_id, 'fi.type' => array( 'divider', 'end_divider') );
        $section = FrmField::getAll($query, 'field_order', 1);

        return $section;
    }

    public static function field_on_current_page($field) {
        global $frm_vars;
        $current = true;

        $prev = 0;
        $next = 9999;
        if ( ! is_object($field) ) {
            $field = FrmField::getOne($field);
        }

        if ( $frm_vars['prev_page'] && is_array($frm_vars['prev_page']) && isset($frm_vars['prev_page'][$field->form_id]) ) {
            $prev = $frm_vars['prev_page'][$field->form_id];
        }

        if ( $frm_vars['next_page'] && is_array($frm_vars['next_page']) && isset($frm_vars['next_page'][$field->form_id]) ) {
            $next = $frm_vars['next_page'][$field->form_id];
            if ( is_object($next) ) {
                $next = $next->field_order;
            }
        }

        if ( $field->field_order < $prev || $field->field_order > $next ) {
            $current = false;
        }

        $current = apply_filters('frm_show_field_on_page', $current, $field);
        return $current;
    }

	public static function switch_field_ids( $val ) {
        // for reverse compatability
        return FrmFieldsHelper::switch_field_ids($val);
    }

	public static function get_table_options( $field_options ) {
 		$columns = array();
 		$rows = array();
		if ( is_array( $field_options ) ) {
			foreach ( $field_options as $opt_key => $opt ) {
				switch ( substr( $opt_key, 0, 3 ) ) {
 				case 'col':
 					$columns[$opt_key] = $opt;
 					break;
 				case 'row':
 					$rows[$opt_key] = $opt;
 					break;
 				}
 			}
 		}
 		return array( $columns, $rows );
 	}

	public static function set_table_options( $field_options, $columns, $rows ) {
		if ( is_array( $field_options ) ) {
			foreach ( $field_options as $opt_key => $opt ) {
				if ( substr( $opt_key, 0, 3 ) == 'col' || substr( $opt_key, 0, 3 ) == 'row' ) {
 					unset($field_options[$opt_key]);
				}
 			}
			unset( $opt_key, $opt );
		} else {
 			$field_options = array();
		}

		foreach ( $columns as $opt_key => $opt ) {
			$field_options[ $opt_key ] = $opt;
		}

		foreach ( $rows as $opt_key => $opt ) {
			$field_options[ $opt_key ] = $opt;
		}

 		return $field_options;
 	}

	public static function modify_available_fields( $field_types ) {
		// Add additional options to Section fields
		$field_types['divider'] = array(
			'name'  => __( 'Section', 'formidable' ),
			'types' => array(
				''   => __( 'Heading', 'formidable' ),
				'slide'  => __( 'Collapsible', 'formidable' ),
				'repeat' => __( 'Repeatable', 'formidable' ),
			),
		);

		// Add additional options to Dynamic fields
		$field_types['data'] = array(
			'name'  => __( 'Dynamic Field', 'formidable' ),
			'types' => array(
				'select'    => __( 'Dropdown', 'formidable' ),
				'radio'     => __( 'Radio Buttons', 'formidable' ),
				'checkbox'  => __( 'Checkboxes', 'formidable' ),
				'data'      => __( 'List', 'formidable' ),
			),
		);

		// only show the credit card field when an add-on says so
		$show_credit_card = apply_filters( 'frm_include_credit_card', false );
		if ( ! $show_credit_card ) {
			unset( $field_types['credit_card'] );
		}

		$field_types['lookup'] = FrmProLookupFieldsController::get_lookup_options_for_insert_fields_tab();

		return $field_types;
	}

	/**
	* Allow text values to autopopulate Dynamic fields
	*
	* @since 2.0.15
	* @param string|array $value
	* @param object $field
	* @param boolean $dynamic_default
	* @param boolean $allow_array
	* @return string|array $value
	*/
	public static function get_dynamic_field_default_value( $value, $field, $dynamic_default = true, $allow_array = false ) {
		if ( $field->type == 'data' && isset( $field->field_options['data_type'] ) && $field->field_options['data_type'] != 'data' && $value && ! is_numeric( $value ) ) {
			// If field is Dynamic dropdown, checkbox, or radio field and the default value is not an entry ID

			if ( is_array( $value ) ) {
				$new_values = array();
				foreach ( $value as $val ) {
					$val = trim( $val );
					if ( $val && ! is_numeric( $val ) ) {
						$new_values[] = self::get_id_for_dynamic_field( $field, $val );
					} else if ( is_numeric( $val ) ) {
						$new_values[] = $val;
					}
				}
				$value = $new_values;
			} else {
				$value = self::get_id_for_dynamic_field( $field, $value );
			}
		}
		return $value;
	}

	/**
	* Get the entry ID or category ID to autopopulate a Dynamic field
	*
	* @since 2.0.15
	* @param object $field
	* @param string $value
	* @return int $value
	*/
	private static function get_id_for_dynamic_field( $field, $value ) {
		if ( isset( $field->field_options['post_field'] ) && $field->field_options['post_field'] == 'post_category' ) {
			// Category fields
			$id = FrmProField::get_cat_id_from_text( $value );
		} else {
			// Non post fields
			$id = FrmProField::get_dynamic_field_entry_id( $field->field_options['form_select'], $value, '=' );
		}
		return $id;
	}

	/**
	* Get the hidden inputs for a Dynamic field when it has no options to show or when it is readonly
	*
	* @since 2.0.16
	* @param array $field
	* @param string $disabled
	*/
	public static function maybe_get_hidden_dynamic_field_inputs( $field, $args ) {
		if ( ! in_array( $field['data_type'], array( 'select', 'radio', 'checkbox' ) ) ) {
			return;
		}

		if ( ( empty( $field['options'] ) || ! empty( $args['disabled'] ) ) ) {
			$field_name = $args['field_name'];
			$html_id = $args['html_id'];

			if ( is_array( $field['value'] ) ) {
				foreach ( $field['value'] as $value ) {
					require( FrmAppHelper::plugin_path() .'/pro/classes/views/frmpro-fields/hidden-dynamic-inputs.php' );
            	}
			} else {
				$value = $field['value'];
				require( FrmAppHelper::plugin_path() .'/pro/classes/views/frmpro-fields/hidden-dynamic-inputs.php' );
			}
		}
	}
}
