<?php
/**
 * Project pizazzwp-architect.
 * File: arc-sudo-admin.php
 * User: chrishoward
 * Date: 15/05/15
 * Time: 8:17 PM
 */

  add_filter('arc-slider-engine','pzarc_sudo');
  function pzarc_sudo($sliders){
    $sliders['sudo']='Sudo';
    return $sliders;
  }

  add_filter('arc-extend-slider-settings','pzarc_sudo_slider_settings');
  function pzarc_sudo_slider_settings($settings) {

    $prefix='_sudo_';

    $settings['fields'][] =
    array(
      'title'    => __( 'Sudo', 'pzarchitect' ),
      'id'       => $prefix . 'section-sudo-heading',
      'type'     => 'section',
      'indent'   => true,
      'required' => array( '_blueprints_slider-engine', '=', 'sudo' ),
    );
    $settings['fields'][] =
        array(
            'title'   => __('Options', 'pzarchitect'),
            'id'      => $prefix . 'extra-options',
            'type'    => 'button_set',
            'multi'=>true,
            'default' => array('infinite','pause','adaptive'),
            'options' => array('infinite'=>'Infinite loop','pause'=>'Pause on hover','adaptive'=>'Adaptive height')
        );


    $settings['fields'][] = array(
      'id'       => $prefix . 'section-sudo-close',
      'type'     => 'section',
      'indent'   => false,
      'required' => array( '_blueprints_slider-engine', '=', 'sudo' ),
    );

    return $settings;
  }