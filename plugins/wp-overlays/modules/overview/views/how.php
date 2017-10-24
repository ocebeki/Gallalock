<?php
/**
 * Plugin Overviews.
 * @package Maps
 * @author Flipper Code <flippercode>
 **/

?>

<div class="container wpgmp-docs">
<div class="row flippercode-main">
<div class="col-md-12">

<h4 class="alert alert-info"> <?php _e( 'How to Apply Overlays on Featured Images.',WPGMP_TEXT_DOMAIN ); ?> </h4>
<div class="wpgmp-overview">
You can apply overlays on featured images automatically. 
<ul>
<li><b>Single Post Page </b> - Go to 'Settings' page and tick 'Single Post' option for 'Apply On' field in 'Overlays Settings for Post' section. </li>
<li><b>Posts Listing Page </b> - Go to 'Settings' page and tick 'Posts Listing' option for 'Apply On' field in 'Overlays Settings for Post' section.</li>
</ul>
</div> 

<h4 class="alert alert-info">
<?php _e( 'How to Change Overlays Content', WPP_TEXT_DOMAIN ) ?>
</h4>
<div class="wpgmp-overview">
You can modify overlays content using 'Overay Content' input field.  Use following placeholder to display posts information or your own html content in the overlays.
<ul>
<li><b><?php _e( 'Post Title',WPP_TEXT_DOMAIN ); ?> :</b><code>{title}</code></li>
<li><b><?php _e( 'Post Links',WPP_TEXT_DOMAIN ); ?> :</b><code>{post_link}</code></li>
<li><b><?php _e( 'Post Excerpt',WPP_TEXT_DOMAIN ); ?> :</b><code>{post_excerpt}</code></li>
<li><b><?php _e( 'Read More',WPP_TEXT_DOMAIN ); ?> :</b><code>{read_more}</code></li>

</ul>
</div>

<h4 class="alert alert-info"> <?php _e( 'How to Apply Overlays on Custom Images.',WPGMP_TEXT_DOMAIN ); ?> </h4>
<div class="wpgmp-overview">

You can apply overlays on custom images using shortcode [overlays]. Below is example shortcode. 

<pre>
    [overlays src="{image_path}"  in="fadeIn" out="fadeOutDown" width="31" height="55" color="#8fc91c" opacity="0.37" text_position="overlay_center" animation_speed="8" ]You can place your content here...[/overlays]
</pre>

Below are parameters you can pass into shortcode to customize it. 

