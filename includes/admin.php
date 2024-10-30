<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!empty($_POST) && isset($_POST['_cel_nonce']) && wp_verify_nonce($_POST['_cel_nonce'], 'cel-admin-nonce')) {
    foreach ($_POST as $name => $value) {
        switch ($name) {
            case 'url':
                if ( $url = filter_var(sanitize_url($value), FILTER_VALIDATE_URL) ) {
                  update_option('check_external_login_'.$name, $url);
                }
                break;
            case 'submit':
            case '_cel_nonce':
                continue 2;
            default:
                update_option('check_external_login_'.$name, sanitize_text_field($value));
                break;
        }
    }
}

?>

<div class="wrap">
  <h1><?php echo __('Check external login'); ?></h1>

  <div class="informations">
    <h2><?php echo __('Settings'); ?></h2>

    <form method="post">
      <table class="form-table">
        <tbody>
        <tr>
          <th scope="row"><label for="cel-url"><?php echo __('Url to check'); ?></label></th>
          <td><input name="url" type="url" id="cel-url" value="<?php echo esc_url(get_option('check_external_login_url')); ?>" class="regular-text"></td>
        </tr>
        </tbody>
      </table>

        <?php wp_nonce_field('cel-admin-nonce', '_cel_nonce'); ?>

      <p class="submit">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php echo __('Save Changes'); ?>">
      </p>
    </form>
  </div>
</div>


