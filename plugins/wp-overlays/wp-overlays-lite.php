<?php
/**
 * WP_Overlays_Pro class file.
 * @package Posts
 * @author Flipper Code <hello@flippercode.com>
 * @package 1.0.1
 */

/*
Plugin Name: WP Overlays
Plugin URI: http://www.flippercode.com/
Description:  A complete solution for text and images overlays..
Author: flippercode
Author URI: http://www.flippercode.com/
Version: 1.0.1
Text Domain: op_lang
Domain Path: /lang/
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( 'You are not allowed to call this page directly.' );
}

if ( ! class_exists( 'WP_Overlays_Pro' ) ) {

	/**
	 * Main plugin class
	 * @author Flipper Code <hello@flippercode.com>
	 * @package Posts
	 */
	class WP_Overlays_Pro
	{
		/**
		 * List of Modules.
		 * @var array
		 */
		private $modules = array();

		/**
		 * Intialize variables, files and call actions.
		 * @var array
		 */
		public function __construct() {
			error_reporting( E_ERROR | E_PARSE );
			$this->_define_constants();
			$this->_load_files();
			register_activation_hook( __FILE__, array( $this, 'plugin_activation' ) );
			register_deactivation_hook( __FILE__, array( $this, 'plugin_deactivation' ) );
			add_action( 'plugins_loaded', array( $this, 'load_plugin_languages' ) );
			add_action( 'init', array( $this, '_init' ) );
			add_filter( 'post_thumbnail_html', array( $this, 'overlay_mask_html' ), 10, 3 );
			add_shortcode( 'overlays', array( $this, 'overlay_custom_display' ),10, 1 );
		}

		function overlay_mask_html( $html, $post_id, $post_image_id ) {
			$post_type = get_post_type();
			$data = get_option( 'blogpost_settings' );
			$overlay_content = $data['overlay_content'][ $post_type ];

			if ( ! $data ) {
				 $overlay_content = '<a  class="expand" href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">+</a>';
			}

			 $overlay_content = $this->overlay_render_content( $overlay_content, $post_id );

			if ( is_front_page() ) {
				$current_status = 'post_listing'; }

			if ( is_single( $post_id ) or is_page($post_id) ) {
				$current_status = 'single_post'; }

			if ( is_archive() ) {
				$current_status = 'archieves_page'; }

			if ( ! empty( $data['apply_on'][$post_type] ) ) {
				if ( in_array( $current_status, $data['apply_on'][$post_type] ) ) {
					$content = do_shortcode( '[overlays in='.$data['slide_effect']." post_feature_image='".$html."' out=".$data['slide_effect_exit'].' speed='.(10-$data['animation_speed']).' color='.$data['overlay_color'].' opacity='.($data['opacity_value'] / 100).' text_position='.$data['slide_text_position'].' height='.$data['overlay_height'].' width='.$data['overlay_width'].'  post_id='.$post_id.' ]'.stripcslashes( $overlay_content ).'[/overlays]' );
				} else {
					$content = $html;
				}
			} else {
			    $content = $html;
			}

			return $content;

		}
		/**
		 * Display overlays on the frontend using overlays shortcode.
		 * @param  array  $atts   Overlays Options.
		 * @param  string $content Content.
		 */
		function overlay_custom_display($atts, $content = '') {

			$get_data = get_option( 'user_overlay_settings' );

			extract( shortcode_atts( array(

				'width' => $get_data['overlay_width_value'],
				'height' => $get_data['overlay_height_value'],
				'color' => $get_data['overlay_color'],
				'speed' => $get_data['animation_speed'],
				'in' => $get_data['slide_effect'],
				'out' => $get_data['slide_effect_exit'],
				'opacity' => ($get_data['opacity_value'] / 100),
				'text_position' => $get_data['slide_text_position'],
				'src' => '',
				'class_on_image' => '',
				'post_id' => '',
				'attachment_id' => '',
			),$atts));

			if ( ! empty( $color ) ) {

				list($r, $g, $b) = sscanf( $color, '#%02x%02x%02x' );
				$bg = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
			}

			if ( $post_id and '' == $src ) {
				$thumb_id = get_post_thumbnail_id( $post_id );
				$thumb_url_array = wp_get_attachment_image_src( $thumb_id, '', true );
				$src = $thumb_url_array[0];

			}
			if ( $attachment_id ) {
				$thumb_id = get_post_thumbnail_id( $attachment_id );
				$thumb_url_array = wp_get_attachment_image_src( $thumb_id, '', true );
				$src = $thumb_url_array[0];

			}
			if ( $post_id > 0 and '' != $content ) {

				$content = $this->overlay_render_content( $content,$post_id );
			} elseif ( '' == $content and $post_id > 0 ) {

				$content = '<a  class="expand" href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '"><span class="icon_plus"></span></a>';

			} else {
				$content = $this->overlay_render_content( $content,'' );
			}

			if ( $atts['post_feature_image'] ) {
				$image = $atts['post_feature_image']; } else {
				$image = '<img src="'.$src.'" class="'.$class_on_image.'" />';
				$image = apply_filters( 'overlays_image',$image,$src,$class_on_image,$post_id );
				}

				$content = apply_filters( 'overlays_content',$content,$post_id );

				$overlay_placeholder = '<div rel="custom_overlay"  class="overlay-effect effects clearfix">
					<div class="img">
					'.$image.'
					<div class="overlay animated"  data-in="'.$in.'"  data-out="'.$out.'" data-width="'.$width.'" data-height="'.$height.'" data-speed="'.$speed.'" data-color="'.$bg.'" data-text-position="'.$text_position.'" data-class="'.$extra_classes.'">
					<div rel="overlay-content-placeholder" class="'.$text_position.'">
					'.stripcslashes( $content ).'
					</div>
					</div>
					</div>
				</div>';

				$overlay_placeholder = apply_filters( 'overlays_html',$overlay_placeholder,$post_id );

				return $overlay_placeholder;

		}

		function overlay_render_content($overlay_content,$post_id) {

			$separator = ' ';
			$output = '';


				$title = apply_filters( 'overlays_post_title',get_the_title( $post_id ),$post_id );
				$overlay_content = str_replace( '{post_title}',$title,$overlay_content );

				$title_link = apply_filters( 'overlays_post_link',get_permalink( $post_id ),$post_id );
				$overlay_content = str_replace( '{post_link}',$title_link,$overlay_content );

				$excerpt = apply_filters( 'overlays_post_excerpt',get_the_excerpt( $post_id ),$post_id );

				$overlay_content = str_replace( '{post_excerpt}', $excerpt,$overlay_content );

				$read_more = '<a  class="read-more" href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">Read more</a>';

				$read_more = apply_filters( 'overlays_post_readmore', $read_more,$post_id );

				$overlay_content = str_replace( '{read_more}',$read_more,$overlay_content );

				$link = get_permalink( $post_id );

				$title = esc_attr( get_the_title( $post_id ) );

				$overlay_content = do_shortcode( $overlay_content );


			return $overlay_content;

		}

		/**
		 * Call WordPress hooks.
		 */
		function _init() {
			global $wpdb;
			add_action( 'admin_menu', array( $this, 'create_menu' ) );
			if ( ! is_admin() ) {
				add_action( 'wp_enqueue_scripts', array( $this, 'wop_frontend_scripts' ) );
			}
		add_filter( 'plugin_action_links_'.plugin_basename(__FILE__), array($this,'plugin_action_links') );
		add_filter( 'plugin_row_meta', array($this,'plugin_row_meta'), 10,2 );

		}
		/**
		 * Settings link.
		 * @param  array $links Array of Links.
		 * @return array        Array of Links.
		 */
		function plugin_row_meta( $links, $file ) {

			if( basename(dirname($file)) == 'wp-overlays' ) {
				$links[] = '<a href="http://www.flippercode.com/product/wp-overlays-pro/" target="_blank">Upgrade to Pro</a>';
		   		$links[] = '<a href="http://www.flippercode.com/forums" target="_blank">Support Forums</a>';
			}		
		   
		   return $links;
		}
		/**
		 * Settings link.
		 * @param  array $links Array of Links.
		 * @return array        Array of Links.
		 */
		function plugin_action_links( $links ) {
		   $links[] = '<a href="'. esc_url( get_admin_url(null, 'admin.php?page=wop_manage_settings') ) .'">Settings</a>';
		   return $links;
		}

		/**
		 * Eneque scripts at frontend.
		 */
		function wop_frontend_scripts() {

			$scripts = array();
			wp_enqueue_script( 'jquery' );
			
			$scripts[] = array(
			'handle'  => 'wop-frontend',
			'src'   => WOP_JS.'frontend.js',
			'deps'    => array(),
			);

			$where = apply_filters( 'wop_script_position', true );
			if ( $scripts ) {
				foreach ( $scripts as $script ) {
					wp_enqueue_script( $script['handle'], $script['src'], $script['deps'], '', $where );
				}
			}

			$get_data = get_option( 'blogpost_settings' );
			$wop_js_lang = array();
			$wop_js_lang['ajax_url'] = admin_url( 'admin-ajax.php' );
			$wop_js_lang['nonce'] = wp_create_nonce( 'wop-call-nonce' );
			$wop_js_lang['confirm'] = __( 'Are you sure to delete item?',WOP_TEXT_DOMAIN );
			$wop_js_lang['opacity_value'] = $get_data['opacity_value'];
			$wop_js_lang['overlay_fontsize_value'] = $get_data['overlay_fontsize_value'];
			$wop_js_lang['overlay_width_value'] = $get_data['overlay_width_value'];
			$wop_js_lang['overlay_height_value'] = $get_data['overlay_height_value'];
			$wop_js_lang['slide_effect'] = $get_data['slide_effect'];
			$wop_js_lang['slide_effect_exit'] = $get_data['slide_effect_exit'];
			$wop_js_lang['animation_speed'] = $get_data['animation_speed'];
			wp_localize_script( 'wop-frontend', 'settings_obj', $wop_js_lang );
			$frontend_styles = array(
			'overlay_settings_style' => WOP_CSS.'overlaypro.css',
			);

			if ( $frontend_styles ) {
				foreach ( $frontend_styles as $frontend_style_key => $frontend_style_value ) {
					wp_enqueue_style( $frontend_style_key, $frontend_style_value );
				}
			}
		}

		/**
		 * Process slug and display view in the backend.
		 */
		function processor() {

			$return = '';
			if ( isset( $_GET['page'] ) ) {
				$page = sanitize_text_field( wp_unslash( $_GET['page'] ) );
			} else {
				$page = 'wop_view_overview';
			}

			$pageData = explode( '_', $page );

			if( 'wop' != strtolower($pageData[0])) {
				return;
			}
			$obj_type = $pageData[2];
			$obj_operation = $pageData[1];

			if ( count( $pageData ) < 3 ) {
				die( 'Cheating!' );
			}

			try {
				if ( count( $pageData ) > 3 ) {
					$obj_type = $pageData[2].'_'.$pageData[3];
				}

				$factoryObject = new WOP_Controller();
				$viewObject = $factoryObject->create_object( $obj_type );
				$viewObject->display( $obj_operation );

			} catch (Exception $e) {
				echo wop_Template::show_message( array( 'error' => $e->getMessage() ) );

			}

		}

		/**
		 * Create backend navigation.
		 */
		function create_menu() {

			global $navigations;

			$pagehook1 = add_menu_page(
				__( 'WP Overlays', WOP_TEXT_DOMAIN ),
				__( 'WP Overlays', WOP_TEXT_DOMAIN ),
				'wop_admin_overview',
				WOP_SLUG,
				array( $this,'processor' )
			);

			if ( current_user_can( 'manage_options' )  ) {
								$role = get_role( 'administrator' );
								$role->add_cap( 'wop_admin_overview' );
			}

			$this->load_modules_menu();

			add_action( 'load-'.$pagehook1, array( $this, 'wop_backend_scripts' ) );

		}

		/**
		 * Read models and create backend navigation.
		 */
		function load_modules_menu() {

			$modules = $this->modules;
			$pagehooks = array();
			if ( is_array( $modules ) ) {
				foreach ( $modules as $module ) {

						$object = new $module;
					if ( method_exists( $object,'navigation' ) ) {

						if ( ! is_array( $object->navigation() ) ) {
							continue;
						}

						foreach ( $object->navigation() as $nav => $title ) {

							if ( current_user_can( 'manage_options' ) && is_admin() ) {
								$role = get_role( 'administrator' );
								$role->add_cap( $nav );

							}

							$pagehooks[] = add_submenu_page(
								WOP_SLUG,
								$title,
								$title,
								$nav,
								$nav,
								array( $this,'processor' )
							);

						}
					}
				}
			}

			if ( is_array( $pagehooks ) ) {

				foreach ( $pagehooks as $key => $pagehook ) {
					add_action( 'load-'.$pagehooks[ $key ], array( $this, 'wop_backend_scripts' ) );
				}
			}

		}

		/**
		 * Eneque scripts in the backend.
		 */
		function wop_backend_scripts() {

			wp_enqueue_style( 'wp-color-picker' );
			$wp_scripts = array( 'jQuery', 'wp-color-picker', 'jquery-ui-datepicker','jquery-ui-slider' );

			if ( $wp_scripts ) {
				foreach ( $wp_scripts as $wp_script ) {
					wp_enqueue_script( $wp_script );
				}
			}

			$scripts = array();

			$scripts[] = array(
			'handle'  => 'wop-backend-bootstrap',
			'src'   => WOP_JS.'bootstrap.min.js',
			'deps'    => array(),
			);
			$scripts[] = array(
			'handle'  => 'wop-backend',
			'src'   => WOP_JS.'backend.js',
			'deps'    => array(),
			);
			if ( $scripts ) {
				foreach ( $scripts as $script ) {
					wp_enqueue_script( $script['handle'], $script['src'], $script['deps'] );
				}
			}
			$get_data = get_option( 'blogpost_settings' );
			$wop_js_lang = array();
			$wop_js_lang['ajax_url'] = admin_url( 'admin-ajax.php' );
			$wop_js_lang['nonce'] = wp_create_nonce( 'wop-call-nonce' );
			$wop_js_lang['confirm'] = __( 'Are you sure to delete item?',WOP_TEXT_DOMAIN );
			$wop_js_lang['opacity_value'] = $get_data['opacity_value'];
			$wop_js_lang['overlay_fontsize_value'] = $get_data['overlay_fontsize_value'];
			$wop_js_lang['overlay_width_value'] = $get_data['overlay_width_value'];
			$wop_js_lang['overlay_height_value'] = $get_data['overlay_height_value'];
			$wop_js_lang['slide_effect'] = $get_data['slide_effect'];
			$wop_js_lang['slide_effect_exit'] = $get_data['slide_effect_exit'];
			$wop_js_lang['animation_speed'] = $get_data['animation_speed'];
			wp_localize_script( 'wop-backend', 'settings_obj', $wop_js_lang );

			$admin_styles = array(
			'flippercode-bootstrap' => WOP_CSS.'bootstrap.min.flat.css',
			'wop-backend-style' => WOP_CSS.'backend.css',
			'overlay_settings_style' => WOP_CSS.'overlaypro.css',
			);

			if ( $admin_styles ) {
				foreach ( $admin_styles as $admin_style_key => $admin_style_value ) {
					wp_enqueue_style( $admin_style_key, $admin_style_value );
				}
			}

		}

		/**
		 * Load plugin language file.
		 */
		function load_plugin_languages() {

			load_plugin_textdomain( WOP_TEXT_DOMAIN, false, WOP_FOLDER.'/lang/' );
		}
		/**
		 * Call hook on plugin activation for both multi-site and single-site.
		 */
		function plugin_activation($network_wide = null) {

			if ( is_multisite() && $network_wide ) {
				global $wpdb;
				$currentblog = $wpdb->blogid;
				$activated = array();
				$sql = "SELECT blog_id FROM {$wpdb->blogs}";
				$blog_ids = $wpdb->get_col( $wpdb->prepare( $sql, null ) );

				foreach ( $blog_ids as $blog_id ) {
					switch_to_blog( $blog_id );
					$this->wop_activation();
					$activated[] = $blog_id;
				}

				switch_to_blog( $currentblog );
				update_site_option( 'op_activated', $activated );

			} else {
				$this->wop_activation();
			}
		}
		/**
		 * Call hook on plugin deactivation for both multi-site and single-site.
		 */
		function plugin_deactivation($network_wide) {

			if ( is_multisite() && $network_wide ) {
				global $wpdb;
				$currentblog = $wpdb->blogid;
				$activated = array();
				$sql = "SELECT blog_id FROM {$wpdb->blogs}";
				$blog_ids = $wpdb->get_col( $wpdb->prepare( $sql, null ) );

				foreach ( $blog_ids as $blog_id ) {
					switch_to_blog( $blog_id );
					$this->wop_deactivation();
					$activated[] = $blog_id;
				}

				switch_to_blog( $currentblog );
				update_site_option( 'op_activated', $activated );

			} else {
				$this->wop_deactivation();
			}
		}

		/**
		 * Perform tasks on plugin deactivation.
		 */
		function wop_deactivation() {

		}

		/**
		 * Perform tasks on plugin deactivation.
		 */
		function wop_activation() {

			global $wpdb;

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

			$modules = $this->modules;
			$pagehooks = array();

			if ( is_array( $modules ) ) {
				foreach ( $modules as $module ) {
					$object = new $module;
					if ( method_exists( $object,'install' ) ) {
								$tables[] = $object->install();
					}
				}
			}

			if ( is_array( $tables ) ) {
				foreach ( $tables as $i => $sql ) {
					dbDelta( $sql );
				}
			}

			$overlay_data = array(
			'slide_effect' => 'fadeIn',
					 'slide_effect_exit' => 'fadeOut',
					 'overlay_color'   => '#3e29b5',
					 'overlay_content' => '',
					 'opacity_value' => .5,
					 'overlay_width_value' => 100,
					 'overlay_height_value' => 100,
					 'show_effect_on' => 'pageload',
					 'apply_on' => array( 'post_listing' ),
					 'slide_text_position' => 'overlay_center',
					 'animation_speed' => 1,
					 );

			if ( get_option( 'blogpost' ) === false ) {
				add_option( 'blogpost_settings',  $overlay_data ); }

		}

		/**
		 * Define all constants.
		 */
		private function _define_constants() {

			global $wpdb;

			if ( ! defined( 'WOP_SLUG' ) ) {
				define( 'WOP_SLUG', 'wop_view_overview' );
			}

			if ( ! defined( 'WOP_VERSION' ) ) {
				define( 'WOP_VERSION', '1.0.1' );
			}

			if ( ! defined( 'WOP_TEXT_DOMAIN' ) ) {
				define( 'WOP_TEXT_DOMAIN', 'op_lang' );
			}

			if ( ! defined( 'WOP_FOLDER' ) ) {
				define( 'WOP_FOLDER', basename( dirname( __FILE__ ) ) );
			}

			if ( ! defined( 'WOP_DIR' ) ) {
				define( 'WOP_DIR', plugin_dir_path( __FILE__ ) );
			}

			if ( ! defined( 'WOP_CORE_CLASSES' ) ) {
				define( 'WOP_CORE_CLASSES', WOP_DIR.'core/' );
			}
			
			if ( ! defined( 'WOP_PLUGIN_CLASSES' ) ) {
				define( 'WOP_PLUGIN_CLASSES', WOP_DIR.'classes/' );
			}

			if ( ! defined( 'WOP_CONTROLLER' ) ) {
				define( 'WOP_CONTROLLER', WOP_CORE_CLASSES );
			}

			if ( ! defined( 'WOP_CORE_CONTROLLER_CLASS' ) ) {
				define( 'WOP_CORE_CONTROLLER_CLASS', WOP_CORE_CLASSES.'class.controller.php' );
			}

			if ( ! defined( 'WOP_MODEL' ) ) {
				define( 'WOP_MODEL', WOP_DIR.'modules/' );
			}

			if ( ! defined( 'WOP_URL' ) ) {
				define( 'WOP_URL', plugin_dir_url( WOP_FOLDER ).WOP_FOLDER.'/' );
			}

			if ( ! defined( 'FC_CORE_URL' ) ) {
				define( 'FC_CORE_URL', plugin_dir_url( WOP_FOLDER ).WOP_FOLDER.'/core/' );
			}

			if ( ! defined( 'WOP_INC_URL' ) ) {
				define( 'WOP_INC_URL', WOP_URL.'includes/' );
			}

			if ( ! defined( 'WOP_VIEWS_PATH' ) ) {
				define( 'WOP_VIEWS_PATH', WOP_MODEL.'view' );
			}

			if ( ! defined( 'WOP_CSS' ) ) {
				define( 'WOP_CSS', WOP_URL.'/assets/css/' );
			}

			if ( ! defined( 'WOP_JS' ) ) {
				define( 'WOP_JS', WOP_URL.'/assets/js/' );
			}

			if ( ! defined( 'WOP_IMAGES' ) ) {
				define( 'WOP_IMAGES', WOP_URL.'/assets/images/' );
			}

			if ( ! defined( 'WOP_FONTS' ) ) {
				define( 'WOP_FONTS', WOP_URL.'fonts/' );
			}

		}

		/**
		 * Load all required core classes.
		 */
		private function _load_files() {
			
			$coreInitialisationFile = plugin_dir_path( __FILE__ ).'core/class.initiate-core.php';
			if ( file_exists( $coreInitialisationFile ) ) {
			   require_once( $coreInitialisationFile );
			}
			
			//Load Plugin Files	
			$plugin_files_to_include = array('wop-controller.php',
											 'wop-model.php');
				
			
			foreach ( $plugin_files_to_include as $file ) {

				if(file_exists(WOP_PLUGIN_CLASSES . $file))
				require_once( WOP_PLUGIN_CLASSES . $file ); 
			}
			
			// Load all modules.
			$core_modules = array( 'overview','settings' );
			if ( is_array( $core_modules ) ) {
				foreach ( $core_modules as $module ) {

					$file = WOP_MODEL.$module.'/model.'.$module.'.php';
					if ( file_exists( $file ) ) {
						include_once( $file );
						$class_name = 'wop_Model_'.ucwords( $module );
						array_push( $this->modules, $class_name );
					}
				}
			}
		}
	}
}

new WP_Overlays_Pro();
