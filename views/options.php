<div class="wrap">
  <h1><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="tomato" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers">
            <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
            <polyline points="2 17 12 22 22 17"></polyline>
            <polyline points="2 12 12 17 22 12"></polyline>
        </svg> NextPage</h1>
        <hr/>
  <p>Copy your NextPage Site ID from <a href="https://app.nextpage.ai/install" target="_blank">here</a>, and paste it below.</p>
  <form action="options.php" method="post">
    <?php
      settings_fields( 'nextpage-options' );
      do_settings_sections( 'nextpage' );
      settings_errors();
     ?>
     <table class="form-table">
        <tr valign="top">
        <th>Your Site ID:</th>
        <td>
          <input style="width:175px;" type="text" name="np_siteid" value="<?php echo esc_attr( get_option('np_siteid') ); ?>">
        </td>
        </tr>
    </table>
     <?php submit_button(); ?>
  </form>
  <hr/>
  <p><a href="https://nextpage.ai/help/" target="_blank">NextPage Help & Support</a>.</p>
</div>
