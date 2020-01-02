<?php
/*
Plugin Name: NextPage
Plugin URI: https://nextpage.ai
Description: The easiest way to add the NextPage code snippet to your WordPress blog!
Version: 0.1
Author: NextPage
Author URI: https://nextpage.ai
License: GPL
*/

class NextPage {
  var $longName = 'NextPage for WordPress Options';
  var $shortName = 'NextPage';
  var $uniqueID = 'nextpage-ai';

  function __construct() {
    register_deactivation_hook(__FILE__, array( $this, 'delete_option' ) );
    add_action( 'wp_print_footer_scripts', array( $this, 'add_script' ) );
    if ( is_admin() ) {
      add_action( 'admin_menu', array( $this, 'admin_menu_page' ) );
      add_action( 'admin_init', array( $this, 'register_settings' ) );
      add_filter( 'plugin_action_links_'.plugin_basename( __FILE__ ), array( $this, 'add_settings_link' ) );
      // add_action( 'wp_loaded', array( $this, 'embed_snippet' ) );
    }
  }

  public function delete_option() {
    delete_option('nextpage_code_snippet');
  }

  public function add_script() {
    $siteID = get_option("np_siteid");
    if (strlen($siteID) > 0) {
      $snippet = "
      <script>
        //nextpage.ai code snippet
        const _np_sid = '" . $siteID . "';
        (function(d) {
          var e = d.createElement('script'),
              s = d.scripts[0];
          e.crossorigin = 'anonymous';
          e.async = e.src = 'https://cdn.nextpage.ai/nextpage.js';
          s.parentNode.insertBefore(e, s);
        }(document));
      </script>
      ";
    } else {
      $snippet = '<!-- nextpage site id not configured -->';
    }
    echo $snippet . "\n";
  }

  public function admin_menu_page() {
    add_menu_page(
      $this->longName,
      $this->shortName,
      'administrator',
      $this->uniqueID,
      array( $this, 'admin_options'),
      plugins_url('images/icon.png', __FILE__)
    );
  }

  public function register_settings() {
    register_setting( 'nextpage-options', 'np_siteid' );
  }

  public function admin_options() {
    include 'views/options.php';
  }

  public function add_settings_link( $links ) {
    $settings_link = array( '<a href="admin.php?page=nextpage-ai">Settings'.'</a>' );
    return array_merge( $links, $settings_link );
  }

}

add_action( 'init', 'NextPageForWordPress' );
function NextPageForWordPress() {
  global $NextPageForWordPress;

  $NextPageForWordPress = new NextPage();
}
?>
