<?php
/*
Plugin Name: Bullhorn RSS display
Plugin URI: http://y-designs.com/
Description: A simple wordpress plugin that pulls from a Bullhorn Jobs RSS
Version: 0.1
Author: Ryuhei Yokokawa
Author URI: http://y-designs.com
License: GPL
*/

//I've put all the admin stuff in the other file.
require_once(dirname(__FILE__) . '/admin.php');

if(!function_exists('yd_bullhorn')) {

	function yd_bullhorn($atts) {

		//Set attribute defaults
		$attr = shortcode_atts(array(
				'url' => get_option('bh_rss_url')
			), $atts);

		if(!strlen($attr['url'])) {
			return 'Please fill in the RSS URL.';
		}

		$unique = md5($attr['url']);//makes transient unique but persistent

		$view = '';//init the view to be sent back. Super primitive stuff!

		if( get_option( 'bh_load_styling' ) ) {
			wp_register_style( 'yd_bullhorn', plugins_url('yd_bullhorn.css', __FILE__) );
			wp_enqueue_style( 'yd_bullhorn' );
		}
		
		$objects = get_transient( 'yd_'.$unique );//see if this object exists as a transient.
		
		if( !get_option( 'bh_cache' ) || !$objects ) {
			$objects = yd_bullhorn_get($attr['url']);//grab the RSS.
			$objects = json_encode($objects);//back to array;

			if( get_option( 'bh_cache' ) ) {//if the system is set to do a cache, set it.
				set_transient( 'yd_'.$unique, $objects, 600 );//600 seconds = 10 minutes
			} else {
				delete_transient( 'yd_'.$unique );
			}
		}

		$objects = json_decode($objects,true);//back to array;

		if(is_array($objects) && count( $objects['channel']['item'] )) {
			//Definitely not my idea of awesome code, but it works.
			foreach($objects['channel']['item'] as $object) {
				//date_default_timezone_get();
				$cur_date = date("m-d-Y", strtotime($object['pubDate']));
				$view .='
				<div class="bullhorn-rss-item">
				        <a href="'.$object['link'].'">
				                <h2>'.$object['title'].'</h2>
				        </a>
				        <date>'.$cur_date.'</date>
				        <div class="content">'.$object['description'].'</div>
				</div>';
			}
			return $view;
		} else {
			return '';
		}

	}

	//Add that shortcode.
	add_shortcode('bullhorn_rss','yd_bullhorn');


	function yd_bullhorn_get($url) {
		$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
		$xml = file_get_contents($url, false, $context);
		$objects = simplexml_load_string($xml);
		return $objects;
	}
}
