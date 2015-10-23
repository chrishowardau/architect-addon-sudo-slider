<?php
  /**
   * Project pizazzwp-architect.
   * File: arc-sudo-public.php
   * User: chrishoward
   * Date: 14/05/15
   * Time: 11:43 PM
   *
   * Loads the sudo
   */

  add_filter('arc-set-slider-data', 'pzarc_sudo_data', 10, 2);
  function pzarc_sudo_data($slider, $blueprint)
  {
    // sudo
//    wp_register_script('js-arc-front-sudojs', PZARC_PLUGIN_URL . '/extensions-inc/sliders/sudo/arc-front-sudo.js', array('jquery'), null, true);
    wp_register_script('js-sudojs', plugin_dir_url(__FILE__) . 'sudoslider/js/jquery.sudoSlider.js', array('jquery'), null, true);
    wp_register_style('css-sudojs', plugin_dir_url(__FILE__) . 'sudoslider/css/style.css');
    wp_register_style('css-arcsudo', plugin_dir_url(__FILE__) . 'arc-sudo.css');

//    wp_enqueue_script('js-arc-front-sudojs');
    wp_enqueue_script('js-sudojs');
    wp_enqueue_style('css-sudojs');
    wp_enqueue_style('css-arcsudo');

    $is_rtl = is_rtl() ? 'true' : 'false';

    // Setup the slides
    $pzarc_sudo_data = '{';
    $pzarc_sudo_data .= "
        continuous:   false,
        history:      false,
        auto:         false,
        numeric:      false,
        customLink:   '.sudo-nav',
        vertical:     false,
        effect:       'slide',
        updateBefore: true";
//    $pzarc_sudo_data .= ' "effect": ' . (!empty($blueprint[ '_blueprints_transitions-type' ]) ? $blueprint[ '_blueprints_transitions-type' ] : 'slide');
//    $pzarc_sudo_data .= ', "slidesCount": ' . $blueprint[ '_blueprints_section-0-columns-breakpoint-1' ];
//    $pzarc_sudo_data .= ', "moveCount": ' . $blueprint[ '_blueprints_section-0-columns-breakpoint-1' ];
//    $pzarc_sudo_data .= ', "auto":' . (!empty($blueprint[ '_blueprints_transitions-interval' ]) ? 'true' : 'false');
//    $pzarc_sudo_data .= ', "pause":' . (!empty($blueprint[ '_blueprints_transitions-interval' ]) ? ($blueprint[ '_blueprints_transitions-interval' ] * 1000) : 0);
//    $pzarc_sudo_data .= ', "autoHeight":' . (!isset($blueprint[ '_sudo_extra-options' ]) || in_array('adaptive', $blueprint[ '_sudo_extra-options' ]) ? 'true' : 'false');
//    $pzarc_sudo_data .= ', "pauseOnHover":' . (!isset($blueprint[ '_sudo_extra-options' ]) || in_array('pause', $blueprint[ '_sudo_extra-options' ]) ? 'true' : 'false');
//    $pzarc_sudo_data .= ', "vertical":false'; //this goes a bit weird if enabled
//    $pzarc_sudo_data .= ', "rtl":' . $is_rtl;
//    $pzarc_sudo_data .= ', "touch":true';
//    $pzarc_sudo_data .= ', "mouseTouch":' . ($blueprint[ '_blueprints_transitions-type' ] === 'slide' ? 'true' : 'false'); // Draggable i
//    $pzarc_sudo_data .= ', "continuous":' . (!isset($blueprint[ '_sudo_extra-options' ]) || in_array('infinite', $blueprint[ '_sudo_extra-options' ]) ? 'true' : 'false');
//
//    $pzarc_sudo_data .= ', "prevArrow":".' . $blueprint[ 'uid' ] . ' .pager.arrow-left"';
//    $pzarc_sudo_data .= ', "nextArrow":".' . $blueprint[ 'uid' ] . ' .pager.arrow-right"';
//
//    if ($blueprint[ '_blueprints_navigator' ] !== 'none') {
//      $pzarc_sudo_data .= ', "asNavFor":".' . $blueprint[ 'uid' ] . ' .pzarc-navigator-' . $blueprint[ '_blueprints_short-name' ] . '"';
//    }
    $pzarc_sudo_data .= '}';

//    $slider[ 'data' ] = 'data-sudo=\'' . $pzarc_sudo_data . '\'';

    global $pzarchitect_slider_scripts;

    $pzarchitect_slider_scripts = isset($pzarchitect_slider_scripts) ? $pzarchitect_slider_scripts : '';

    $pzarchitect_slider_scripts .= 'var sudoSlider = jQuery(".' . $blueprint[ 'uid' ] . ' .pzarc-section-using-' . $blueprint[ '_blueprints_short-name' ] . '").sudoSlider('.$pzarc_sudo_data.')';
//    $pzarchitect_slider_scripts .= '.on("beforeChange", function(event, sudo, currentSlide, nextSlide){
//        jQuery(this).find(".pzarc-panel").removeClass("active");
//        jQuery(this).find("[data-sudo-index=\""+nextSlide+"\"]").addClass("active");
//      })';
//    $pzarchitect_slider_scripts .= '.on("afterChange", function(event, sudo, currentSlide){
//        var realCurrent = jQuery("#pzarc-blueprint_' . $blueprint[ '_blueprints_short-name' ] . ' .pzarc-panel.active").attr("data-sudo-index");
//        jQuery(".' . $blueprint[ 'uid' ] . ' .pzarc-navigator .active").removeClass("active");
//        jQuery(".' . $blueprint[ 'uid' ] . ' .pzarc-navigator").find("[data-sudo-index=\""+realCurrent+"\"]").addClass("active");
//      });';

    $pzarchitect_slider_scripts .= "\n";

    /**
     * Setup the Navigator
     */

//    if ($blueprint[ '_blueprints_navigator' ] !== 'none') {
//      $navs_items_toshow = $blueprint[ '_blueprints_navigator-skip-thumbs' ];
//      $navs_items_toskip = $blueprint[ '_blueprints_navigator-skip-thumbs' ];
//      $nav_skipper       = ($blueprint[ '_blueprints_navigator-skip-button' ] !== 'none');
//      $nav_var_width     = 'false';
//      $nav_continuous    = ((!empty($blueprint[ '_blueprints_navigator-continuous' ]) && $blueprint[ '_blueprints_navigator-continuous' ] === 'continuous') ? 'true' : 'false');
//      switch (true) {
//        case $blueprint[ '_blueprints_navigator' ] === 'bullets':
//        case $blueprint[ '_blueprints_navigator' ] === 'numbers':
//        case $blueprint[ '_blueprints_navigator' ] === 'tabbed':
//        case $blueprint[ '_blueprints_navigator' ] === 'labels':
//          $navs_items_toshow = (!empty($blueprint[ '_blueprints_section-0-panels-limited' ]) ? $blueprint[ '_blueprints_section-0-panels-per-view' ] : 10);
//          $navs_items_toskip = 1;
//          $nav_skipper       = false;
//          $nav_var_width     = 'true';
//          $nav_continuous    = 'false';
//          break;
//        case in_array($blueprint[ '_blueprints_navigator-location' ], array('left', array('right'))):
//          $nav_skipper    = false;
//          $nav_continuous = 'false';
//          break;
//      }
//
//      $pzarchitect_slider_scripts .= 'jQuery(".' . $blueprint[ 'uid' ] . ' .pzarc-navigator-' . $blueprint[ '_blueprints_short-name' ] . '").sudoSlider({';
//      $pzarchitect_slider_scripts .= '  asNavFor:".' . $blueprint[ 'uid' ] . ' .pzarc-section-using-' . $blueprint[ '_blueprints_short-name' ] . '"';
//      $pzarchitect_slider_scripts .= ', slidesToShow:' . $navs_items_toshow;
//      $pzarchitect_slider_scripts .= ', slidesToScroll:' . $navs_items_toskip;
//      $pzarchitect_slider_scripts .= ', focusOnSelect:true';
//      $pzarchitect_slider_scripts .= ', centerMode:' . $nav_continuous;
//      $pzarchitect_slider_scripts .= ', draggable:true';
//      $pzarchitect_slider_scripts .= ', infinite:' . $nav_continuous;
////      $pzarchitect_slider_scripts .= ', arrows:true';
//      $pzarchitect_slider_scripts .= ', useCSS:false';
//      $pzarchitect_slider_scripts .= ', rtl:' . $is_rtl;
//      $pzarchitect_slider_scripts .= ',adaptiveHeight:true';
//      $pzarchitect_slider_scripts .= ', variableWidth:' . $nav_var_width;
//
//      if ($nav_skipper) {
//        $pzarchitect_slider_scripts .= ', prevArrow:".' . $blueprint[ 'uid' ] . ' .pager.skip-left"';
//        $pzarchitect_slider_scripts .= ', nextArrow:".' . $blueprint[ 'uid' ] . ' .pager.skip-right"';
//      } else {
//        $pzarchitect_slider_scripts .= ', prevArrow:false';
//        $pzarchitect_slider_scripts .= ', nextArrow:false';
//      }
//      $pzarchitect_slider_scripts .= '})';
//
////    $pzarchitect_slider_scripts .= '.on("beforeChange", function(event, sudo, currentSlide, nextSlide){
////        jQuery(this).find(".arc-slider-slide-nav-item").removeClass("active");
////      })';
//
//// TODO Why isn't this doing anything for numbers and bullets?
////      $pzarchitect_slider_scripts .= '.on("afterChange", function(event, sudo, currentSlide){
////        var realCurrent = jQuery("#pzarc-blueprint_' . $blueprint[ '_blueprints_short-name' ] . ' .pzarc-panel.active").attr("data-sudo-index");
////        jQuery(".'.$blueprint['uid'].' .pzarc-navigator .active").removeClass("active");
////        console.log(currentSlide, realCurrent,this);
////        jQuery(this).find("[data-sudo-index=\""+realCurrent+"\"]").addClass("active");
////      });';
//      $pzarchitect_slider_scripts .= "\n";
//    }

    return $slider;
  }

