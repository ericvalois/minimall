<?php
if( minimall_is_edd_active() ){
    /**
     * EDD customization
     */
    require get_template_directory() . '/includes/compatibility/edd/global-edd.php';

    /**
     * EDD Widget Description
     */
    require get_template_directory() . '/includes/widgets/widget-edd-description.php';

    /**
     * EDD Widget Comments
     */
    require get_template_directory() . '/includes/widgets/widget-edd-comments.php';
}

if ( minimall_is_edd_reviews_active() ) {
    /**
     * EDD Reviews customization
     */
    require get_template_directory() . '/includes/compatibility/edd/class-reviews.php';

    /**
     * EDD Widget Reviews
     */
    require get_template_directory() . '/includes/widgets/widget-edd-reviews.php';
}