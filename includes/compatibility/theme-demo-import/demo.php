<?php
/*
* Demo Import Location
*/
add_filter( 'theme-demo-import/import_files', 'minimall_import_files' );
function minimall_import_files() {
    return array(
        array(
            'import_file_name'           => 'Minimall Demo Import',
            'import_file_url'            => 'https://minimall.ttfb.io/demo/posts.xml',
            'import_widget_file_url'     => 'https://minimall.ttfb.io/demo/widgets.wie',
            'import_customizer_file_url' => 'https://minimall.ttfb.io/demo/customizer.dat',
            'import_preview_image_url'   => 'https://minimall.ttfb.io/demo/screenshot.png',
            //'import_notice'              => __( 'After you import this demo, you will have to setup the slider separately.', 'your-textdomain' ),
        ),
    );
}