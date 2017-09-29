<?php
/**
 * Plugin Name: OptionsForcer
 * Plugin URI: https://github.com/memuller/wp-optionsforcer/
 * Description: Overrides wp_options using values provided in a global $wp_options array.
 * Version: 1.0a
 * Author: Matheus E. Muller
 * Author URI: https://memuller.com/
 * License: GPLv3
 */

namespace OptionsForcer;

// fails if called outside of Wordpress.
if(!function_exists('\add_action')) die();

/**
 * Class OptionsForcer\Plugin
 * The main (and only) plugin class.
 */
class Plugin {
  /**
   * Hooks the plugin.
   * Checks if a global $wp_options is defined and is an array,
   * if so, overrides the options named there by calling overrideOption.
   *
   * @uses self::overrideOption
   */
  public static function init(){
    global $wp_options;
    if ( isset($wp_options) && is_array($wp_options) ){
      foreach($wp_options as $option => $value){
        self::overrideOption($option, $value);
      }
    }
  }

  /**
   * Overrides a wp_option w/ a given value,
   * by hooking at the option_$NAME filter.
   *
   * @param string $name The option to override.
   * @param void $value The value which will override the option.
   */
  public static function overrideOption($name, $value){
    add_filter("option_${name}", function() use($value) {
      return $value;
    });
  }

}

// Calls the plugin main hook.
add_action('init', ['\OptionsForcer\Plugin', 'init']);
