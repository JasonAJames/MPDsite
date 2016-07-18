<?php
/**
* @Copyright Copyright (C) 2010- Gary Teh Name1price.Com
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );



require_once( JApplicationHelper::getPath( 'toolbar_html' ) );

switch ($task)
{
	case 'add':
	case 'new_content_typed':
	case 'new_content_section':
		TOOLBAR_content::_EDIT(false);
		break;
	case 'edit':
	case 'editA':
	case 'edit_content_typed':
		TOOLBAR_content::_EDIT(true);
		break;
/*
	case 'showarchive':
		TOOLBAR_content::_ARCHIVE();
		break;
*/
	case 'movesect':
		TOOLBAR_content::_MOVE();
		break;

	case 'copy':
		TOOLBAR_content::_COPY();
		break;
	case 'instantiated':
	case 'showbusinessclasses' :
		TOOLBAR_content::_SHOWBUSINESSCLASSES();
		break;
	case 'showuploadedxmlform' :
		TOOLBAR_content::_XMLUPLOADFORM();
		break;
	case 'instantiate':
		TOOLBAR_content::_INSTANTIATE();
		break;
	case 'editbusinessclasses':
		TOOLBAR_content::_UPDATEBUSINESSCLASS();
		break;
	default:
		TOOLBAR_content::_DEFAULT();
		break;
}