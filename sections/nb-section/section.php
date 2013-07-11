<?php
/*
	Section: Nicks Base Section
	Author: Nick Haskins
	Author URI: http://pagelinesdevcamp.com
	Description: A base section to be used to start new sections.
	Class Name: nicksBaseSection
	Demo:
	Version: 1.0
*/

/*
NOTE
There are a few additional headers you can utlize. One of which is a full-width filter that forces the section full-width. The other is an active loading filter, which, when applie, doesn't require a page refresh for the section to show up. however, sections with javascript shouldn't use this.
*/

class nicksBaseSection extends PageLinesSection {

	// Declares a version, used in tracking the version of the script. For some reason it's needed with DMS along with declaring true at the end of the script to force into teh footer
	const version = '1.0';

    // READY TO USE VARIABLES
    // $this->base_url;    the base url of the section
    // $this->base_dir;    the base directory of the section
    // $this->images;      create an /images directory in your section, then use this variable for the path
    // $this->screenshot;  the section thumb
    // $this->splash;      the section splash
    // $this->description  get the description from the header
    // get_the_id();       retrieves the clone id of the section

    // RUNS ALL TIME - This loads all the time, even if the section isn't on the page. Stuff like actions and things can go here, as well as post type setup functions
    function section_persistent(){}

    // LOAD SCRIPTS
    function section_scripts(){
        //wp_enqueue_script('script-name', $this->base_url.'/script.js', array('jquery'), self::version, true );
    }

    // RUNS IN <HEAD>
    function section_head() {

    	// Always use jQuery and never $ to avoid issues with other store products
    	/*
    	?><script>
	    	jQuery(document).ready(function(){

	    	});
    	</script><?php
    	*/

        // This is only needed if you'll be using custom fonts
        // echo load_custom_font($this->opt('nb_custom_font'), '.target-class');

    }

    // BEFORE SECTION - this adds a class to the section wrap. you can also put HTML here and it will run outside of the section, and before it
    function before_section_template( $location = '' ) {

		//$this->wrapper_classes['background'] = 'special-class';

	}

    // SECTION MARKUP - This is the function that outputs all the HTML onto the page. Put all your viewable content here
   	function section_template() {

        echo 'hi';

   	}

    // AFTER SECTION - you can  put HTML here and it will run outside of the section, and after it
	function after_section_template(){}


    // RUNS IN <FOOTER> - This is just like using wp_footer so this stuffs will in the foter of your site
	function section_foot(){}


    // WELCOME MESSAGE - HTML content for the welcome/intro option field
	function welcome(){

		ob_start();

		?><div style="font-size:12px;line-height:14px;color:#444;"><p><?php _e('You can have some custom text here.','nb-section');?></p></div><?php

		return ob_get_clean();
	}

    // SECTION OPTIONS - draws out the section options. This symbol * denotes optional fields.
	function section_opts(){

		$options = array();

        // Anatomy of an option type
        $opts[] = array(
            'key'                   => 'option_key', // name of the key. always namespace
            'type'                  => 'text', // Option Type
            'title'                 => __('Super Cool Option', 'nb-section'), // same as 'label' if omitted
            'label'                 => __('Select Cool Option', 'nb-section'),
            'help'                  => __('Help text goes here. How nice of you!', 'nb-section'),
            'ref'                   => __( 'This creates a help field with a toggle.', 'nb-section' )
        );

        // Welcome
		$options[] = array(
            'key'                   => 'nbs_some_key',
            'type'                  => 'template',
            'title'                 => __('Welcome to My Section','nb-section'),
            'template'              => $this->welcome()
        );

        // Count select
		$options[] = array(
            'key'                   => 'nbs_some_key',
            'type'                  => 'count_select',
            'title'                 => __('Count Select','nb-section'),
            'count_start'           => 1,            // Starting Count Number
            'count_number'          => 100,          // Ending Count Number
            'suffix'                => '%'          // * Added to the end of the value
        );

        // Image Upload
        $options[] = array(
            'key'                   => 'nbs_some_key',
            'type'                  => 'image_upload',
            'title'                 => __('Image Upload','nb-section'),
            'imgsize'               => '16',        // * The image preview 'max' size
            'sizelimit'             => '512000',     // * Image upload max size default 512kb
        );

        // Color Picker
        $options[] = array(
            'key'                   => 'nbs_some_key',
            'type'                  => 'color',
            'title'                 => __('Color Picker','nb-section'),
            'default'               => '#FFFFFF', // always set a default

        );

        // Text, Textareas and Checkboxes
        $options[] = array(
            'key'                   => 'nbs_some_key',
            'type'                  => 'text',  // or "textarea" or "check"
            'title'                 => __('Text','nb-section'),
        );

        // Select Menu
        $options[] = array(
            'key'                   => 'nbs_some_key',
            'type'                  => 'select_menu',
            'title'                 => __('Menu Select','nb-section'),
        );

        // Select Taxonomy
        /*
        $options[] = array(
            'key'                   => 'nbs_some_key',
            'type'                  => 'select_taxonomy',
            'post_type'             => 'post', // the post type to grab taxonomies from
            'title'                 => __('Select Category','nb-section'),
        );
        */

        // Fonts - there is a second step required in order to get this part working. in section head, there's an example showing how to load a custom font, targeting a specific class in your section
        $options[] = array(
            'key'                   => 'nbs_some_key',
            'type'                  => 'type',
            'title'                 => __('Pick a Font','nb-section'),
        );

        // Icon selector
        $options[] = array(
            'key'                   => 'nbs_some_key',
            'type'                  => 'select_icon',
            'title'                 => __('Select an icon','nb-section'),
            'default'               => 'rocket'
        );

        // Link
        $options[] = array(
            'key'                   => 'nbs_some_key',
            'type'                  => 'link',
            'title'                 => __('Visit this link','nb-section'),
            'url'                   => 'http://www.pagelinesdevcamp.com',
            'classes'               => 'btn-info' // you can also use btn-primary, btn-warning, btn-success, btn-inverse
        );

        // Button Select
        $options[] = array(
            'key'                   => 'nbs_some_key',
            'type'                  => 'select_button',
            'title'                 => __('Select a button','nb-section'),
        );

        // Multi Select
		$options[] = array(
			'type'	                => 'multi', // here you can nest multiple options
			'title'                 => __( 'Multiple Option Configuration', 'nb-section' ),
			'opts'	                => array(
				array(
					'key'			=> 'nbs_some_key',
					'type' 			=> 'count_select',
					'count_start'	=> 1,
					'count_number'	=> 12,
					'default'		=> 4,
					'label' 	    => __( 'Counter', 'nb-section' ),
				),
				array(
					'key'			=> 'nbs_some_key',
					'type' 			=> 'color',
					'label' 	    => __( 'Color Picker', 'nb-section' ),
					'default'       => '#0077CC'
				),
			)

		);

		return $options;
	}

} // that's it, that's the end of it. never put code past this area as it's then out of the class
