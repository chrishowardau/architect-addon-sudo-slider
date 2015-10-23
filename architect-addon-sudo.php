<?php
  /*
     Plugin Name: Architect Add-on - Sudo slider
     Plugin URI: http://architect4wp.com
     Description: Adds Sudo slider as sldier option in Slider layouts
     Version: 0.1
     Author: Chris Howard
     Author URI: http://pizazzwp.com
     License: GNU GPL v2
     Support: support@pizazzwp.com
    */

  define('PZARC_SUDOSLIDER_VERSION','0.1');


  add_action('plugins_loaded','pzarc_sudo_init');
  function pzarc_sudo_init()
  {
    // Sudo slider
    require_once plugin_dir_path(__FILE__) . 'arc-sudo-init.php';
  }
