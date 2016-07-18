<?
defined('_JEXEC') or die('Restricted access');
require_once( JApplicationHelper::getPath( 'toolbar_html' ) );

switch($task) {
	case "settings":
       menuxtremelocator::settings_menu();
    break;
    case "settings_add":
       menuxtremelocator::settings_add_menu();
    break;
    case "standard_search":
       menuxtremelocator::standard_search_menu();
    break;
    case "advanced_search":
       menuxtremelocator::advanced_search_menu();
    break;
    case "all_locations":
       menuxtremelocator::all_locations_menu();
    break;
    case "add_locations":
       menuxtremelocator::add_locations_menu();
    break;
    case "list_locations":
       menuxtremelocator::list_locations_menu();
    break;
    case "css_styles":
       menuxtremelocator::css_styles_menu();
    break;
    case "help":
        menuxtremelocator::help_menu();
    break;
    default:
		menuxtremelocator::control_menu();
		break;
}
?>