<table class="table table-striped">
<thead>
<tr>
<th><?php _e( 'Shortcode Parameter' ); ?></th><th><?php _e( 'Description' ); ?></th><th><?php _e( 'Possible Values' ); ?></th>
</tr>
</thead>
<tbody>
<tr>
<td width="30%">src</td><td width="30%"><?php _e( 'Url of source image we want to see as overlay background image' ); ?></td>
<td><?php _e( 'Eg. A valid image path.' ); ?></td>
</tr>
<tr>
<td><?php _e( 'in' ); ?></td><td><?php _e( 'Animation class name which must be applied as Starting / In effect' ); ?></td>
<td><p><?php _e('bounce,flash,pulse,rubberBand,shake,swing,tada,wobble,
bounceIn,bounceInDown,bounceInLeft,bounceInRight,bounceInUp,
fadeIn,fadeInDown,fadeInDownBig,fadeInLeft,fadeInLeftBig,fadeInRight,fadeInRightBig,fadeInUp,fadeInUpBig,
flip,flipInX,flipInY,
lightSpeedIn,
rotateIn,rotateInDownLeft,rotateInDownRight,rotateInUpLeft,rotateInUpRight,
rollIn,
zoomIn,zoomInDown,zoomInLeft,zoomInRight,zoomInUp'); ?></p>
</td>
</tr>
<tr>
<td><?php _e( 'out' ); ?></td><td><?php _e( 'Animation class name which must be applied as Finishing / Out effect' ); ?></td>
<td><p><?php _e('bounceout,bounceOutDown,bounceOutLeft,bounceOutRight,bounceOutUp,
fadeOut,fadeOutDown,fadeOutDownBig,fadeOutLeft,fadeOutLeftBig,fadeOutRight,fadeOutRightBig,fadeOutUp,fadeOutUpBig,
flipOutX,flipOutY,
lightSpeedOut,
rotateOut,rotateOutDownLeft,rotateOutDownRight,rotateOutUpLeft,rotateOutUpRight,
rollOut,
zoomOut,zoomOutDown,zoomOutLeft,zoomOutRight,zoomOutUp'); ?></p>    
</td>
</tr>
<tr>
<td><?php _e( 'text_position' ); ?></td><td><?php _e( 'Class name for position of content in overlay' ); ?></td>
<td><?php _e( 'overlay_center , overlay_top_left , overlay_top_right , overlay_bottom_left , overlay_bottom_right' ); ?></td>
</tr>
<tr>
<td><?php _e( 'color' ); ?></td><td><?php _e( 'Color for Overlay in Hexformat' ); ?></td>
<td><?php _e( 'Any Hexaformat Color value Eg. #ffffff' ); ?></td>
</tr>
<tr>
<td><?php _e( 'width' ); ?></td><td><?php _e( 'Width of overlay' ); ?></td>
<td><?php _e( 'For Width in percentage - 1 to 100 (Without unit) <br> For Width in px - Eg. 250px ( With px unit )' ); ?></td>
</tr>
<tr>
<td><?php _e( 'height' ); ?></td><td><?php _e( 'Height of overlay' ); ?></td>
<td><?php _e( 'For Height in percentage - 1 to 100 (Without unit) ' ); ?><br> <?php _e( 'For Height in px - Eg. 250px ( With px unit )' ); ?></td>
</tr>
<tr>
<td><?php _e( 'speed' ); ?></td><td><?php _e( 'Animation Speed' ); ?></td>
<td><?php _e( 'Speed in seconds from .10 to 5.0' ); ?></td>
</tr>
<tr>
<td><?php _e( 'opacity' ); ?></td><td><?php _e( 'Opacity value for Overlay' ); ?></td>
<td><?php _e( 'Opacity value in decimal value from .1 (minimum) to 1 (maximum)' );?></td>
</tr>
<tr>
<td><?php _e( 'class_on_image' ); ?></td><td><?php _e( 'Extra css class on image' ); ?></td>
<td><?php _e( 'Any class name we want to apply on image tag' ); ?></td>
</tr>
<tr>
<td><?php _e( 'post_id' ); ?></td><td><?php _e( 'It will show the featured image for particular post' ); ?></td>
<td><?php _e( 'Any post id value' ); ?></td>
</tr>
<tr>
<td><?php _e( 'attachment_id' ); ?></td><td><?php _e( 'It will show the image for attachment' ); ?></td>
<td><?php _e( 'Any Attachment id value' ); ?></td>
</tr>
</tbody>
</table>

</div> 

<h4 class="alert alert-info"> <?php _e( 'Pro Version',WPGMP_TEXT_DOMAIN ); ?> </h4>
<div class="wpgmp-overview">
<blockquote><?php _e( 'Pro Edition Features',WPGMP_TEXT_DOMAIN ); ?> <a target="_blank" href="http://codecanyon.net/item/overlays-over-images-wordpress-plugin/8520201">Download Pro Version.</a></blockquote>
<ol>
<li>Supported custom posts type. it works with posts type created using plugins or your own programming.</li>
<li>Display custom fields in overlays over images.</li>
<li>Display taxonomies of the custom post types. Unlimited taxonomies supported.</li>
<li>Display product data e.g add to cart in the overlays if woo-commerce is installed.</li>
<li>Fully responsive overlays.</li>
<li>Multi-site Supported.</li>
<li>Multi-lingual using .po file.</li>
</ol>
</div>
</div>
</div>
