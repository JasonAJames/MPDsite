<?php
/**
* @Copyright Copyright (C) 2010- Gary Teh Name1price.Com
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/

class TOOLBAR_content
{
	function _EDIT($edit)
	{
		$cid = JRequest::getVar( 'cid', array(0), '', 'array' );
		$cid = intval($cid[0]);

		$text = ( $edit ? JText::_( 'Edit' ) : JText::_( 'New' ) );

		JToolBarHelper::title( JText::_( 'Workflow' ).': <small><small>[ '. $text.' ]</small></small>', 'addedit.png' );
		//JToolBarHelper::preview( 'index.php?option=com_content&id='.$cid.'&tmpl=component', true );
		JToolBarHelper::save();
		JToolBarHelper::apply();
		if ( $edit ) {
			// for existing articles the button is renamed `close`
			JToolBarHelper::cancel( 'cancel', 'Close' );
		} else {
			JToolBarHelper::cancel();
		}
		JToolBarHelper::help( 'screen.content.edit' );
	}
/*
	function _ARCHIVE()
	{
		JToolBarHelper::title( JText::_( 'Archive Manager' ), 'addedit.png' );
		JToolBarHelper::unarchiveList();
		JToolBarHelper::custom( 'remove', 'delete.png', 'delete_f2.png', 'Trash', false );
		JToolBarHelper::help( 'screen.content.archive' );
	}
*/
	function _MOVE()
	{
		JToolBarHelper::title( JText::_( 'Move Postings' ), 'move_f2.png' );
		JToolBarHelper::custom( 'movesectsave', 'save.png', 'save_f2.png', 'Save', false );
		JToolBarHelper::cancel();
	}

	function _COPY()
	{
		JToolBarHelper::title( JText::_( 'Copy Postings' ), 'copy_f2.png' );
		JToolBarHelper::custom( 'copysave', 'save.png', 'save_f2.png', 'Save', false );
		JToolBarHelper::cancel();
	}

	function _INSTANTIATE(){
		JToolBarHelper::title( JText::_( 'Creating New Business Class'.': <small><small>[ '. $_REQUEST['boxchecked'].' ]</small></small>' ), 'article.png' );
		JToolBarHelper::custom( 'instantiated', 'save.png', 'save_f2.png', 'Instantiate', false );
		JToolBarHelper::cancel();
	}

	function _SHOWBUSINESSCLASSES(){
		JToolBarHelper::title( JText::_( 'Existing Business Classes' ), 'article.png' );
		JToolBarHelper::customX( 'deleteBusinessClasses', 'delete.png', 'delete_f2.png', 'Delete', false );

	}

	function _XMLUPLOADFORM(){
		JToolBarHelper::title( JText::_( 'Upload a new XML Workflow Document' ), 'article.png' );

	}

	function _DEFAULT()
	{
		global $filter_state;

		JToolBarHelper::title( JText::_( 'Simple Subscription Configuration' ), 'article.png' );
		/*
		if ($filter_state == 'A' || $filter_state == NULL) {
			JToolBarHelper::unarchiveList();
		}
		if ($filter_state != 'A') {
			JToolBarHelper::archiveList();
		}*/
		//JToolBarHelper::publishList();
		//JToolBarHelper::unpublishList();
		//JToolBarHelper::customX( 'movesect', 'move.png', 'move_f2.png', 'Move' );
		//JToolBarHelper::customX( 'instantiate', 'new.png', 'new_f2.png', 'Create' );
		//JToolBarHelper::trash();
		//JToolBarHelper::editListX();
		//JToolBarHelper::addNewX();
		//JToolBarHelper::preferences('com_content', '550');
		//JToolBarHelper::help( 'screen.content' );
		JToolBarHelper::custom( 'saveconfigurations', 'save.png', 'save_f2.png', 'Update', false );
	}

	function _UPDATEBUSINESSCLASS(){
		JToolBarHelper::title( JText::_( 'Updating New Business Class'.': <small><small>id => [ '. $_REQUEST['id'].' ]</small></small>' ), 'article.png' );
		JToolBarHelper::custom( 'savebusinessclassupdate', 'save.png', 'save_f2.png', 'Update', false );
		JToolBarHelper::customX( 'deleteBusinessClasses', 'delete.png', 'delete_f2.png', 'Delete', false );
		JToolBarHelper::customX( 'showbusinessclasses', 'cancel.png', 'cancel_f2.png', 'Cancel', false );
	}
}