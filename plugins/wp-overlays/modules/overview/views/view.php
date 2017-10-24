<?php
/**
 * WP Overlays Overviews.
 * @package Posts
 * @author Flipper Code <flippercode>
 **/

  $premiumFeatures = array('Shows beautiful overlay effects over default wordpress posts and custom post type posts both.',
						  'Display custom fields in overlays over images.',
						  'Display taxonomies of the custom post types. Unlimited taxonomies supported.',
						  'Display product data e.g "Add To Cart" in the overlays if woo-commerce is installed.',
						  'Show animated text on page load',
						  'Better controls for controlling every aspect of overlay like width and height slider. Allows you to have complete control over the look and feel of overlay.',
						  'Display animated text over image ');
						  
  $productInfo = array('productName' => __('WP Overlays',WOP_TEXT_DOMAIN),
                        'productSlug' => 'wp-overlays',
                        'productTagLine' => 'A complete solution for showing beautiful overlays effects over featured image of default posts,pages and custom post types. Also allows you to add overlay effect on any custom image.',
                        'productTextDomain' => WOP_TEXT_DOMAIN,
                        'productIconImage' => WOP_URL.'core/core-assets/images/wp-poet.png',
                        'productVersion' => WOP_VERSION,
                        'productImagePath' => WOP_URL.'core/core-assets/product-images/',
                        'productImageName' => '6.png',
                        'premiumFeatures' => $premiumFeatures,
                        'productSaleURL' => 'http://www.flippercode.com/product/wp-overlays-pro/',
                        'docURL' => 'http://www.flippercode.com/documentations/wp-overlays-pro-user-guide/',
                        'demoURL' => 'http://www.flippercode.com/product/wp-overlays-pro/',
                        'is_premium' => 'false',
                        'have_premium' => 'true',
                        'productBanner' => 'http://img.flippercode.com/new/animated-hover-images-wordpress.jpg'
    );

    $productOverviewObj = new Flippercode_Product_Overview($productInfo);
