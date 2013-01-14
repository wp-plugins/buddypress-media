<?php
/**
 * This protects from direct access
 */
if ( ! defined( 'ABSPATH' ) )
	exit;

/**
 * Base class for creating BuddyPress Media Tabs on the user profile
 *
 * @author Saurabh Shukla <saurabh.sahukla@rtcamp.com>
 * @author Gagandeep Singh <gagandeep.singh@rtcamp.com>
 */
if ( ! class_exists( 'BPMediaScreen' ) ) {

	class BPMediaScreen {

		/**
		 *
		 * @var string Slug to be used for the media type/screen
		 */
		public $slug = NULL;

		/**
		 *
		 * @var string Media type for use in the class
		 */
		public $media_type = '';

		/**
		 *
		 * @var string Media type string used to build constants
		 */
		public $media_const = '';

		/**
		 *
		 * @var string Plural media type string
		 */
		public $medias_type = '';

		public $template='';

		/**
		 * Populates all the variables of the class, $media_type, $media_const, $medias_type
		 *
		 * @param string $media_type The media type for which the screen is going to be created
		 * @param string $slug The slug to use for the media type
		 */
		public function __construct( $media_type, $slug ) {
			$this->slug = $slug;
			$this->media_constant( $media_type );
			$this->template = new BPMediaTemplate();
		}

		/**
		 * Populates variable $media_type
		 * @param string $media_type
		 */
		private function media( $media_type ) {
			$this->media_type = $media_type;
		}

		/**
		 * Creates plural
		 * @param type $media_type
		 */
		private function medias( $media_type ) {
			$this->media( $media_type );
			$media = strtolower( $this->media_type );
			if ( $media != 'audio' ) {
				$media .= 's';
			}
			$this->medias_type = $media;
		}

		/**
		 *
		 * @param type $media_type
		 */
		private function media_constant( $media_type ) {
			$this->medias( $media_type );
			$this->media_const = strtoupper( $this->medias_type );
		}

		/**
		 *
		 */
		public function hook_before() {
			do_action( 'bp_media_before_content' );
			do_action( 'bp_media_before_' . $this->slug );
		}

		/**
		 *
		 */
		public function hook_after() {
			do_action( 'bp_media_after_' . $this->slug );
			do_action( 'bp_media_after_content' );
		}

		/**
		 *
		 * @global type $bp_media
		 */
		private function page_not_exist() {
			@setcookie( 'bp-message', __( 'The requested url does not exist', BP_MEDIA_TXT_DOMAIN ), time() + 60 * 60 * 24, COOKIEPATH );
			@setcookie( 'bp-message-type', 'error', time() + 60 * 60 * 24, COOKIEPATH );
			$this->template->redirect($this->media_const);
			exit;
		}

		/**
		 *
		 * @global type $bp_media
		 */
		private function screen_title() {
			printf( __( '%s List Page', BP_MEDIA_TXT_DOMAIN ), $this->slug );
		}

		/**
		 *
		 * @global type $bp
		 */
		public function screen() {
			$editslug = 'BP_MEDIA_' . $this->media_const . '_EDIT_SLUG';
			$entryslug = 'BP_MEDIA_' . $this->media_const . '_ENTRY_SLUG';

			global $bp;

			remove_filter( 'bp_activity_get_user_join_filter', 'activity_query_filter', 10 );
			if ( isset( $bp->action_variables[ 0 ] ) ) {
				switch ( $bp->action_variables[ 0 ] ) {
					case constant( $editslug ) :
						$this->edit_screen();
						break;
					case constant( $entryslug ) :
						$this->entry_screen();
						break;
					case BP_MEDIA_DELETE_SLUG :
						if ( ! isset( $bp->action_variables[ 1 ] ) ) {
							$this->page_not_exist();
						}
						$this->entry_delete();
						break;
					default:
						$this->set_query();
						add_action( 'bp_template_content', array( $this, 'screen_content' ) );
				}
			} else {
				$this->set_query();
				add_action( 'bp_template_content', array( $this, 'screen_content' ) );
			}
			$this->template->loader();
		}

		/**
		 *
		 * @global type $bp_media
		 * @global type $bp_media_query
		 * @global type $bp_media_albums_query
		 */
		function screen_content() {
			global $bp_media_query, $bp_media_albums_query;
			$this->set_query();

			$this->hook_before();
			if ( $bp_media_query && $bp_media_query->have_posts() ):
				echo '<ul id="bp-media-list" class="bp-media-gallery item-list">';
				while ( $bp_media_query->have_posts() ) : $bp_media_query->the_post();
					$this->template->the_content();
				endwhile;
				echo '</ul>';
				$this->template->show_more();
			else:
				BPMediaFunction::show_formatted_error_message( sprintf( __( 'Sorry, no %s were found.', BP_MEDIA_TXT_DOMAIN ), $this->slug ), 'info' );
			endif;
			$this->hook_after();
		}

		/**
		 *
		 * @global type $bp
		 * @global BPMediaHostWordpress $bp_media_current_entry
		 * @return boolean
		 */
		function entry_screen() {

			global $bp, $bp_media_current_entry;
			$entryslug = 'BP_MEDIA_' . $this->media_const . '_ENTRY_SLUG';
			if ( ! $bp->action_variables[ 0 ] == constant( $entryslug ) )
				return false;
			try {

				$bp_media_current_entry = new BPMediaHostWordpress( $bp->action_variables[ 1 ] );
			} catch ( Exception $e ) {
				/* Send the values to the cookie for page reload display */
				@setcookie( 'bp-message', $_COOKIE[ 'bp-message' ], time() + 60 * 60 * 24, COOKIEPATH );
				@setcookie( 'bp-message-type', $_COOKIE[ 'bp-message-type' ], time() + 60 * 60 * 24, COOKIEPATH );
				$this->template->redirect($this->media_const);
				exit;
			}

			$this->template_actions( 'entry_screen' );
			$this->template->loader();
		}

		/**
		 *
		 * @global BPMediaHostWordpress $bp_media_current_entry
		 */
		function entry_screen_title() {

			global $bp_media_current_entry;
			/** @var $bp_media_current_entry BPMediaHostWordpress */
			if ( is_object( $bp_media_current_entry ) )
				echo $bp_media_current_entry->get_media_single_title();
		}

		/**
		 *
		 * @global type $bp
		 * @global BPMediaHostWordpress $bp_media_current_entry
		 * @return boolean
		 */
		function entry_screen_content() {
			global $bp, $bp_media_current_entry;
			$entryslug = 'BP_MEDIA_' . $this->media_const . '_ENTRY_SLUG';
			$this->hook_before();
			if ( ! $bp->action_variables[ 0 ] == constant( $entryslug ) )
				return false;
			echo '<div class="bp-media-single bp-media-image">';
			echo $bp_media_current_entry->get_media_single_content();
			echo $bp_media_current_entry->show_comment_form();
			echo '</div>';
			$this->hook_after();
		}

		/**
		 *
		 * @global BPMediaHostWordpress $bp_media_current_entry
		 * @global type $bp
		 */
		function edit_screen() {
			global $bp_media_current_entry, $bp;
			if ( ! isset( $bp->action_variables[ 1 ] ) ) {
				$this->page_not_exist();
			}
			//Creating global bp_media_current_entry for later use
			try {
				$bp_media_current_entry = new BPMediaHostWordpress( $bp->action_variables[ 1 ] );
			} catch ( Exception $e ) {
				/* Send the values to the cookie for page reload display */
				@setcookie( 'bp-message', $e->getMessage(), time() + 60 * 60 * 24, COOKIEPATH );
				@setcookie( 'bp-message-type', 'error', time() + 60 * 60 * 24, COOKIEPATH );
				$this->template->redirect($this->media_const);
				exit;
			}
			BPMediaFunction::check_user();

			//For saving the data if the form is submitted
			if ( array_key_exists( 'bp_media_title', $_POST ) ) {
				BPMediaFunction::update_media();
			}
			$this->template_actions( 'edit_screen' );
			$this->template->loader();
		}

		/**
		 *
		 * @global type $bp_media
		 */
		function edit_screen_title() {
			printf( __( 'Edit %s', BP_MEDIA_TXT_DOMAIN ), $this->slug );
		}

		/**
		 *
		 * @global type $bp
		 * @global BPMediaHostWordpress $bp_media_current_entry
		 * @global type $bp_media_default_excerpts
		 * @global type $bp_media
		 */
		function edit_screen_content() {
			global $bp_media_current_entry, $bp_media_default_excerpts;
			?>
			<form method="post" class="standard-form" id="bp-media-upload-form">
				<label for="bp-media-upload-input-title">
						<?php printf( __( '%s Title', BP_MEDIA_TXT_DOMAIN ), ucfirst( $this->media_type ) ); ?>
				</label>
				<input id="bp-media-upload-input-title" type="text" name="bp_media_title" class="settings-input"
					   maxlength="<?php echo max( array( $bp_media_default_excerpts[ 'single_entry_title' ], $bp_media_default_excerpts[ 'activity_entry_title' ] ) ) ?>"
					   value="<?php echo $bp_media_current_entry->get_title(); ?>" />
				<label for="bp-media-upload-input-description">
			<?php printf( __( '%s Description', BP_MEDIA_TXT_DOMAIN ), ucfirst( $this->media_type ) ); ?>
				</label>
				<input id="bp-media-upload-input-description" type="text" name="bp_media_description" class="settings-input"
					   maxlength="<?php echo max( array( $bp_media_default_excerpts[ 'single_entry_description' ], $bp_media_default_excerpts[ 'activity_entry_description' ] ) ) ?>"
					   value="<?php echo $bp_media_current_entry->get_content(); ?>" />
				<div class="submit">
					<input type="submit" class="auto" value="<?php _e( 'Update', BP_MEDIA_TXT_DOMAIN ); ?>" />
					<a href="<?php echo $bp_media_current_entry->get_url(); ?>" class="button" title="<?php _e( 'Back to Media File', BP_MEDIA_TXT_DOMAIN ); ?>">
			<?php _e( 'Back to Media', BP_MEDIA_TXT_DOMAIN ); ?>
					</a>
				</div>
			</form>
			<?php
		}

		/**
		 *
		 * @global type $bp
		 * @global type $bp_media
		 * @global BPMediaHostWordpress $bp_media_current_entry
		 */
		function entry_delete() {
			global $bp;
			if ( bp_loggedin_user_id() != bp_displayed_user_id() ) {
				bp_core_no_access( array(
					'message' => __( 'You do not have access to this page.', BP_MEDIA_TXT_DOMAIN ),
					'root' => bp_displayed_user_domain(),
					'redirect' => false
				) );
				exit;
			}
			if ( ! isset( $bp->action_variables[ 1 ] ) ) {
				@setcookie( 'bp-message', __( 'The requested url does not exist', BP_MEDIA_TXT_DOMAIN ), time() + 60 * 60 * 24, COOKIEPATH );
				@setcookie( 'bp-message-type', 'error', time() + 60 * 60 * 24, COOKIEPATH );
				$this->template->redirect($this->media_const);
				exit;
			}
			global $bp_media_current_entry;
			try {
				$bp_media_current_entry = new BPMediaHostWordpress( $bp->action_variables[ 1 ] );
			} catch ( Exception $e ) {
				/* Send the values to the cookie for page reload display */
				@setcookie( 'bp-message', $e->getMessage(), time() + 60 * 60 * 24, COOKIEPATH );
				@setcookie( 'bp-message-type', 'error', time() + 60 * 60 * 24, COOKIEPATH );
				$this->template->redirect($this->media_const);
				exit;
			}
			$post_id = $bp_media_current_entry->get_id();
			$activity_id = get_post_meta( $post_id, 'bp_media_child_activity', true );

			bp_activity_delete_by_activity_id( $activity_id );
			$bp_media_current_entry->delete_media();

			@setcookie( 'bp-message', __( 'Media deleted successfully', BP_MEDIA_TXT_DOMAIN ), time() + 60 * 60 * 24, COOKIEPATH );
			@setcookie( 'bp-message-type', 'success', time() + 60 * 60 * 24, COOKIEPATH );
			$this->template->redirect($this->media_const);
			exit;
		}

		/**
		 *
		 * @param type $action
		 */
		function template_actions( $action ) {
			add_action( 'bp_template_title', array( $this, $action . '_title' ) );
			add_action( 'bp_template_content', array( $this, $action . '_content' ) );
		}



		/**
		 *
		 * @global type $bp
		 * @global type $bp_media_posts_per_page
		 * @global type $bp_media_query
		 */
		public function set_query() {
			global $bp, $bp_media_posts_per_page, $bp_media_query;
			switch ( $bp->current_action ) {
				case BP_MEDIA_IMAGES_SLUG:
					$type = 'image';
					break;
				case BP_MEDIA_AUDIO_SLUG:
					$type = 'audio';
					break;
				case BP_MEDIA_VIDEOS_SLUG:
					$type = 'video';
					break;
				default :
					$type = null;
			}
			if ( isset( $bp->action_variables ) && is_array( $bp->action_variables ) && isset( $bp->action_variables[ 0 ] ) && $bp->action_variables[ 0 ] == 'page' && isset( $bp->action_variables[ 1 ] ) && is_numeric( $bp->action_variables[ 1 ] ) ) {
				$paged = $bp->action_variables[ 1 ];
			} else {
				$paged = 1;
			}
			if ( $type ) {
				$args = array(
					'post_type' => 'attachment',
					'post_status' => 'any',
					'post_mime_type' => $type,
					'author' => $bp->displayed_user->id,
					'meta_key' => 'bp-media-key',
					'meta_value' => $bp->displayed_user->id,
					'meta_compare' => '=',
					'paged' => $paged,
					'posts_per_page' => $bp_media_posts_per_page
				);

				$bp_media_query = new WP_Query( $args );
			}
		}

	}

}
?>
