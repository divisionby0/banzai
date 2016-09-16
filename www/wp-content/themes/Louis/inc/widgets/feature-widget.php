<?php
/**
 * Adds louis_Feature_Widget widget.
 */
class louis_Feature_Widget extends WP_Widget
{

	/**
	 * Register widget with WordPress.
	 */
	public function __construct()
	{
		parent::__construct(
			'louis-feature-widget', // Base ID
			'Feature Widget', // Name
			array( 'description' => 'Front Page Feature Widget' )
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance )
	{
		$title = apply_filters( 'widget_title', $instance['title'] );
		$url = $instance['url'];

		if ( strpos( $url, 'http://' ) === false && strpos( $url, 'https://' ) === false ) {
			$url = 'http://' . $url;
		}

		echo $args['before_widget'];
		echo '<div class="featurewidgeticon">
                <a href="' . $url . '"><i class="' . $instance['icon'] . ' fa"></i></a>
              </div>';
		if ( !empty( $title ) ) {
			echo '<div class="featurewidgettext">';
			echo $args['before_title'] . $title . $args['after_title'];
			echo '<p>' . $instance['textbox'] . '</p>';
			echo '</div>';
		}


		echo $args['after_widget'];
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
	{
		$instance = array();
		$instance['title'] = sanitize_text_field( $new_instance['title'] );
		$instance['textbox'] = strip_tags( $new_instance['textbox'], '<a><span><i><em><strong><b><ul><ol><li><br><p>' );
		$instance['url'] = sanitize_text_field( $new_instance['url'] );
		$instance['icon'] = sanitize_text_field( $new_instance['icon'] );

		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance )
	{

		$title = ( isset( $instance['title'] ) ) ? $instance['title'] : 'Title';
		$textbox = ( isset( $instance['textbox'] ) ) ? $instance['textbox'] : 'Enter your text here';
		$url = ( isset( $instance['url'] ) ) ? $instance['url'] : 'http://www.yourpage.com';
		$icon = ( isset( $instance['icon'] ) ) ? $instance['icon'] : 'fa-book';


		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'louis' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
				   name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
				   value="<?php echo esc_attr( $title ); ?>"/>
		</p>



		<p>
			<label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'URL:', 'louis' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>"
				   name="<?php echo $this->get_field_name( 'url' ); ?>" type="text"
				   value="<?php echo esc_attr( $url ); ?>"/>
		</p>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'icon' ); ?>"><?php _e( 'Icon (see <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">this link</a> for reference):', 'louis' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'icon' ); ?>"
				   name="<?php echo $this->get_field_name( 'icon' ); ?>" type="text"
				   value="<?php echo esc_attr( $icon ); ?>"/>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'textbox' ); ?>"><?php _e( 'Text:', 'louis' ); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id( 'textbox' ); ?>"
				   name="<?php echo $this->get_field_name( 'textbox' ); ?>"><?php echo esc_attr( $textbox ); ?></textarea>
		</p>

	<?php
	}

}
// init the widget
function louis_register_feature_widget()
{
	register_widget( 'louis_Feature_Widget' );
}

add_action( 'widgets_init', 'louis_register_feature_widget' );