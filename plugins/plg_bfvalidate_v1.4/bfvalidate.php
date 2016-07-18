<?php
/**
 * BF Validate
 */
defined( '_JEXEC' ) or die( 'Restricted access' );

class BFBehavior
{
	function __construct() { }

	function formbfvalidation() {
		JHTML::script('bfvalidate.js', 'plugins/system/');
	}
}


?>