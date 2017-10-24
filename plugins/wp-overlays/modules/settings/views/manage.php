<?php
/**
 * This class used to manage settings page in backend.
 * @author Flipper Code <hello@flippercode.com>
 * @package 2.0.0
 * @package Posts
 */

$data = get_option( 'blogpost_settings' );

$color = $data['overlay_color'];
$opacity = ($data["opacity_value"]/100);
if ( ! empty( $color ) ) {
			list($r, $g, $b) = sscanf( $color, '#%02x%02x%02x' );
			$bg = 'rgba('.$r.','.$g.','.$b.','.$opacity.')';
}
 $content = "<p>You can place any content or html here.</p>";
 $text_position = $data['slide_text_position'];
 $animation_speed = (10-$data['animation_speed']);
 $shortcode = '[overlays src="'.WOP_IMAGES.'preview.jpg"  in="'.$data['slide_effect'].'" out="'.$data['slide_effect_exit'].'" width="'.$data['overlay_width'].'" height="'.$data['overlay_height'].'" color="'.$color.'" opacity="'.$opacity.'" text_position="'.$data['slide_text_position'].'" animation_speed="'.$animation_speed.'" ]You can place your content here...[/overlays]';
$overlay_preview = do_shortcode($shortcode);
$overlay_preview .= '<br><p>Use following shortcode to apply overlays on custom image.</p>';
$overlay_preview .= '<pre>'.$shortcode.'</pre>';

$form  = new FlipperCode_HTML_Markup();
$form->set_header( __( 'Overlay Builder', WOP_TEXT_DOMAIN ), $response );
$form->spliter = "<div class='col-md-6'>%form</div><div class='col-md-6'>".$overlay_preview.'</div>';
$form->set_col( 2 );
$effect_array = array(
__( 'Attention Seekers','op_lang' ) => array( bounce, flash, pulse, rubberBand, shake, swing, tada, wobble ),
__( 'Bouncing','op_lang' ) => array( bounceIn, bounceInDown, bounceInLeft, bounceInRight, bounceInUp ),
__( 'Fading','op_lang' ) => array( fadeIn, fadeInDown, fadeInDownBig, fadeInLeft, fadeInLeftBig, fadeInRight, fadeInRightBig, fadeInUp, fadeInUpBig ),
__( 'Flippers','op_lang' ) => array( flip, flipInX, flipInY ),
__( 'Lightspeed','op_lang' ) => array( lightSpeedIn ),
__( 'Rotating','op_lang' ) => array( rotateIn, rotateInDownLeft, rotateInDownRight, rotateInUpLeft, rotateInUpRight ),
__( 'Specials','op_lang' ) => array( rollIn ),
__( 'Zoom','op_lang' ) => array( zoomIn, zoomInDown, zoomInLeft, zoomInRight, zoomInUp ),
);

foreach ( $effect_array as $opt_label => $values ) {
	foreach ( $values as  $key => $value ) {
		$new_effect_array[ $opt_label ][ $value ] = $value;
	}
}
$effect_array = $new_effect_array;
$form->add_element( 'select', 'slide_effect', array(
	'lable' => __( 'Choose Effect',WOP_TEXT_DOMAIN ),
	'current' => (isset( $data['slide_effect'] ) and ! empty( $data['slide_effect'] )) ? $data['slide_effect'] : '',
	'desc' => __( 'Overlay IN Effect', WOP_TEXT_DOMAIN ),
	'options' => $effect_array,
	'optgroup' => 'true',
	'before' => '<div class="col-md-4">',
	'after' => '</div>',
));

$effect_array_exit = array(
__( 'Bouncing','op_lang' ) => array( bounceout, bounceOutDown, bounceOutLeft, bounceOutRight, bounceOutUp ),
__( 'Fading','op_lang' ) => array( fadeOut, fadeOutDown, fadeOutDownBig, fadeOutLeft, fadeOutLeftBig, fadeOutRight, fadeOutRightBig, fadeOutUp, fadeOutUpBig ),
__( 'Flippers','op_lang' ) => array( flipOutX, flipOutY ),
__( 'Lightspeed','op_lang' ) => array( lightSpeedOut ),
__( 'Rotating','op_lang' ) => array( rotateOut, rotateOutDownLeft, rotateOutDownRight, rotateOutUpLeft, rotateOutUpRight ),
__( 'Specials','op_lang' ) => array( rollOut ),
__( 'Zoom','op_lang' ) => array( zoomOut, zoomOutDown, zoomOutLeft, zoomOutRight, zoomOutUp ),
);

foreach ( $effect_array_exit as $opt_label => $values ) {
	foreach ( $values as  $key => $value ) {
		$new_effect_array_exit[ $opt_label ][ $value ] = $value;
	}
}
$effect_array_exit = $new_effect_array_exit;

$form->add_element( 'select', 'slide_effect_exit', array(
	'current' => (isset( $data['slide_effect_exit'] ) and ! empty( $data['slide_effect_exit'] )) ? $data['slide_effect_exit'] : '',
	'desc' => __( 'Overlay Exit Effect', WOP_TEXT_DOMAIN ),
	'options' => $effect_array_exit,
	'optgroup' => 'true',
	'before' => '<div class="col-md-3">',
	'after' => '</div>',
));

