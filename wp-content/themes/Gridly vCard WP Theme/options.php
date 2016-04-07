<?php

/**
* A unique identifier is defined to store the options in the database and reference them from the theme.
* By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
* If the identifier changes, it'll appear as if the options have been reset.
*
*/

function optionsframework_option_name()
{
    // This gets the theme name from the stylesheet (lowercase and without spaces)
    $themeName = get_option( 'stylesheet' );
    $themeName = preg_replace("/\W/", "_", strtolower($themeName) );

    $optionsFrameworkSettings = get_option('optionsframework');
    $optionsFrameworkSettings['id'] = $themeName;
    update_option('optionsframework', $optionsFrameworkSettings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 */

function optionsframework_options()
{
    return array(
        array(
            'name' => 'General',
            'type' => 'heading'
        ),

        array(
            'id' => 'vcard_name', 'name' => 'Name', 'std' => 'John Doe',
            'desc' => 'Please introduce yourself', 'type' => 'text', 'class' => 'small'
        ),

        array(
            'id' => 'vcard_position', 'name' => 'Position', 'std' => 'Web Designer',
            'desc' => 'Please specify your desired position', 'type' => 'text', 'class' => 'small'
        ),

        array(
            'id' => 'vcard_picture_uri', 'name' => 'Picture', 'std' => get_template_directory_uri().'/images/photo.png',
            'desc' => 'Please add a picture for theme header', 'type' => 'upload'
        ),

        array(
            'id' => 'vcard_contact_phone', 'name' => 'Contact phone', 'std' => '+1-234-56-78',
            'desc' => 'Specify a contact phone and place it in any page you want with [contact] tag.
                       Leave this field blank if you don\'t want to leave a contact number on site', 'type' => 'text', 'class' => 'small'
        ),

        array(
            'id' => 'vcard_feedback_email', 'name' => 'Feedback email', 'std' => 'example@example.com',
            'desc' => 'This email will get all messages from "Feedback" tab. Also this address can be placed anywhere in content using [contact] tag', 'type' => 'text', 'class' => 'small'
        ),

        array(
            'name' => 'Social',
            'type' => 'heading'
        ),

        array(
            'name' => '',
            'type' => 'info',
            'desc' => 'At this tab you can provide links to your profiles at social networks and IMs.
            These options will be used to create corresponding buttons in theme header.
            You can leave textbox field blank to hide contact button from them header.
            These options can be displayed using [contact] tag anywhere in content.'
        ),

        array(
            'id' => 'vcard_skype', 'name' => 'Skype login', 'std' => 'echo123',
            'desc' => 'your Skype login. Also available via
                      [contact type="skype"] short tag', 'type' => 'text', 'class' => 'small'
        ),

        array(
            'id' => 'vcard_facebook', 'name' => 'Facebook link', 'std' => '#',
            'desc' => 'hyperlink to your Facebook account. Also available via [contact type="facebook"] short tag', 'type' => 'text', 'class' => 'small'
        ),

        array(
            'id' => 'vcard_twitter', 'name' => 'Twitter link', 'std' => '#',
            'desc' => 'hyperlink to your Twitter account. Also available via [contact type="twitter"] short tag', 'type' => 'text', 'class' => 'small'
        ),

        array(
            'id' => 'vcard_linked_in', 'name' => 'LinkedIn profile', 'std' => '#',
            'desc' => 'hyperlink to your LinkedIn profile. Also available via [contact type="linked-in"] short tag', 'type' => 'text', 'class' => 'small'
        ),

        array(
            'id' => 'vcard_instagram', 'name' => 'Instagram link', 'std' => '#',
            'desc' => 'hyperlink to your Instagram profile. Also available via [contact type="instagram"] short tag', 'type' => 'text', 'class' => 'small'
        ),

        array(
            'name' => 'Map',
            'type' => 'heading'
        ),

        array(
            'id' => 'vcard_latitude', 'name' => 'Latitude', 'std' => '51.482806',
            'desc' => 'Latitude for map from "Contacts" tab', 'type' => 'text', 'class' => 'small'
        ),

        array(
            'id' => 'vcard_longitude', 'name' => 'Longitude', 'std' => '-0.004699',
            'desc' => 'Longitude for map from "Contacts" tab', 'type' => 'text', 'class' => 'small'
        ),

        array(
            'name' => '',
            'type' => 'info',
            'desc' => 'You can find latitude and longitude of any point <a href="http://itouchmap.com/latlong.html">here</a>'
        ),

        array(
            'name' => 'Theme options',
            'type' => 'heading'
        ),

        array(
            'id' => 'vcard_color_scheme', 'name' => 'Color scheme', 'std' => get_template_directory_uri().'/css/colors/color-cf-blue.css',
            'desc' => '', 'type' => 'select',
            'options' => array(
                get_template_directory_uri().'/css/colors/color-blue.css' => 'blue',
                get_template_directory_uri().'/css/colors/color-cf-blue.css' => 'cf-blue',
                get_template_directory_uri().'/css/colors/color-cf-green.css' => 'cf-green',
                get_template_directory_uri().'/css/colors/color-cf-magenta.css' => 'cf-magenta',
                get_template_directory_uri().'/css/colors/color-cf-orange.css' => 'cf-orange',
                get_template_directory_uri().'/css/colors/color-cf-red.css' => 'cf-red',
                get_template_directory_uri().'/css/colors/color-cream.css' => 'cream',
                get_template_directory_uri().'/css/colors/color-darkgray.css' => 'darkgray',
                get_template_directory_uri().'/css/colors/color-green.css' => 'green',
                get_template_directory_uri().'/css/colors/color-lightgray.css' => 'lightgray',
                get_template_directory_uri().'/css/colors/color-orange.css' => 'orange',
                get_template_directory_uri().'/css/colors/color-pink.css' => 'pink',
                get_template_directory_uri().'/css/colors/color-red.css' => 'red',
                get_template_directory_uri().'/css/colors/color-tan.css' => 'tan',
                get_template_directory_uri().'/css/colors/color-yellow.css' => 'yellow'
            )
        ),

        array(
            'id' => 'vcard_copyright', 'name' => 'Copyright text', 'std' => '© 2014 <a href="http://neuethemes.net/">neuethemes</a>',
            'desc' => 'Copyright text for footer', 'type' => 'text', 'class' => 'small'
        )
    );
}
