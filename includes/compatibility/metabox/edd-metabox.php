<?php
add_filter( 'rwmb_meta_boxes', 'minimall_edd_image_gallery' );
function minimall_edd_image_gallery( $meta_boxes ) {
	$prefix = 'minimall-';

	$meta_boxes[] = array(
		'id' => 'edd-gallery',
		'title' => esc_html__( 'EDD Gallery', 'minimall' ),
		'post_types' => array( 'download' ),
		'context' => 'side',
		'priority' => 'default',
		'autosave' => false,
		'fields' => array(
			array(
				'id' => $prefix . 'edd_gallery',
				'type' => 'image_advanced',
				'name' => esc_html__( 'Gallery', 'minimall' ),
			),
		),
	);

	return $meta_boxes;
}

add_filter( 'rwmb_meta_boxes', 'minimall_edd_feature_list' );
function minimall_edd_feature_list( $meta_boxes ) {
	$prefix = 'minimall-';

	$meta_boxes[] = array(
		'id' => 'edd-download-features',
		'title' => esc_html__( 'Features', 'minimall' ),
		'post_types' => array( 'download' ),
		'context' => 'normal',
		'priority' => 'default',
        'autosave' => false,
        
		'fields' => array(
			array(
				'id' => $prefix . 'edd_features_col',
				'type' => 'range',
				'name' => esc_html__( 'Item per row', 'minimall' ),
				'min'  => 1,
                'max'  => 4,
                'step' => 1,
			),
			array(
				'id' => $prefix . 'edd_features_items',
				'type' => 'fieldset_text',
				'name' => esc_html__( 'Features', 'minimall' ),
				'options' => array(
					'icon'      => 'Icon',
                    'label' => 'Label',
                    'desc' => 'Description',
				),
				'clone' => true,
				'sort_clone' => true,
				'add_button' => esc_html__( 'Add a feature', 'minimall' ),
				'max_clone' => 30,
			),
		),
	);

	return $meta_boxes;
}