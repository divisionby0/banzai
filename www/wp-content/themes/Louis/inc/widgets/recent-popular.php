<?php

class louis_Recent_Popular_Posts_Widget extends WP_Widget
{

	public function __construct()
	{
		parent::__construct(
			'louis-recent-popular-posts-widget',
			__( 'Recent / Popular Posts', 'louis' ),
			array(
				'description' => __( 'Recent / popular posts widget for the sidebar', 'louis' ),
			)
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
		global $post;
		echo '<div class="tab_sec  sidebarwidget">
		<div class="tab_cont">
			<ul class="tab_head">
				<li class="active" id="tab1"><a>' . $instance['title-popular'] . '</a></li>
				<li id="tab2"><a>' . $instance['title-recent'] . '</a></li>
			</ul>
			<div class="clear"></div>
			<div class="tabs_cont">
			<div class="tab_content tab1">
			<ul>';

		$popular_args = array(
			'date_query'     => array(
				'after' => '1 ' . $instance['timeframe'] . ' ago'
			),
			'orderby'        => 'comment_count',
			'order'          => 'DESC',
			'posts_per_page' => $instance['limit'],
			'post_status'    => 'publish',
			'has_password'   => false,
		);
		if ($instance['timeframe'] === 'alltime') {
			unset($popular_args['date_query']);
		}
		$query = new WP_Query( $popular_args );
		$posts = $query->get_posts();
		foreach ( $posts as $post_obj ):
			$post = $post_obj;
			setup_postdata( $post );
			echo '<li>
					<span>' . get_avatar( $post->post_author, 67 ) . '</span>
					<div class="profile_cont">
						<h6><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h6>
						<p><i class="fa fa-calendar-check-o"></i><small>' . get_the_time( 'F j, Y' ) . '</small></p>
						<p><i class="fa fa-comment-o"></i><a>';
			comments_popup_link( __( 'Leave a comment', 'louis' ), __( '1 Comment', 'louis' ), __( '% Comments', 'louis' ) );
			echo '</a></p>
					</div>
					<div class="clear"></div>
				</li>';
		endforeach;
		echo '</ul>
		</div>
		<div class="tab_content tab2">
		<ul>';

		$recent_args = array(
			'orderby'        => 'date',
			'order'          => 'DESC',
			'posts_per_page' => $instance['limit'],
			'post_status'    => 'publish',
			'has_password'   => false,
		);
		$query = new WP_Query( $recent_args );
		$posts = $query->get_posts();
		foreach ( $posts as $post ):
			echo '<li>
					<span>' . get_avatar( $post->post_author, 67 ) . '</span>
					<div class="profile_cont">
						<h6><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h6>
						<p><i class="fa fa-calendar-check-o"></i><small>' . get_the_time( 'F j, Y' ) . '</small></p>
						<p><i class="fa fa-comment-o"></i><a>';
			comments_popup_link( __( 'Leave a comment', 'louis' ), __( '1 Comment', 'louis' ), __( '% Comments', 'louis' ) );
			echo '</a></p>
					</div>
					<div class="clear"></div>
				</li>';
		endforeach;

		echo '</ul>
		</div>
		</div>
		</div>
		</div>';

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
		$fields = array(
			'title-popular' => 'sanitize_text_field',
			'title-recent'  => 'sanitize_text_field',
			'timeframe'     => 'sanitize_text_field',
			'limit'         => 'intval',
		);
		foreach ( $fields as $field => $sanitization ) {
			$instance[$field] = $sanitization( $new_instance[$field] );
		}

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
		$title_popular = ( isset( $instance['title-popular'] ) ) ? $instance['title-popular'] : __( 'Популярное', 'louis' );
		$title_recent = ( isset( $instance['title-recent'] ) ) ? $instance['title-recent'] : __( 'Последнее', 'louis' );
		$timeframe = ( isset( $instance['timeframe'] ) ) ? $instance['timeframe'] : 'week';
		$limit = ( isset( $instance['limit'] ) ) ? $instance['limit'] : 3;
		?>
		<div class="louis-recent-popular-posts-widget-container">
			<p>
				<label
					for="<?php echo $this->get_field_id( 'title-popular' ); ?>"><?php _e( 'Title for Popular posts', 'louis' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title-popular' ); ?>"
					   name="<?php echo $this->get_field_name( 'title-popular' ); ?>" type="text"
					   value="<?php echo esc_attr( $title_popular ); ?>"/>
			</p>

			<p>
				<label
					for="<?php echo $this->get_field_id( 'title-recent' ); ?>"><?php _e( 'Title for Recent posts', 'louis' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'title-recent' ); ?>"
					   name="<?php echo $this->get_field_name( 'title-recent' ); ?>" type="text"
					   value="<?php echo esc_attr( $title_recent ); ?>"/>
			</p>

			<p>
				<label
					for="<?php echo $this->get_field_id( 'timeframe' ); ?>"><?php _e( 'Select popular posts from', 'louis' ); ?></label>

				<select class="widefat" id="<?php echo $this->get_field_id( 'timeframe' ); ?>"
						name="<?php echo $this->get_field_name( 'timeframe' ); ?>">
					<option
						value="day" <?php if ( $timeframe === 'day' ): echo 'selected'; endif; ?>><?php _e( 'Today', 'louis' ); ?></option>
					<option
						value="week" <?php if ( $timeframe === 'week' ): echo 'selected'; endif; ?>><?php _e( 'Last Week', 'louis' ); ?></option>
					<option
						value="month" <?php if ( $timeframe === 'month' ): echo 'selected'; endif; ?>><?php _e( 'Last Month', 'louis' ); ?></option>
					<option
						value="year" <?php if ( $timeframe === 'year' ): echo 'selected'; endif; ?>><?php _e( 'Last Year', 'louis' ); ?></option>
					<option
						value="alltime" <?php if ( $timeframe === 'alltime' ): echo 'selected'; endif; ?>><?php _e( 'All Time', 'louis' ); ?></option>
				</select>
			</p>

			<p>
				<label
					for="<?php echo $this->get_field_id( 'limit' ); ?>"><?php _e( 'Items to show:', 'louis' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>"
					   name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number"
					   value="<?php echo esc_attr( $limit ); ?>"/>
			</p>

		</div>
	<?php
	}

}

// init the widget
function louis_register_recent_popular_posts_widget()
{
	register_widget( 'louis_Recent_Popular_Posts_Widget' );
}

add_action( 'widgets_init', 'louis_register_recent_popular_posts_widget' );
