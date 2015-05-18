<?php
/*
Plugin Name: Bullhorn RSS display
Plugin URI: http://y-designs.com/
Description: A simple wordpress plugin that pulls from the bullhorn RSS
Version: 0.1
Author: Ryuhei Yokokawa
Author URI: http://y-designs.com
License: GPL
*/

//I've put all the admin stuff in the other file.
require_once(dirname(__FILE__) . '/admin.php');

if(!function_exists('yd_bullhorn')) {

	function yd_bullhorn() {
		$view = '';
		$objects = get_transient('yd_bullhorn_cache');
		
		if( get_option('bh_cache') && $objects !== false ) {
			//if the cache exists and it isn't expired (10 minutes or 6000 seconds)
			//objects is set above, note in PHP a single equal sign sets a variable in an if statement.
			
		} else {
			$objects = yd_bullhorn_get();//grab the RSS.
			$objects = json_encode($objects);//back to array;
			if(get_option('bh_cache')) {//if the system is set to do a cache, set it.
				set_transient('yd_bullhorn_cache',$objects, 600);//600 seconds = 10 minutes
			} else {
				delete_transient( 'yd_bullhorn_cache');
			}
		}

		$objects = json_decode($objects,true);//back to array;

		if(is_array($objects) && count( $objects['channel']['item'] )) {
			//Definitely not my idea of awesome code, but it works.
			foreach($objects['channel']['item'] as $object) {
				$view .='
				<div class="item">
				        <a href="'.$object['link'].'">
				                <h2>'.$object['title'].'</h2>
				        </a>
				        <date>'.$object['pubDate'].'</date>
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


	function yd_bullhorn_get() {
		$context  = stream_context_create(array('http' => array('header' => 'Accept: application/xml')));
		$url = get_option('bh_rss_url');
		$xml = file_get_contents($url, false, $context);
		$objects = simplexml_load_string($xml);
		return $objects;
	}
}
