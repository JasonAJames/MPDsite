<?
defined('_JEXEC') or die('Restricted access');
JHTML::stylesheet( 'xtremelocator.css', 'administrator/components/com_xtremelocator/css/' );

class HTML_xtremelocator{
    
    function control($option){                
           require_once "views/cpanel_menu.php";
    }
    function settings($option,&$row,&$fields){
           require_once "views/functions.php";
           require_once "views/settings.php";
    }
    function settings_add($option,&$row){
            require_once "views/functions.php";
            require_once "views/settings_add.php";
    }
    function standard_search($option,&$gobal_config,&$row,&$fields,&$fields2,&$afields){
        
        require_once "views/functions.php";
        require_once "views/standard_search.php";
    }
    function advanced_search($option,&$gobal_config,&$row,&$fields,&$fields2,&$afields){
        require_once "views/functions.php";
        require_once "views/advanced_search.php";
    }
    function all_locations($option,&$gobal_config,&$row){
        require_once "views/functions.php";
        require_once "views/all_locations.php";
    }
    function add_locations($option){
    
    }
    function list_locations($option,&$gobal_config,&$row,&$fields,&$fields2,&$afields){
        require_once "views/functions.php";
        require_once "views/list_locations.php";
    }
     function css_styles($option,&$styles){
        require_once "views/functions.php";
        require_once "views/css_styles.php";
    }
    function location_admin($option){
        require_once "views/location_admin.php";
    }
    function help($option){
        require_once "views/help.php";
    }
}
?>