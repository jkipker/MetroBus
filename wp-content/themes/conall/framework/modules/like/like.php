<?php
class ConallEdgeClassLike {

	private static $instance;

	private function __construct() {
		add_action('wp_enqueue_scripts', array( $this, 'enqueue_scripts'));
		add_action('wp_ajax_conall_edge_like', array( $this, 'ajax'));
		add_action('wp_ajax_nopriv_conall_edge_like', array( $this, 'ajax'));
	}

	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;

	}

	function enqueue_scripts() {

		wp_enqueue_script( 'edgtf-like', EDGE_ASSETS_ROOT . '/js/like.js', 'jquery', '1.0', TRUE );

		wp_localize_script( 'edgtf-like', 'edgtfLike', array(
			'ajaxurl' => admin_url('admin-ajax.php')
		));
	}

	function ajax(){

		//update
		if( isset($_POST['likes_id']) ) {

			$post_id = str_replace('edgtf-like-', '', $_POST['likes_id']);
			$post_id = substr($post_id, 0, -4);
			$type    = isset($_POST['type']) ? $_POST['type'] : '';

			echo wp_kses($this->like_post($post_id, 'update', $type), array(
				'span' => array(
					'class' => true,
					'aria-hidden' => true,
					'style' => true,
					'id' => true
				),
				'i' => array(
					'class' => true,
					'style' => true,
					'id' => true
				)
			));
		}

		//get
		else {
			$post_id = str_replace('edgtf-like-', '', $_POST['likes_id']);
			$post_id = substr($post_id, 0, -4);
			echo wp_kses($this->like_post($post_id, 'get'), array(
				'span' => array(
					'class' => true,
					'aria-hidden' => true,
					'style' => true,
					'id' => true
				),
				'i' => array(
					'class' => true,
					'style' => true,
					'id' => true
				)
			));
		}
		exit;
	}

	public function like_post($post_id, $action = 'get', $type = ''){
		if(!is_numeric($post_id)) return;

		switch($action) {

			case 'get':
				$like_count = get_post_meta($post_id, '_edgt-like', true);
				if(isset($_COOKIE['edgtf-like_'. $post_id])){
					$icon = '<i class="icon_heart" aria-hidden="true"></i>';
				}else{
					$icon = '<i class="icon_heart_alt" aria-hidden="true"></i>';
				}
				if( !$like_count ){
					$like_count = 0;
					add_post_meta($post_id, '_edgt-like', $like_count, true);
					$icon = '<i class="icon_heart_alt" aria-hidden="true"></i>';
				}
				$return_value = $icon . "<span>" . $like_count . "</span>";

				return $return_value;
				break;

			case 'update':
				$like_count = get_post_meta($post_id, '_edgt-like', true);

				if($type != 'portfolio_list' && isset($_COOKIE['edgtf-like_'. $post_id])) {
					return $like_count;
				}

				$like_count++;

				update_post_meta($post_id, '_edgt-like', $like_count);
				setcookie('edgtf-like_'. $post_id, $post_id, time()*20, '/');

				if($type != 'portfolio_list') {
					$return_value = "<i class='icon_heart' aria-hidden='true'></i><span>" . $like_count . "</span>";

					$return_value .= '</span>';
					return $return_value;
				}

				return '';
				break;
			default:
				return '';
				break;
		}
	}

	public function add_like() {
		global $post;

		$output = $this->like_post($post->ID);

		$class = 'edgtf-like';
		$rand_number = rand(100, 999);
		$title = esc_html__('Like this', 'conall');
		if( isset($_COOKIE['edgtf-like_'. $post->ID]) ){
			$class = 'edgtf-like liked';
			$title = esc_html__('You already like this!', 'conall');
		}

		return '<a href="#" class="'. $class .'" id="edgtf-like-'. $post->ID .'-'. $rand_number.'" title="'. $title .'">'. $output .'</a>';
	}

	public function add_like_portfolio_list($portfolio_project_id){

		$class = 'edgtf-like';
		$rand_number = rand(100, 999);
		$title = esc_html__('Like this', 'conall');
		if( isset($_COOKIE['edgtf-like_'. $portfolio_project_id]) ){
			$class = 'edgtf-like liked';
			$title = esc_html__('You already like this!', 'conall');
		}

		return '<a class="'. $class .'" data-type="portfolio_list" id="edgtf-like-'. $portfolio_project_id .'-'. $rand_number.'" title="'. $title .'"></a>';
	}

	public function add_like_blog_list($blog_id){

		$class = 'edgtf-like';
		$rand_number = rand(100, 999);
		$title = esc_html__('Like this', 'conall');
		if( isset($_COOKIE['edgtf-like_'. $blog_id]) ){
			$class = 'edgtf-like liked';
			$title = esc_html__('You already like this!', 'conall');
		}

		return '<a class="hover_icon '. $class .'" data-type="portfolio_list" id="edgtf-like-'. $blog_id .'-'. $rand_number.'" title="'. $title .'"></a>';
	}
}

if ( !function_exists( 'conall_edge_create_like' ) ) {

    function conall_edge_create_like() {
        ConallEdgeClassLike::get_instance();
    }

    add_action('after_setup_theme', 'conall_edge_create_like');
}