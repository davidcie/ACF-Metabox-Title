<?php
/*
	Plugin Name: ACF Metabox Title
	Plugin URI: https://github.com/davidcie/ACF-Metabox-Title
	Description: Allows you to specify a separate title for metaboxes.
	Version: 1.0.0
	Author: davidcie
	Author URI: https://github.com/davidcie/
	GitHub Plugin URI: https://github.com/davidcie/ACF-Metabox-Title
	License: GPL
*/

/**
 * Add a new field in admin pages for the field group.
 */
function acf_add_field_group_title( $field_group ) {
	acf_render_field_wrap(array(
		'label' => __('Metabox Title', 'acf'),
		'instructions' => __('If specified will be displayed instead of field group title.', 'acf'),
		'type' => 'text',
		'name' => 'metabox_title',
		'prefix' => 'acf_field_group',
		'value' => (isset($field_group['metabox_title'])) ? $field_group['metabox_title'] : NULL,
	));
}
add_action( 'acf/render_field_group_settings', 'acf_add_field_group_title' );

/**
 * Substitute metabox title for field group title if defined.
 */
function acf_apply_metabox_title($field_groups) {

	// Get the current screen data
	$current_screen = get_current_screen();

	// Loop through available field groups
	foreach ( $field_groups as $k => $field_group ) {
		// If a metabox title is set and not empty, change the original title
		if ( isset($field_group['metabox_title']) && !empty($field_group['metabox_title']) ) {
			$field_groups[$k]['title'] = $field_group['metabox_title'];
		}
	}

	// return the data
	return $field_groups;
}
add_filter('acf/get_field_groups', 'acf_apply_metabox_title');

?>
