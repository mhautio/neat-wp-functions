//Lyhytkoodi jonkin tietyn artikkelin sisällön näyttämiseen multisiten toisen blogin sivulla
if ( ! function_exists( 'valakia_get_specified_content' ) ) {
	function valakia_get_specified_content( $atts ) {
		$atts = shortcode_atts(
			array(
				'blog' => '',
				'post' => '',
			),
			$atts,
			'show-content'
		);

		$valakia_blog_id = absint( $atts['blog'] );
		$valakia_post_id = absint( $atts['post'] );

		if ( ! empty( $valakia_blog_id ) && ! empty( $valakia_post_id ) ) {
			switch_to_blog( $valakia_blog_id );
			$valakia_post   = get_post( $valakia_post_id );
			$valakia_output = apply_filters( 'the_content', $valakia_post->post_content );
			restore_current_blog();
			return $valakia_output;
		}
	}

	if ( ! shortcode_exists( 'show-content' ) ) {
		add_shortcode( 'show-content', 'valakia_get_specified_content' );
	}
}
