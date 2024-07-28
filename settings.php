<?php 

// Hook for adding admin menus
add_action('admin_menu', 'modal_advertisement_menu');

// Register and add settings
add_action('admin_init', 'modal_advertisement_settings');

function modal_advertisement_menu() {
    add_menu_page(
        'Modal Advertisement Settings', // Page title
        'Modal Advertisement',          // Menu title
        'manage_options',                // Capability
        'modal-advertisement',          // Menu slug
        'modal_advertisement_settings_page', // Function to display the settings page
        'dashicons-format-image',        // Icon URL
        110                              // Position
    );
}

// Display the settings page
function modal_advertisement_settings_page() {
    ?>
    <div class="wrap">
        <h1>Modal Advertisement Settings</h1>
        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php
            settings_fields('modal_advertisement_settings_group');
            do_settings_sections('modal-advertisement');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

function modal_advertisement_settings() {
    register_setting('modal_advertisement_settings_group', 'modal_title');
    register_setting('modal_advertisement_settings_group', 'modal_description');
    register_setting('modal_advertisement_settings_group', 'modal_logo');
    register_setting('modal_advertisement_settings_group', 'modal_bg_color');
    register_setting('modal_advertisement_settings_group', 'modal_text_color');
    register_setting('modal_advertisement_settings_group', 'modal_cookie_store_time');
    register_setting('modal_advertisement_settings_group', 'modal_redirect_link');

    add_settings_section(
        'modal_advertisement_section',
        'Modal Settings',
        'modal_advertisement_section_callback',
        'modal-advertisement'
    );

    add_settings_field(
        'modal_title',
        'Modal Title',
        'modal_title_callback',
        'modal-advertisement',
        'modal_advertisement_section'
    );

    add_settings_field(
        'modal_description',
        'Modal Description',
        'modal_description_callback',
        'modal-advertisement',
        'modal_advertisement_section'
    );

    add_settings_field(
        'modal_logo',
        'Modal Logo',
        'modal_logo_callback',
        'modal-advertisement',
        'modal_advertisement_section'
    );

    add_settings_field(
        'modal_bg_color',
        'Background Color',
        'modal_bg_color_callback',
        'modal-advertisement',
        'modal_advertisement_section'
    );

    add_settings_field(
        'modal_text_color',
        'Text Color',
        'modal_text_color_callback',
        'modal-advertisement',
        'modal_advertisement_section'
    );

    add_settings_field(
        'modal_cookie_store_time',
        'Cookie Store Time (in days)',
        'modal_cookie_store_time_callback',
        'modal-advertisement',
        'modal_advertisement_section'
    );

    add_settings_field(
        'modal_redirect_link',
        'Modal Redirect Link',
        'modal_redirect_link_callback',
        'modal-advertisement',
        'modal_advertisement_section'
    );

}

function modal_advertisement_section_callback() {
    echo 'Configure the settings for your modal.';
}

function modal_title_callback() {
    $modal_title = get_option('modal_title','This is default text');
    echo '<input type="text" id="modal_title" name="modal_title" value="' . esc_attr($modal_title) . '" />';
}

function modal_redirect_link_callback() {
    $modal_redirect_link = get_option('modal_redirect_link');
    echo '<input type="text" id="modal_redirect_link" name="modal_redirect_link" value="' . esc_attr($modal_redirect_link) . '" />';
}

function modal_description_callback() {
    $modal_description = get_option('modal_description') ? get_option('modal_description') : '';
    ?>
    <textarea id="modal_description" name="modal_description" rows="5" cols="30"><?php echo esc_textarea($modal_description); ?></textarea>
    <?php
}

function modal_cookie_store_time_callback() {
    $modal_cookie_store_time = get_option('modal_cookie_store_time');
    echo '<input type="number" id="modal_cookie_store_time" name="modal_cookie_store_time" value="' . esc_attr($modal_cookie_store_time) . '" />';
}

function modal_logo_callback() {

    $image_id = get_option( 'modal_logo' );
    $image = wp_get_attachment_image_url( $image_id, 'small');


    if( $image ) : ?>
        <a href="#" style="text-decoration: none;" class="agc-modal-upload">
            <img style="height: 100px; width: 100px;" src="<?php echo esc_url( $image ) ?>" />
        </a>
        <a href="#" style="text-decoration: none;" class="agc-modal-remove">&times;</a>
        <input type="hidden" name="modal_logo" value="<?php echo absint( $image_id ) ?>">
    <?php else : ?>
        <a href="#" class="button agc-modal-upload">Upload image</a>
        <a href="#" style="text-decoration: none;display:none" class="agc-modal-remove">&times;</a>
        <input type="hidden" name="modal_logo" value="">
    <?php endif;
     
}

function modal_bg_color_callback() {
    $modal_bg_color = get_option('modal_bg_color') ? get_option('modal_bg_color') : '#000000';
    echo '<input type="text" id="modal_bg_color" name="modal_bg_color" value="' . esc_attr($modal_bg_color) . '" class="modal_bg_color" />';
}

function modal_text_color_callback() {
    $modal_text_color = get_option('modal_text_color') ? get_option('modal_text_color')  : '#ffffff';
    echo '<input type="text" id="modal_text_color" name="modal_text_color" value="' . esc_attr($modal_text_color) . '" class="modal_text_color" />';
}
