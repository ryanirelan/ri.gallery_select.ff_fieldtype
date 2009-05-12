<?php

if ( ! defined('EXT')) exit('Invalid file request');


/**
 * Gallery Select Class
 * @package   Gallery Select
 * @author    Ryan Irelan <ryan@irelan.net>
 * @copyright 2009 Ryan Irelan
 * @license   http://creativecommons.org/licenses/by-sa/3.0/ Attribution-Share Alike 3.0 Unported
 */

class Ri_gallery_select extends Fieldframe_Fieldtype {

	var $info = array(
			'name'             => 'RI Gallery Select',
			'version'          => '0.1',
			'desc'             => 'Creates a select menu with all of your EE gallery categories',
			'docs_url'         => 'http://github.com'
			);


		/**
		 * Display Field
		 *
		 * @param  string  $field_name      The field's name
		 * @param  mixed   $field_data      The field's current value
		 * @param  array   $field_settings  The field's settings
		 * @return string  The field's HTML
		 */
		function display_field($field_name, $field_data, $field_settings)
		{
		 	global $DSP, $DB;
			
			$r = $DSP->input_select_header($field_name);
			$r .= $DSP->input_select_option('', '--');
			
			// fetch all gallery categories
			$gallery_categories = $DB->query("SELECT cat_id, cat_name FROM exp_gallery_categories");
			
			foreach ($gallery_categories->result as $cat):
				$r .= $DSP->input_select_option($cat['cat_id'], 
																				$cat['cat_name'], 
																				$field_data == $cat['cat_id']);
			endforeach;
			
			$r .= $DSP->input_select_footer();
			return $r;
		}

		/**
		 * Display Cell
		 *
		 * @param  string  $cell_name      The cell's name
		 * @param  mixed   $cell_data      The cell's current value
		 * @param  array   $cell_settings  The cell's settings
		 * @return string  The cell's HTML
		 * @author Brandon Kelly <me@brandon-kelly.com>
		 */
		function display_cell($cell_name, $cell_data, $cell_settings)
		{
			return $this->display_field($cell_name, $cell_data, $cell_settings);
		}

}


?>