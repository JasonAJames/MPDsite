<?
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );

class TableXtremelocator_fields extends JTable{
	var $id = null;
	var $field_id2= null;
    var $field_name= null;
	
    function __construct( &$database ) {
		parent::__construct( '#__xtremelocator_fields', 'id', $database );		
	}
	
}

?>