//  add_filter('arc-navigation-skipper', 'pzarc_sudo_nav_skipper', 10, 2);
  function pzarc_sudo_nav_skipper($hover_nav, $blueprint)
  {
    if ($blueprint[ '_blueprints_section-0-layout-mode' ] === 'slider'
        && $blueprint[ '_blueprints_navigator-skip-button' ] !== 'none'
        && !in_array($blueprint[ '_blueprints_navigator' ], array('none',
                                                                  'numbers',
                                                                  'bullets',
                                                                  'tabbed',
                                                                  'labels'))
        && !in_array($blueprint[ '_blueprints_navigator-position' ], array('none',
                                                                           'right',
                                                                           'left'))
    ) {
      $skip_left  = 'backward';
      $skip_right = 'forward';
      // open the nav

      $hover_nav .= '<button class="pager skip-left icon-btn-style"><span class="icon-' . $skip_left . ' ' . $blueprint[ '_blueprints_navigator-skip-button' ] . '"></span></button>';
      $hover_nav .= '<button class="pager skip-right icon-btn-style"><span class="icon-' . $skip_right . ' ' . $blueprint[ '_blueprints_navigator-skip-button' ] . '"></span></button>';

    }

    return $hover_nav;
  }

  add_filter('arc-navigator-class', 'pzarc_set_nav_sudo_class', 10, 2);
  function pzarc_set_nav_sudo_class($class, $blueprint)
  {
    switch ($blueprint[ '_blueprints_navigator' ]) {

      case 'thumbs':
        // Use custom thumbs
        // This is exactly the same as the one in the default navigator and is just provided as an example
        $class = 'arc_Navigator_sudo_Thumbs';
        break;

      case 'bullets':
        // Use custom thumbs
        // This is exactly the same as the one in the default navigator and is just provided as an example
        $class = 'arc_Navigator_sudo_Bullets';
        break;

      case 'numbers':
        // Use custom thumbs
        // This is exactly the same as the one in the default navigator and is just provided as an example
        $class = 'arc_Navigator_sudo_Numbers';
        break;

      default:
        $class = 'arc_Navigator_' . $blueprint[ '_blueprints_navigator' ];

    }

    return $class;
  }

  // This is exactly the same as the one in the default navigator and is just provided as an example
  class arc_Navigator_sudo_Thumbs //extends arc_Navigator
  {
    function _construct()
    {
      $this->nav_types[] = __CLASS__;

    }

    function render()
    {
      $i        = 1;
      $nav_html = '';
      foreach ($this->navitems as $nav_item) {
        $active = ($i === 1 ? ' current' : '');
        $nav_html .= '<div class="sudo-nav arc-slider-slide arc-slider-slide-nav-item' . $this->sizing . $active . ' arc-navitem-' . $i . ' arc-navitem-' . sanitize_title($nav_item) . '" data-target="' . $i . '" >' . $nav_item . '</div>';
        $i++;
      }

      echo $nav_html;
    }


  }

  /**
   * Class arc_Navigator_Bullets
   */
  class arc_Navigator_sudo_Bullets extends arc_Navigator
  {
    function _construct()
    {
      $this->nav_types[] = __CLASS__;

    }

    function render()
    {
      $i = 1;
      foreach ($this->navitems as $nav_item) {
        $active = ($i === 1 ? ' current' : '');
        echo '<div class="sudo-nav arc-slider-slide-nav-item' . $this->sizing . $active . ' arc-navitem-'.$i.' arc-navitem-'.sanitize_title($nav_item).'" data-target="' . $i++ . '"></div>';
      }
    }

  }

  /**
   * Class arc_Navigator_Numbers
   */
  class arc_Navigator_sudo_Numbers extends arc_Navigator
  {
    function _construct()
    {
      $this->nav_types[] = __CLASS__;

    }

    function render()
    {
      $i = 1;
      foreach ($this->navitems as $nav_item) {
        $active = ($i === 1 ? ' current' : '');
        echo '<div class="sudo-nav arc-slider-slide arc-slider-slide-nav-item' . $this->sizing . $active . ' arc-navitem-'.$i.' arc-navitem-'.sanitize_title($nav_item).'" data-target="' . $i . '">' . $i++ . '</div>';
      }
    }

  }



  add_filter('arc-add-hover-buttons', 'pzarc_sudo_add_hover_buttons', 10, 2);
  function pzarc_sudo_add_hover_buttons($return_val, $blueprint)
  {
    $return_val .= '<button type="button" class="sudo-nav pager arrow-left icon-arrow-left4 hide" data-target="prev"></button>';
    $return_val .= '<button type="button" class="sudo-nav pager arrow-right icon-uniE60D" data-target="next"></button>';

    return $return_val;
  }

  add_action('wp_print_footer_scripts', 'pzarc_sudo_scripts');
  function pzarc_sudo_scripts()
  {
    echo '<!-- Architect slider scripts -->';
    global $pzarchitect_slider_scripts;
    if (!empty($pzarchitect_slider_scripts)) {
      echo '<script type="text/javascript" id="architect-sudo">';
      echo '(function($) {';
      echo $pzarchitect_slider_scripts;
      echo '}(jQuery))';
      echo '</script>';
    }
    // Make sure this isn't acidentally saved in anyway
    unset($pzarchitect_slider_scripts);
  }

