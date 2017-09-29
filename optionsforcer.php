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
 class Plugin {

   public static function init(){
     global $wp_options;
     if ( isset($wp_options) && is_array($wp_options) ){
       foreach($wp_options as $option => $value){
         self::overrideOption($option, $value);
       }
     }
   }

   public static function overrideOption($name, $value){
     add_filter("option_${name}", function() use($value) {
       return $value;
     });
   }
 }
 add_action('init', ['\OptionsForcer\Plugin', 'init']);

?>
