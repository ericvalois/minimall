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

/*
* Create Secondary link metabox
*/
add_filter( 'rwmb_meta_boxes', 'minimall_edd_secondary_link_metabox' );
function minimall_edd_secondary_link_metabox( $meta_boxes ) {
	$prefix = 'minimall-';

	$meta_boxes[] = array(
		'id' => 'secondary-link',
		'title' => esc_html__( 'Secondary Link', 'minimall' ),
		'post_types' => array( 'download' ),
		'context' => 'normal',
		'priority' => 'low',
		'autosave' => false,
		'fields' => array(
			array(
				'id' => $prefix . 'edd_secondary_label',
				'type' => 'text',
				'name' => esc_html__( 'Label', 'minimall' ),
			),
			array(
				'id' => $prefix . 'edd_secondary_url',
				'type' => 'url',
				'name' => esc_html__( 'URL', 'minimall' ),
				'placeholder' => esc_html__( 'http://', 'minimall' ),
            ),
            array(
				'id' => $prefix . 'edd_secondary_class',
				'type' => 'text',
				'name' => esc_html__( 'Class', 'minimall' ),
				'placeholder' => esc_html__( 'class1 class2', 'minimall' ),
			),
			array(
				'id' => $prefix . 'edd_secondary_target',
				'name' => esc_html__( 'External link', 'minimall' ),
				'type' => 'checkbox',
				'desc' => esc_html__( 'Open in a new tab', 'minimall' ),
			),
		),
	);

	return $meta_boxes;
}
