<?php
defined('_JEXEC') or die('Restricted access');

class menuxtremelocator{
	function control_menu() {
		$document =& JFactory::getDocument();
        $document->setTitle(JText::_( 'CONTROL TITLE' ));        
        JToolBarHelper::title( JText::_( 'CONTROL TITLE' ), 'xtremelocator' );
        
	}
    function settings_menu() {
        $document =& JFactory::getDocument();
        $document->setTitle(JText::_( 'SETTINGS' ));        
        JToolBarHelper::title( JText::_( 'SETTINGS' ), 'settings' );
         JToolBarHelper::custom( 'settings_apply', 'apply', 'apply', 'Apply',false);
        JToolBarHelper::custom( 'settings_delete', 'trash', 'trash', 'REMOVE FIELDS',false);
        JToolBarHelper::custom( 'settings_add', 'new', 'new', 'ADD FIELD',false);
        JToolBarHelper::custom( 'settings_save', 'save', 'save', 'Save',false);
        JToolBarHelper::cancel('control');
        JToolBarHelper::custom( 'http://www.delfi.lt', 'help', 'help', 'Help',false);
               
    }
    function settings_add_menu() {
        $document =& JFactory::getDocument();
        $document->setTitle(JText::_( 'SETTINGS' ));        
        JToolBarHelper::title( JText::_( 'SETTINGS' ), 'settings' );       
        JToolBarHelper::custom( 'settings_add_save', 'save', 'save', 'Save',false);
       JToolBarHelper::custom( 'settings', 'cancel', 'cancel', 'Cancel',false);
          JToolBarHelper::custom( 'help', 'help', 'help', 'Help',false);
        
    }
    function standard_search_menu() {
        $document =& JFactory::getDocument();
        $document->setTitle(JText::_( 'STANDARD SEARCH' ));        
        JToolBarHelper::title( JText::_( 'STANDARD SEARCH' ), 'search' );
        JToolBarHelper::custom( 'standard_search_apply', 'apply', 'apply', 'Apply',false);
        JToolBarHelper::custom( 'standard_search_save', 'save', 'save', 'Save',false);
        JToolBarHelper::cancel('control');
        JToolBarHelper::custom( 'help', 'help', 'help', 'Help',false);
        
    }
    function advanced_search_menu() {
        $document =& JFactory::getDocument();
        $document->setTitle(JText::_( 'ADVANCED SEARCH' ));        
        JToolBarHelper::title( JText::_( 'ADVANCED SEARCH' ), 'advanced_search' );
          JToolBarHelper::custom( 'advanced_search_apply', 'apply', 'apply', 'Apply',false);
        JToolBarHelper::custom( 'advanced_search_save', 'save', 'save', 'Save',false);
        JToolBarHelper::cancel('control');
          JToolBarHelper::custom( 'help', 'help', 'help', 'Help',false);
       
    }
    function all_locations_menu() {
        $document =& JFactory::getDocument();
        $document->setTitle(JText::_( 'ALL LOCATION MAP SETUP' ));        
        JToolBarHelper::title( JText::_( 'ALL LOCATION MAP SETUP' ), 'all_locations' );
        JToolBarHelper::custom( 'all_locations_apply', 'apply', 'apply', 'Apply',false);        
        JToolBarHelper::custom( 'all_locations_save', 'save', 'save', 'Save',false);
        JToolBarHelper::cancel('control');
         JToolBarHelper::custom( 'help', 'help', 'help', 'Help',false);
        
    }
    function add_locations_menu() {
        $document =& JFactory::getDocument();
        $document->setTitle(JText::_( 'PUBLIC REGISTRATION FORM SETUP' ));        
        JToolBarHelper::title( JText::_( 'PUBLIC REGISTRATION FORM SETUP' ), 'add_location' );
        JToolBarHelper::custom( 'all_locations_save', 'save', 'save', 'Save',false);
        JToolBarHelper::cancel('control');
         JToolBarHelper::custom( 'help', 'help', 'help', 'Help',false);
        
    }
    function list_locations_menu() {
        $document =& JFactory::getDocument();
        $document->setTitle(JText::_( 'LOCATION LISTING PAGE SETUP' ));        
        JToolBarHelper::title( JText::_( 'LOCATION LISTING PAGE SETUP' ), 'list_locations' );
        JToolBarHelper::custom( 'list_locations_apply', 'apply', 'apply', 'Apply',false);
        JToolBarHelper::custom( 'list_locations_save', 'save', 'save', 'Save',false);
        JToolBarHelper::cancel('control');
          JToolBarHelper::custom( 'help', 'help', 'help', 'Help',false);
        
    }
    function css_styles_menu() {
        $document =& JFactory::getDocument();
        $document->setTitle(JText::_( 'CSS STYLES SETUP' ));        
        JToolBarHelper::title( JText::_( 'CSS STYLES SETUP' ), 'css' );
        JToolBarHelper::custom( 'css_styles_apply', 'apply', 'apply', 'Apply',false);
        JToolBarHelper::custom( 'css_styles_save', 'save', 'save', 'Save',false);
        JToolBarHelper::cancel('control');
          JToolBarHelper::custom( 'help', 'help', 'help', 'Help',false);
        
    }
    function help_menu() {
        $document =& JFactory::getDocument();
        $document->setTitle(JText::_( 'HELP' ));        
        JToolBarHelper::title( JText::_( 'HELP' ), 'help' );               
    }
}
?>