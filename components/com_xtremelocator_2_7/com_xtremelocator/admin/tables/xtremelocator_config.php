<?
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );

class TableXtremelocator_config extends JTable{
	var $id = null;
	var $site_id= null;    
    var $show_slogan= null;
    var $show_advanced_link= null;  
    var $show_new_registration_link= null;
    var $show_all_location_link= null;
    var $locations_per_page= null;
    var $type= null;
    var $search_type= null;    
    var $form_code= null;
    var $describtion= null;
    var $map_width_list= null;
    var $map_height_list= null;
    var $result_type_list= null;
    var $map_width_details= null;
    var $map_height_details= null;
    var $result_type_details= null;
    var $map_layout_details= null;
    var $map_layout_list= null;
    var $location_columns= null;
    var $center_coordinates= null;
    var $zoom_level= null;
	var $text_width_list= null;
    var $text_height_list= null;
    var $text_width_details= null;
    var $text_height_details= null;
    
    function __construct( &$database ) {
		parent::__construct( '#__xtremelocator_config', 'id', $database );		
	}
	
}

?>