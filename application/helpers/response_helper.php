<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Array Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('json_response'))
{
	/**
	 * Element
	 *
	 * Lets you determine whether an array index is set and whether it has a value.
	 * If the element is empty it returns NULL (or whatever you specify as the default value.)
	 *
	 * @param	string
	 * @param	array
	 * @param	mixed
	 * @return	mixed	depends on what the array contains
	 */
	function json_response ( $data, $headers = NULL )
	{
	    ob_start();
		$ci =& get_instance ();

		if ( NUll != $headers ) {
			foreach ( $headers as $name => $value ) {
				if ( empty ( $value ) == false ) {
					$ci->output->set_header( $name.': '.$value );
				} else {
					$ci->output->set_header( $name );
				}
			}
		}
		$ci->output
		->set_status_header(200)
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
		->_display();
		
		$items = ob_get_contents();
		ob_end_clean();
		file_put_contents('file.txt', $items);
		echo $items;
		
		exit;
	}
}
