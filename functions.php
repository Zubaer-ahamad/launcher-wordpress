<?php
function launcher_setup_theme() {
	load_theme_textdomain( 'launcher' );
	add_theme_support( "post-thumbnails" );
	add_theme_support( "title-tag" );
}

add_action( "after_setup_theme", "launcher_setup_theme" );

function launcher_wp_enqueue_scripts() {

	if ( is_page() ) {
		if ( basename( get_page_template() ) === "launcher.php" ) {
			wp_enqueue_style( 'animate-style', get_theme_file_uri( 'assets/css/animate.css' ) );
			wp_enqueue_style( 'bootstrap-style', get_theme_file_uri( 'assets/css/bootstrap.css' ) );
			wp_enqueue_style( 'icomoon-style', get_theme_file_uri( 'assets/css/icomoon.css' ) );
			wp_enqueue_style( 'style-css', get_theme_file_uri( 'assets/css/style.css' ) );
			wp_enqueue_style( "launcher-style", get_stylesheet_uri() );

			wp_enqueue_script( "easing-jquery-js", get_theme_file_uri( 'assets/js/jquery.easing.1.3.js' ), array( 'jquery' ), null, true );
			wp_enqueue_script( "bootstrap-jquery-js", get_theme_file_uri( 'assets/js/bootstrap.min.js' ), array( 'jquery' ), null, true );
			wp_enqueue_script( "waypoints-jquery-js", get_theme_file_uri( 'assets/js/jquery.waypoints.min.js' ), array( 'jquery' ), null, true );
			wp_enqueue_script( "simplyCountdown-jquery-js", get_theme_file_uri( 'assets/js/simplyCountdown.js' ), array( 'jquery' ), null, true );
			wp_enqueue_script( "main-jquery-js", get_theme_file_uri( 'assets/js/main.js' ), array( 'jquery' ), time(), true );

			$launcher_day   = get_post_meta( get_the_ID(), 'date', true );
			$launcher_month = get_post_meta( get_the_ID(), 'month', true );
			$launcher_year  = get_post_meta( get_the_ID(), 'year', true );

			Wp_localize_script( 'main-jquery-js', 'date_data', array(
				"year"  => $launcher_year,
				"month" => $launcher_month,
				"day"   => $launcher_day,
			) );
		} else {
			wp_enqueue_style( 'bootstrap-style', get_theme_file_uri( 'assets/css/bootstrap.css' ) );
			wp_enqueue_script( "bootstrap-jquery-js", get_theme_file_uri( 'assets/js/bootstrap.min.js' ), array( 'jquery' ), null, true );
		}
	}


}

add_action( "wp_enqueue_scripts", "launcher_wp_enqueue_scripts" );

function launcher_widgets_init() {
	register_sidebar( array(
		"name"          => __( "Footer Left", "launcher" ),
		"id"            => "footer-left",
		"description"   => __( "Add widgets Left", "launcher" ),
		"before_widget" => '<aside id="%1$s" class="widget %2$s">" >',
		"after_widget"  => "</aside>",
		"before_title"  => "<h2 class='widget-title'>",
		"after_title"   => "</h2>"
	) );

	register_sidebar( array(
		"name"          => __( "Footer Right", "launcher" ),
		"id"            => "footer-right",
		"description"   => __( "Add widgets Right", "launcher" ),
		"before_widget" => '<aside id="%1$s" class="text-right widget %2$s">" >',
		"after_widget"  => "</aside>",
		"before_title"  => "<h2 class='widget-title'>",
		"after_title"   => "</h2>"
	) );
}

add_action( "widgets_init", "launcher_widgets_init" );

function launcher_styles() {
	if ( is_page() ) {
		$thumbnail_url = get_the_post_thumbnail_url( null, 'large' );
		?>
        <style>
            .home-aside {
                background-image: url(<?php echo $thumbnail_url ?>);
            }
        </style>
		<?php
	}
}

add_action( "wp_head", "launcher_styles" );





















