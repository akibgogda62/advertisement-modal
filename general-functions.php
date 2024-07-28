<?php

add_action('admin_enqueue_scripts', 'modal_admin_enqueue_scripts');
add_action( 'wp_enqueue_scripts', 'modal_enqueue_scripts' );
add_filter( 'upload_mimes', 'allow_upload_svg_files');


function modal_admin_enqueue_scripts() {
    if ( ! did_action( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}

    wp_enqueue_script( 'custom-modal-script-uploads', plugins_url( '/js/upload.js', __FILE__ ), array('jquery','wp-color-picker'), '1.0', true );

    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
}

function modal_enqueue_scripts() {
    wp_enqueue_style( 'custom-modal-style', plugins_url( '/css/style.css', __FILE__ ) );
    wp_enqueue_script( 'custom-modal-script-main', plugins_url( '/js/main.js', __FILE__ ), array('jquery'), '1.0', true );
    wp_localize_script('custom-modal-script-main', 'modalCookieStoreTime', array(
        'value' => get_option('modal_cookie_store_time',30),
    )
    );
}

function allow_upload_svg_files( $allowed ) {
    if ( !current_user_can( 'manage_options' ) )
        return $allowed;
    $allowed['svg'] = 'image/svg+xml';
    return $allowed;
}