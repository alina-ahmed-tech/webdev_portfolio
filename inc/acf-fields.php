<?php
/**
 * ACF Local Field Group for Projects
 *
 * @package devfolio
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

add_action( 'acf/init', function() {
	if ( function_exists( 'acf_add_local_field_group' ) ) {
		acf_add_local_field_group( [
			'key'    => 'group_devfolio_projects',
			'title'  => 'Project Details',
			'fields' => [
				[
					'key'           => 'field_devfolio_project_type',
					'label'         => 'Project Type',
					'name'          => 'projectType',
					'type'          => 'select',
					'choices'       => [
						'WordPress' => 'WordPress',
						'Software'  => 'Software',
						'AI'        => 'AI',
					],
					'default_value' => 'WordPress',
					'allow_null'    => 0,
					'multiple'      => 0,
					'ui'            => 1,
					'return_format' => 'value',
				],
			],
			'location' => [
				[
					[
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'projects',
					],
				],
			],
		] );
	}
} );
