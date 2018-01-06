<?php
/*
* Demo Import Location
*/
add_filter( 'theme-demo-import/import_files', 'minimall_import_files' );
function minimall_import_files() {
    return array(
        array(
            'import_file_name'           => 'Minimall Demo Import',
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'includes/compatibility/theme-demo-import/posts.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'includes/compatibility/theme-demo-import/widgets.wie',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'includes/compatibility/theme-demo-import/customizer.dat',
            //'import_preview_image_url'   => 'https://minimall.ttfb.io/demo/screenshot.png',
            //'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
        ),
    );
}

/*
* Set homepage, blog and primary menu
*/
add_action( 'theme-demo-import/after_import', 'minimall_set_menu_and_pages' );
function minimall_set_menu_and_pages() {
    // Assign menus to their locations.
    $main_menu = get_term_by( 'name', 'Primary', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', array(
            'primary' => $main_menu->term_id,
        )
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'Blog' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

}
