<?php

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {
	global $advertica_shortname;
	global $advertica_themename;
	// This gets the theme name from the stylesheet

	$advertica_themename = get_option( 'stylesheet' );
	$advertica_themename = preg_replace("/\W/", "_", strtolower($advertica_themename) );
	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $advertica_themename;
	update_option( 'optionsframework', $optionsframework_settings );

}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 * If you are making your theme translatable, you should replace 'advertica-lite'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
*/

function optionsframework_options() {

	global $advertica_shortname;
	global $advertica_themename;
	
	// Background Defaults
	$background_style = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	//breadcumhide_array
	$breadcumhide_array = array(
		'true' => __('Enable', 'advertica-lite'),
		'false' => __('Disable', 'advertica-lite')
	);

	$bread_type = array(
		'brimage' => __('Image', 'advertica-lite'),
		'brcolor' => __('Color', 'advertica-lite')
	);

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array

	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// set pages
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	// If using image radio buttons, define a directory path
	$imagepath   =  get_template_directory_uri() . '/images/';
	$twitterInfo = 'http://www.sketchthemes.com/tutorials/getting-new-twitter-api-consumer-and-secret-keys/';

	$options = array();
	
	//General Settings
	$options[] = array(
		'name' => __('General Settings', 'advertica-lite'),
		'type' => 'heading');

	$options[] = array(
			'name' => __('Choose Theme Color', 'advertica-lite'),
			'desc' => __('', 'advertica-lite'),
			'id' => $advertica_shortname.'_colorpicker',
			'std' => '#FFA500',
			'type' => 'color' );

	$options[] = array(
			'name' => __('Change Logo (full path to logo image size: width * height (156px * 40px) )', 'advertica-lite'),
			'desc' => __('This creates a custom logo for your website.', 'advertica-lite'),
			'id' => $advertica_shortname.'_logo_img',
			'std' => '',
			'type' => 'upload');

	$options[] = array(
			'name' => __('Logo ALT Text', 'advertica-lite'),
			'desc' => __('Enter logo image alt attribute text.', 'advertica-lite'),
			'id' => $advertica_shortname.'_logo_alt',
			'std' => 'sketch themes',
			'type' => 'text');

	$options[] = array(
			'name' => __('Upload Favicon', 'advertica-lite'),
			'desc' => __('This creates a custom favicon for your website.', 'advertica-lite'),
			'id' => $advertica_shortname.'_favicon',
			'std' => '',
			'type' => 'upload');

		//Bg style
		$options[] = array(
				'name' => __('Custom Background', 'advertica-lite'),
				'desc' => __('Change the page background.', 'advertica-lite'),
				'id'   => $advertica_shortname.'_bg_style',
				'std'  => $background_style,
				'type' => 'background' );

			//Breadcrumb	
	$options[] = array(
		'name' => __('Breadcrumb Settings', 'advertica-lite'),
		'type' => 'heading');

	$options[] = array(
			'name' => __('Breadcrumb Enable/Disable', 'advertica-lite'),
			'desc' => __('', 'advertica-lite'),
			'id' => $advertica_shortname.'_hide_bread',
			'std' => 'true',
			'type' => 'radio',
			'options' => $breadcumhide_array);

	$options[] = array(
			'name' => __('Page Title & Breadcrumb Background Type', 'advertica-lite'),
			'desc' => __('', 'advertica-lite'),
			'id' => $advertica_shortname.'_bread_stype',
			'std' => 'brcolor',
			'type' => 'radio',
			'options' => $bread_type);

    $options[] = array(
			'name' => __('Choose Page Title & Breadcrumb Background Color', 'advertica-lite'),
			'desc' => __('Please choose background color', 'advertica-lite'),
			'id' => $advertica_shortname.'_bread_color',
			'std' => '#F9F1E3',
			'type' => 'color',
			'class'=>'hidden' );

    $options[] = array(
			'name' => __('Upload Page Title & Breadcrumb Background Image ( width * height (1600px * 180px) )', 'advertica-lite'),
			'desc' => __('This image will show up as background on page title & breadcrumb section.', 'advertica-lite'),
			'id' => $advertica_shortname.'_bread_image',
			'std' => $imagepath.'page-title-bg.jpg',
			'type' => 'upload',
			'class'=>'hidden');

	$options[] = array(
			'name' => __('Choose Page Title & Breadcrumb Font Color', 'advertica-lite'),
			'desc' => __('Please choose font color', 'advertica-lite'),
			'id' => $advertica_shortname.'_bread_title_color',
			'std' => '#222222',
			'type' => 'color' );		
	//Blog	
	$options[] = array(
		'name' => __('Blog Page Settings', 'advertica-lite'),
		'type' => 'heading');

	//Blog page Title
	$options[] = array(
			'name' => __('Enter Blog Page Title', 'advertica-lite'),
			'desc' => __('Enter blog page title text.', 'advertica-lite'),
			'id' => $advertica_shortname.'_blogpage_heading',
			'std' => 'Blog',
			'type' => 'text');		

	

//Home Page Featured Box Options	
	$options[] = array(
		'name' => __('Home Featured Section', 'advertica-lite'),
		'type' => 'heading');
		
	$options[] = array(
		'name' => __('Home page Image:', 'advertica-lite'),
		'desc' => __('Choose image for home page. Size: Width 1600px and Height 500px.', 'advertica-lite'),
		'id' => $advertica_shortname.'_frontslider_stype',
		'std' => $imagepath.'advertica-header.png',
		'type' => 'upload');

	//Featured Box 1
		$options[] = array(
			'name' => __('First Featured Box Heading', 'advertica-lite'),
			'desc' => __('Enter heading for first featured box.', 'advertica-lite'),
			'id' => $advertica_shortname.'_fb1_first_part_heading',
			'std' => 'Business Strategy',
			'type' => 'text');
			
		$options[] = array(
			'name' => __('First Featured Box Image Path (size: width * height (150px * 150px) )', 'advertica-lite'),
			'desc' => __('Upload image for first featured box.', 'advertica-lite'),
			'id' => $advertica_shortname.'_fb1_first_part_image',
			'std' => '',
			'type' => 'upload');

		 $options[] = array(
				'name' => __('First Featured Box Content', 'advertica-lite'),
				'desc' => __('Enter content for first featured box.','advertica-lite'),
				'id' => $advertica_shortname.'_fb1_first_part_content',
				'std' => ' Get focused from your target consumers and increase your business with Web portal Design and Development. ',
				'type' => 'textarea');

		$options[] = array(
				'name' => __('First Featured Box Link', 'advertica-lite'),
				'desc' => __('Enter link for first featured box.', 'advertica-lite'),
				'id' => $advertica_shortname.'_fb1_first_part_link',
				'std' => '#',
				'type' => 'text');

		//Featured Box 2
		$options[] = array(
			'name' => __('Second Featured Box Heading', 'advertica-lite'),
			'desc' => __('Enter heading for second featured box.', 'advertica-lite'),
			'id' => $advertica_shortname.'_fb2_second_part_heading',
			'std' => 'Quality Products',
			'type' => 'text');
		
		$options[] = array(
			'name' => __('Second Featured Box Image Path (size: width * height (150px * 150px) )', 'advertica-lite'),
			'desc' => __('Upload image for second featured box.', 'advertica-lite'),
			'id' => $advertica_shortname.'_fb2_second_part_image',
			'std' => '',
			'type' => 'upload');

	    $options[] = array(
			'name' => __('Second Featured Box Content', 'advertica-lite'),
			'desc' => __('Enter content for second featured box.','advertica-lite'),
			'id' => $advertica_shortname.'_fb2_second_part_content',
			'std' => ' Products with the ultimate features and functionality that provide the complete satisfaction to the clients.',
			'type' => 'textarea');

	    $options[] = array(
			'name' => __('Second Featured Box Link', 'advertica-lite'),
			'desc' => __('Enter link for second featured box.', 'advertica-lite'),
			'id' => $advertica_shortname.'_fb2_second_part_link',
			'std' => '#',
			'type' => 'text');

	//Featured Box 3
		$options[] = array(
			'name' => __('Third Featured Box Heading', 'advertica-lite'),
			'desc' => __('Enter heading for third featured box.', 'advertica-lite'),
			'id' => $advertica_shortname.'_fb3_third_part_heading',
			'std' => 'Best Business Plans',
			'type' => 'text');
			
		$options[] = array(
			'name' => __('Third Featured Box Image Path (size: width * height (150px * 150px) )', 'advertica-lite'),
			'desc' => __('Upload image for third featured box.', 'advertica-lite'),
			'id' => $advertica_shortname.'_fb3_third_part_image',
			'std' => '',
			'type' => 'upload');

	 	$options[] = array(
			'name' => __('Third Featured Box Content', 'advertica-lite'),
			'desc' => __('Enter content for third featured box.','advertica-lite'),
			'id' => $advertica_shortname.'_fb3_third_part_content',
			'std' => ' Based on the client requirement, different business plans suits and fulfill your business and cost requirement.',
			'type' => 'textarea');

		$options[] = array(
			'name' => __('Third Featured Box Link', 'advertica-lite'),
			'desc' => __('Enter link for third featured box.', 'advertica-lite'),
			'id' => $advertica_shortname.'_fb3_third_part_link',
			'std' => '#',
			'type' => 'text');
//Featured Box 4
		$options[] = array(
			'name' => __('Fourth Featured Box Heading', 'advertica-lite'),
			'desc' => __('Enter heading for fourth featured box.', 'advertica-lite'),
			'id' => $advertica_shortname.'_fb4_second_part_heading',
			'std' => 'Quality Products',
			'type' => 'text');
		
		$options[] = array(
			'name' => __('Fourth Featured Box Image Path (size: width * height (150px * 150px) )', 'advertica-lite'),
			'desc' => __('Upload image for fourth featured box.', 'advertica-lite'),
			'id' => $advertica_shortname.'_fb4_second_part_image',
			'std' => '',
			'type' => 'upload');

	    $options[] = array(
			'name' => __('Fourth Featured Box Content', 'advertica-lite'),
			'desc' => __('Enter content for fourth featured box.','advertica-lite'),
			'id' => $advertica_shortname.'_fb4_second_part_content',
			'std' => ' Products with the ultimate features and functionality that provide the complete satisfaction to the clients.',
			'type' => 'textarea');

	    $options[] = array(
			'name' => __('Fourth Featured Box Link', 'advertica-lite'),
			'desc' => __('Enter link for fourth featured box.', 'advertica-lite'),
			'id' => $advertica_shortname.'_fb4_second_part_link',
			'std' => '#',
			'type' => 'text');

	//Front Page Parallax Box Options	
	$options[] = array(
		'name' => __('Home Parallax Section', 'advertica-lite'),
		'type' => 'heading');

	$options[] = array(
			'name' => __('Parallax Section Background Image (size: width * height (1600x * 1000px) )', 'advertica-lite'),
			'desc' => __('Upload background image for parallax section.', 'advertica-lite'),
			'id' => $advertica_shortname.'_fullparallax_image',
			'std' => $imagepath.'Parallax_Section_Image.jpg',
			'type' => 'upload');

	$options[] = array(
			'name' => __('Parallax Section Content', 'advertica-lite'),
			'desc' => __('Enter content for parallax section','advertica-lite'),
			'id' => $advertica_shortname.'_para_content_left',
			'std' => '<div class="skt-awesome-section"> 
						<div class="skt-awesome-title">Awesome Parallax Section</div><div class="skt-awesome-desp">Advertica features an amazing parallax section</div>
					  </div>',
			'type' => 'textarea');

	//Front Page Options	
	$options[] = array(
		'name' => __('Home Clients Logo Section', 'advertica-lite'),
		'type' => 'heading');

	$options[] = array(
			'name' => __('Client Section Title', 'advertica-lite'),
			'desc' => __('Enter title for client section.', 'advertica-lite'),
			'id' => $advertica_shortname.'_clientsec_title',
			'std' => 'Our Partners',
			'type' => 'text');

	$options[] = array(
			'name' => __('First Client Logo Title', 'advertica-lite'),
			'desc' => __('Enter title for first client logo image.', 'advertica-lite'),
			'id' => $advertica_shortname.'_img1_title',
			'std' => '',
			'type' => 'text');

	$options[] = array(
		'name' => __('First Client Logo Image (size: width * height (232px * 101px)', 'advertica-lite'),
		'desc' => __('Upload image for first client logo.', 'advertica-lite'),
		'id' => $advertica_shortname.'_img1_icon',
		'std' => $imagepath.'clients-logo/defdault-client-logo.png',
		'type' => 'upload');

	$options[] = array(
		'name' => __('First Client Logo Image Link', 'advertica-lite'),
		'desc' => __('Enter link for first client logo image.', 'advertica-lite'),
		'id' => $advertica_shortname.'_img1_link',
		'std' => '#',
		'type' => 'text');

	$options[] = array(
		'name' => __('Second Client Logo Title', 'advertica-lite'),
		'desc' => __('Enter title for second client logo image.', 'advertica-lite'),
		'id' => $advertica_shortname.'_img2_title',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Second Client Logo Image (size: width * height (232px * 101px)', 'advertica-lite'),
		'desc' => __('Upload image for second client logo.', 'advertica-lite'),
		'id' => $advertica_shortname.'_img2_icon',
		'std' => $imagepath.'clients-logo/defdault-client-logo.png',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Second Client Logo Image Link', 'advertica-lite'),
		'desc' => __('Enter link for second client logo image.', 'advertica-lite'),
		'id' => $advertica_shortname.'_img2_link',
		'std' => '#',
		'type' => 'text');

	$options[] = array(
		'name' => __('Third Client Logo Title', 'advertica-lite'),
		'desc' => __('Enter title for third client logo image.', 'advertica-lite'),
		'id' => $advertica_shortname.'_img3_title',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Third Client Logo Image (size: width * height (232px * 101px)', 'advertica-lite'),
		'desc' => __('Upload image for third client logo.', 'advertica-lite'),
		'id' => $advertica_shortname.'_img3_icon',
		'std' => $imagepath.'clients-logo/defdault-client-logo.png',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Third Client Logo Image Link', 'advertica-lite'),
		'desc' => __('Enter link for third client logo image.', 'advertica-lite'),
		'id' => $advertica_shortname.'_img3_link',
		'std' => '#',
		'type' => 'text');

	$options[] = array(
		'name' => __('Fourth Client Logo Title', 'advertica-lite'),
		'desc' => __('Enter title for fourth client logo image.', 'advertica-lite'),
		'id' => $advertica_shortname.'_img4_title',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Fourth Client Logo Image (size: width * height (232px * 101px)', 'advertica-lite'),
		'desc' => __('Upload image for fourth client logo.', 'advertica-lite'),
		'id' => $advertica_shortname.'_img4_icon',
		'std' => $imagepath.'clients-logo/defdault-client-logo.png',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Fourth Client Logo Image Link', 'advertica-lite'),
		'desc' => __('Enter link for fourth client logo image.', 'advertica-lite'),
		'id' => $advertica_shortname.'_img4_link',
		'std' => '#',
		'type' => 'text');

	$options[] = array(
		'name' => __('Fifth Client Logo Title', 'advertica-lite'),
		'desc' => __('Enter title for fifth client logo image.', 'advertica-lite'),
		'id' => $advertica_shortname.'_img5_title',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Fifth Client Logo Image (size: width * height (232px * 101px)', 'advertica-lite'),
		'desc' => __('Upload image for fifth client logo.', 'advertica-lite'),
		'id' => $advertica_shortname.'_img5_icon',
		'std' => $imagepath.'clients-logo/defdault-client-logo.png',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Fifth Client Logo Image Link', 'advertica-lite'),
		'desc' => __('Enter link for fifth client logo image.', 'advertica-lite'),
		'id' => $advertica_shortname.'_img5_link',
		'std' => '#',
		'type' => 'text');

	//Footer	

	$options[] = array(
		'name' => __('Footer Settings', 'advertica-lite'),
		'type' => 'heading');

		$options[] = array(
			'name' => __('Copyright Text', 'advertica-lite'),
			'desc' => __('Enter text for copyright (you can also use HTML tags here).', 'advertica-lite'),
			'id' => $advertica_shortname.'_copyright',
			'std' => "Copyright Text",
			'type' => 'textarea');
			
	return $options;

}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This example shows/hides an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');
function optionsframework_custom_scripts() { ?>
<script type="text/javascript">
jQuery(document).ready(function($) {
	$('#example_showhidden').click(function() {
  		$('#section-example_text_hidden').fadeToggle(400);
	});
	if ($('#example_showhidden:checked').val() !== undefined) {
		$('#section-example_text_hidden').show();
	}
	
	 var selected_bredbtn = jQuery("#section-advertica_bread_stype input:checked").val();
	if (selected_bredbtn === 'brcolor') {
		jQuery('#section-advertica_bread_color').show();
	}
    else if (selected_bredbtn === 'brimage') {
		jQuery('#section-advertica_bread_image').show();
	}

	jQuery("input[type='radio']").change(function() {
        var selected_radio = jQuery(this).val();
				if (selected_radio === 'brcolor') {
            jQuery('#section-advertica_bread_image').hide();
			jQuery('#section-advertica_bread_color').fadeIn();
        }else if (selected_radio === 'brimage') {
			jQuery('#section-advertica_bread_color').hide();
            jQuery('#section-advertica_bread_image').fadeIn();
        }
		
    });
});
</script>
<?php
}