$form->add_element( 'text', 'overlay_color', array(
	'lable' => __( 'Overlay Color', WOP_TEXT_DOMAIN ),
	'value' => $data['overlay_color'],
	'desc' => __( 'Default is red.', WOP_TEXT_DOMAIN ),
	'class' => 'color  form-control',
	'before' => '<div class="col-md-4">',
	'after' => '</div>',
));


$text_position = array(
'overlay_top_left' => __( 'Top Left',WOP_TEXT_DOMAIN ),
'overlay_top_right' => __( 'Top Right',WOP_TEXT_DOMAIN ),
'overlay_bottom_left' => __( 'Bottom Left',WOP_TEXT_DOMAIN ),
'overlay_bottom_right' => __( 'Bottom Right',WOP_TEXT_DOMAIN ),
'overlay_center' => __( 'Center',WOP_TEXT_DOMAIN ),
);
$form->add_element( 'select', 'slide_text_position', array(
	'current' => (isset( $data['slide_text_position'] ) and ! empty( $data['slide_text_position'] )) ? $data['slide_text_position'] : '',
	'desc' => __( 'Text position in the overlays.', WOP_TEXT_DOMAIN ),
	'options' => $text_position,
	'before' => '<div class="col-md-3">',
	'after' => '</div>',
	'default_value' => 'overlay_top_left',
));

$form->set_col( 1 );


$form->add_element( 'radio_slider', 'animation_speed', array(
	'lable' => __( 'Animation Speed', WOP_TEXT_DOMAIN ),
	'value' => $data['animation_speed'],
	'class' => 'chkbox_class',
	'id' => 'animation_speed',
	'min' => '1',
	'max' => '10',
	'default_value' => '1',
	'before' => '<div class="col-md-8">',
	'after' => '</div>',
));

$form->add_element( 'radio_slider', 'overlay_width', array(
	'lable' => __( 'Overlay Width', WOP_TEXT_DOMAIN ),
	'value' => $data['overlay_width'],
	'class' => 'chkbox_class ',
	'id' => 'overlay_width',
	'min' => '1',
	'max' => '100',
	'default_value' => '100',
	'before' => '<div class="col-md-8">',
	'after' => '</div>',
));

$form->add_element( 'radio_slider', 'overlay_height', array(
	'lable' => __( 'Overlay Height', WOP_TEXT_DOMAIN ),
	'value' => $data['overlay_height'],
	'class' => 'chkbox_class ',
	'id' => 'overlay_height',
	'min' => '1',
	'max' => '100',
	'default_value' => '100',
	'before' => '<div class="col-md-8">',
	'after' => '</div>',
));

$form->add_element( 'radio_slider', 'opacity_value', array(
	'lable' => __( 'Opacity', WOP_TEXT_DOMAIN ),
	'value' => $data['opacity_value'],
	'class' => 'chkbox_class ',
	'id' => 'opacity_value',
	'min' => '1',
	'max' => '100',
	'default_value' => '50',
	'before' => '<div class="col-md-8">',
	'after' => '</div>',
));


$all_post_types = array( 'post', 'page' );

foreach ( $all_post_types as $key => $post_type ) {
	$form->add_element( 'group', sanitize_title( $post_type ).'_geotags_settings', array(
		'value' => __( 'Overlays Settings for ',WOP_TEXT_DOMAIN )."<i>'".ucfirst( $post_type )."'</i>".__( ' Post Type',WOP_TEXT_DOMAIN ),
		'before' => '<div class="col-md-11">',
		'after' => '</div>',
	));
	$form->add_element( 'textarea', 'overlay_content['.$post_type.']', array(
		'lable' => __( 'Overlay Content', WOP_TEXT_DOMAIN ),
		'value' => @$data['overlay_content'][$post_type],
		'desc' => __( 'Display a text/html content in the overlays. Use {post_title}, {post_link}, {post_excerpt} and {read_more}',WOP_TEXT_DOMAIN ),
		'textarea_rows' => 10,
		'textarea_name' => 'overlay_content',
		'class' => 'form-control',
	));

	$apply_on = array(
	'post_listing' => __( 'Post Listing',WOP_TEXT_DOMAIN ),
	'single_post' => __( 'Single Post',WOP_TEXT_DOMAIN ),
	);

	$form->add_element( 'multiple_checkbox', 'apply_on['.$post_type.'][]', array(
		'lable' => __( 'Apply On', WOP_TEXT_DOMAIN ),
		'value' => $apply_on,
		'current' => $data['apply_on'][$post_type],
		'class' => 'chkbox_class ',
		'desc' => __( 'Please check to apply overlays on featured image in posts listing.', WOP_TEXT_DOMAIN ),
		'default_value' => '',
	));

}


$form->add_element('submit','wop_save_settings',array(
	'value' => __( 'Save Setting',WOP_TEXT_DOMAIN ),
));
$form->add_element('hidden','operation',array(
	'value' => 'save',
));
$form->add_element('hidden','page_options',array(
	'value' => 'wop_api_key,wop_scripts_place',
));
$form->render();
