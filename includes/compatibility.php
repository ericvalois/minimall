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
    require get_template_directory() . '/includes/widgets/widget-edd-description.php';

    /**
     * EDD Widget Comments
     */
    require get_template_directory() . '/includes/widgets/widget-edd-comments.php';

    /**
     * EDD Widget Download Detail
     */
    require get_template_directory() . '/includes/widgets/widget-edd-download-detail.php';

    /**
     * EDD Widget Download Thumbnail
     */
    require get_template_directory() . '/includes/widgets/widget-edd-download-thumb.php';

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
        require get_template_directory() . '/includes/widgets/widget-edd-reviews.php';
    }

    /**
     * If EDD Download Images Active
     */
    if( minimall_is_edd_download_images_active() ){
        /**
         *  Widget 
         */
        require get_template_directory() . '/includes/widgets/widget-edd-download-images.php';

        /**
         * Customization
         */
        require get_template_directory() . '/includes/compatibility/edd/edd-download-images.php';
    }
}

