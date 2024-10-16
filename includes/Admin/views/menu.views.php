<div class="wrap">
    <h1 class="page-title"><?php echo esc_html__('Simple User Registration', 'ri-simple-user-registration') ?></h1>
    <form method="post" action="options.php">
        <?php 
            settings_fields( 'simple_user_registration_config' );
            do_settings_sections( 'simple_user_registration_config' );
            submit_button( __('Save Settings', 'ri-simple-user-registration'));
        ?>
    </form>
</div>