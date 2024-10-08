<?php
// Get selected value
if (isset($field['value'])) {
	$selected = $field['value'];
} elseif (!empty($field['default']) && is_int($field['default'])) {
	$selected = $field['default'];
} elseif (!empty($field['default']) && ($term = get_term_by('slug', $field['default'], $field['taxonomy']))) {
	$selected = $term->term_id;
} else {
	$selected = '';
}

wp_enqueue_script('wp-event-manager-term-multiselect');
$args = array(
	'taxonomy'     => $field['taxonomy'],
	'hierarchical' => 1,
	'name'         => isset($field['name']) ? $field['name'] : $key,
	'orderby'      => 'name',
	'selected'     => $selected,
	'hide_empty'   => false
);

if (isset($field['placeholder']) && !empty($field['placeholder'])) 
	$args['placeholder'] = $field['placeholder'];

if(isset( $field['taxonomy'] ) &&  $field['taxonomy'] === 'event_listing_type'):
	$args['placeholder'] = isset($field['placeholder']) ? $field['placeholder'] : __('Choose an event type', 'wp-event-manager');
	$args['multiple_text'] = isset($field['multiple_text']) ? $field['multiple_text'] : __('Choose event types', 'wp-event-manager');
endif;

event_manager_dropdown_selection(apply_filters('event_manager_term_multiselect_field_args', $args));

if (!empty($field['description'])) : ?>
	<small class="description">
		<?php echo wp_kses_post($field['description']); ?>
	</small>
<?php endif; ?>