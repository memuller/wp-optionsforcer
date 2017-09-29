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

/**
 * OptionsForcer plugin
 * Copyright (C) 2017 Matheus E. Muller

 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License version 3 as published
 * by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
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
