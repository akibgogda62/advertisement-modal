<?php
/*
Plugin Name: Advertisement Modal
Plugin URI: 
Description: A custom plugin for displaying Advertisement Modal.
Version: 1.0
Author: Aakib Gogda
Author URI: https://github.com/akibgogda62/
*/

require_once plugin_dir_path(__FILE__) . "settings.php";
require_once plugin_dir_path(__FILE__) . "general-functions.php";

function modal_output() {

    $image_id = get_option( 'modal_logo' );
    $image = wp_get_attachment_image_url( $image_id, 'medium'); 
    $modal_title = get_option('modal_title') ? get_option('modal_title') : 'This is default title';
    $modal_description = get_option('modal_description') ? get_option('modal_description') : 'This is default description';
    $modal_bg_color = get_option('modal_bg_color') ? get_option('modal_bg_color') : '#000000';
    $modal_text_color = get_option('modal_text_color') ? get_option('modal_text_color')  : '#ffffff';
    $modal_redirect_link = get_option('modal_redirect_link');

    if ( is_front_page()) {
        ?>
    <div class="agc-modal" style="background-color:<?php echo $modal_bg_color;?>">
        <div class="agc-modal-top-bar">
        <img class="agc-modal-logo" src="<?php echo $image;?>" style="display:<?php echo $image ? 'block' : 'none' ;?>">
        <span class="close-modal">&times;</span> 
        </div>
        <div class="modal-content">
        
            <h2 class="agc-modal-title" style="color:<?php echo $modal_text_color;?>"><?php echo $modal_title;?></h2>
            <p class="agc-modal-description" style="color:<?php echo $modal_text_color;?>"><?php echo $modal_description;?></p>
            <?php
            if($modal_redirect_link){?>
            <div class="agc-modal-visitbtn-outer">
            <a class="agc-modal-visitbtn" style="background-color:<?php echo $modal_text_color;?>;color:<?php echo $modal_bg_color;?>" target="_blank" href="<?php echo $modal_redirect_link;?>" class="visit-button">Visit</a>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php
    }
}
add_action('wp_footer', 'modal_output');