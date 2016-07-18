<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );
require_once( JPATH_COMPONENT.DS.'controller.php' );

class UserTraceController extends JController {
	
	function showsec() {
		$user =& JFactory::getUser();
		$id = $user->get('id');
		if($id <= 0) {
			$this->setRedirect('index.php', 'Authentication required', 'error');
			return false;
		} else {
			JRequest::setVar('view', 'showsec');
			parent::display();
		}
	}
	
	function showart() {
		$user =& JFactory::getUser();
		$id = $user->get('id');
		if($id <= 0) {
			$this->setRedirect('index.php', 'Authentication required', 'error');
			return false;
		} else {
			JRequest::setVar('view', 'showart');
			parent::display();
		}
	}
	
	function _getSections() {
		$db = & JFactory::getDBO();
		$query = "SELECT id, title FROM #__sections WHERE published = '1' ORDER BY ordering";
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		if ($db->getErrorNum()) {
			$this->setRedirect('index.php', 'Error reading Sections', 'error');
			return false;
		}
		$sections = null;
		foreach($rows as $row) {
			$sections["id"][] = $row->id;
			$sections["title"][] = $row->title;
		}
		
		if(is_array($sections)) {
			return $sections;
		}
		return false;
	}
	
	function _getArticles() {
		$db = & JFactory::getDBO();
		
		// Check section id
		$sid = mysql_real_escape_string(JRequest::getVar('sid', '', 'get', 'string', JREQUEST_ALLOWRAW));
		$query = "SELECT id, title FROM #__sections WHERE published = '1' AND id = '$sid'";
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		if(empty($rows)) {
			$this->setRedirect('index.php?option=com_usertrace&task=showsec', 'Section id is not valid', 'error');
			$this->redirect();
		}
		
		// Get Articles from section
		$query = "SELECT id, title, created, modified FROM #__content WHERE state = '1' AND sectionid = '$sid' ORDER BY modified DESC";
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		$articles = null;
		foreach($rows as $row) {
			$articles["id"][] = $row->id;
			$articles["title"][] = $row->title;
			$articles["created"][] = $row->created;
			$articles["modified"][] = $row->modified;
		}
		
		if(is_array($articles)) {
			return $articles;
		}
		return false;
	}
	
	function _getArticlesTrace() {
		$db = & JFactory::getDBO();
		$user =& JFactory::getUser();
		$id = $user->get('id');
		
		$query = "SELECT userid, url, MAX(time) as time FROM  #__usertrace WHERE userid = '$id' AND url LIKE '%option=com_content&view=article&id=%' GROUP BY url ORDER BY time";
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		$atrace["id"] = null;
		$atrace["time"] = null;
		
		// Get article ID and TIME from traces
		foreach($rows as $row) {
			$url = explode("&", $row->url);
			for($i=0; $i<sizeof($url); $i++) {
				$suburl = explode("=", $url[$i]);
				if(sizeof($suburl)==2) {
					if($suburl[0]=="id") {
						$pos = strrpos($suburl[1], ":");
						$id = null;
						if (is_bool($pos) && !$pos) {
							// index.php?option=com_content&view=article&id=46&...
							$id = $suburl[1];
						} else {
							// index.php?option=com_content&view=article&id=46:articletitle...
							$id = substr($suburl[1], 0, $pos);
						}
						$key = false;
						if(is_array($atrace["id"])) {
							$key = array_search($id, $atrace["id"]);
						}
						if(!$key) {
							$atrace["id"][] = $id;
							$atrace["time"][] = $row->time;
						} else {
							if(strtotime($row->time) > strtotime($atrace["time"][$key])) {
								$atrace["id"][$key] = $id;
								$atrace["time"][$key] = $row->time;
							}
						}
					}
				}
			}
		}
		return $atrace;
	}
	
	function _getSectionStatusArray($sectionid) {
		$db = & JFactory::getDBO();
		$user =& JFactory::getUser();
		$id = $user->get('id');
		
		$article_array = $this->_getArticlesTrace();
		
		$status_array = array( "read" => 0, "notread" => 0, "updated" => 0 );
		
		$query = "SELECT id, modified FROM #__content WHERE sectionid='$sectionid'";
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		
		if(!empty($article_array["id"])) {
			foreach($rows as $row) {
				$key = null;
				if(!$key = array_search($row->id, $article_array["id"])) {
					$status_array["notread"]++;
				} else if( strtotime($row->modified) > strtotime($article_array["time"][$key])) {
					$status_array["updated"]++;
				} else {
					$status_array["read"]++;
				}
			}
		} else {
			$status_array["notread"] = $status_array["notread"] + sizeof($rows);
		}
		
		return $status_array;
	}
	
	function _getSectionStatusHtml($statusname, $articlenum) {
		if($statusname=="read" && $articlenum > 0) {
			return ''; // No informations (article read)
		} else if($statusname=="notread" && $articlenum > 0) {
			return '<img src="components/com_usertrace/views/_shared/images/publish_x.png" />&nbsp;<font color="#C80000"><b>'.$articlenum.' Article(s) not read</b></font>';
		} else if($statusname=="updated" && $articlenum > 0) {
			return '<img src="components/com_usertrace/views/_shared/images/publish_y.png" />&nbsp;<font color="#FF9900"><b>'.$articlenum.' Article(s) updated</b></font>';
		}
		
	}
	
}