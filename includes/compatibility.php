<?php
/**
 * If EDD Active
 */
if( minimall_is_edd_active() ){
    /**
     * EDD customization
     */
    require get_template_directory() . '/includes/compatibility/edd/global-edd.php';

    /**
     * EDD Widget Description
     */
    require get_template_directory() . '/includes/compatibility/edd/widget-edd-description.php';

    /**
     * EDD Widget Comments
     */
    require get_template_directory() . '/includes/compatibility/edd/widget-edd-comments.php';

    /**
     * EDD Widget Download Detail
     */
    require get_template_directory() . '/includes/compatibility/edd/widget-edd-download-detail.php';

    /**
     * EDD Widget Download Thumbnail
     */
    require get_template_directory() . '/includes/compatibility/edd/widget-edd-download-thumb.php';

    /**
     * EDD Widget Cart
     */
    require get_template_directory() . '/includes/compatibility/edd/widget-edd-cart.php';

    /**
     * If EDD Reviews Active
     */
    if ( minimall_is_edd_reviews_active() ) {
        /**
         * EDD Reviews customization
         */
        require get_template_directory() . '/includes/compatibility/edd/class-reviews.php';

        /**
         * EDD Widget Reviews
         */
        require get_template_directory() . '/includes/compatibility/edd/widget-edd-reviews.php';
    }

    /**
     * If EDD Metabox Active
     */
    if( minimall_is_metabox_active() ){
        /**
         * EDD Metabox init
         */
        require get_template_directory() . '/includes/compatibility/metabox/edd-metabox.php';

        /**
         * EDD features shortcode
         */
        require get_template_directory() . '/includes/compatibility/metabox/features-shortcode.php';

        /**
         * EDD Metabox gallery widget
         */
        require get_template_directory() . '/includes/compatibility/metabox/widget-edd-metabox-gallery.php';
    }
}

/**
 * If Autoptimize Active
 */
if( minimall_is_autoptimize_active() ){
    /**
     * Critical CSS Optimization
     */
    require get_template_directory() . '/includes/compatibility/autoptimize/critical-css.php';
}

/**
 * If Contact Form 7 Active
 */
if( minimall_is_cf7_active() ){
    /**
     * Contact Form 7 Optimization
     */
    require get_template_directory() . '/includes/compatibility/cf7/cf7.php';
}

/**
 * If Jetpack Active
 */
if( minimall_is_jetpack_active() ){
    /**
     * Jetpack Optimization
     */
    require get_template_directory() . '/includes/compatibility/jetpack/jetpack.php';
}

/**
 * If Gutenberg Active
 */
if( minimall_is_gutenberg_active() ){
    /**
     * Gutenberg Optimization
     */
    require get_template_directory() . '/includes/compatibility/gutenberg/gutenberg.php';
}

/**
 * If Kirki Active
 */
if( minimall_is_kirki_active() ){
    /**
     * Kirki Optimization
     */
    require get_template_directory() . '/includes/compatibility/kirki/kirki.php';
}

/**
 * If TTFB Toolkit Active
 */
if( minimall_is_ttfb_toolkit() ){
    /**
     * Minimall Specific Optimization
     */
    require get_template_directory() . '/includes/compatibility/ttfb-toolkit/minimall-preload.php';
}

/**
 * If Theme Demo Import Active
 */
if( minimall_is_theme_demo_import_active() ){
    /**
     * Minimall demo import
     */
    require get_template_directory() . '/includes/compatibility/theme-demo-import/demo.php';
}