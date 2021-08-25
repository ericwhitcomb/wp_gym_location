<?php
/*
 * Plugin Name: WP Gym - Location with Leaflet
 * Plugin URI: 
 * Description: Creates a Shortcode to display the location
 * Version: 1.0.0
 * Author: Eric Whitcomb
 * Author URI: http://www.ericwhitcomb.com/
 * Text Domain: wp_gym
 */ 

if (!defined('ABSPATH')) die();

// Shortcode API
function wp_gym_location_shortcode() {
  $location = get_field('location');
?>

  <div class="location">
    <input type="hidden" id="lat" value="<?php echo $location['lat']; ?>" />
    <input type="hidden" id="lng" value="<?php echo $location['lng']; ?>" />
    <input type="hidden" id="zoom" value="<?php echo $location['zoom']; ?>" />
    <input type="hidden" id="address" value="<?php echo $location['address']; ?>" />

    <div id="map"></div>
  </div>

<?php
}
add_shortcode('wp-gym-location', 'wp_gym_location_shortcode');

// Enqueues the CSS and JS Files
function wp_gym_location_scripts() {

  if (is_page("contact-us")) {
    // Leaflet CSS
    wp_enqueue_style(
      'leaflet_css',
      "https://unpkg.com/leaflet@1.7.1/dist/leaflet.css",
      array(),
      '1.7.1'
    );

    // Leaflet JS
    wp_enqueue_script(
      'leaflet_js',
      "https://unpkg.com/leaflet@1.7.1/dist/leaflet.js",
      array(),
      '1.7.1',
      True // loads script in the footer
    );

    // Main Script JS
    wp_enqueue_script(
      'location_script',
      plugins_url('/js/wp_gym_leaflet.js', __FILE__),
      array('leaflet_js'),
      '1.0.0',
      True // loads script in the footer
    );
  }
}
add_action('wp_enqueue_scripts', 'wp_gym_location_scripts');
?>