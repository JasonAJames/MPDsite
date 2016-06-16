<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.controller' );

class UTAdminController extends JController {

	function showAll() {
		JRequest::setVar('view', 'showall');
		parent::display();
	}
	
	function conf() {
		JRequest::setVar('view', 'conf');
		parent::display();
	}
	
	function clear() {
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		if(!UTAdminController::_getEntriesNum()) {
			UTAdminController::setRedirect('index.php?option=com_usertrace&task=showall', '[Clear] No entries available');
			return;
		}
		JRequest::setVar('view', 'clear');
		parent::display();
	}
	
	function export() {
		if(!UTAdminController::_getEntriesNum()) {
			UTAdminController::setRedirect('index.php?option=com_usertrace&task=showall', '[Export] No entries available');
			return;
		}
		JRequest::setVar('view', 'export');
		parent::display();
	}
	
	function saveconf() {
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$varname = 'showid';
		$$varname = JRequest::getVar($varname, '', 'post', 'string', JREQUEST_ALLOWRAW);
		if($$varname != '') UTAdminController::_updateCParam($varname, $$varname);
		$varname = 'showuserid';
		$$varname = JRequest::getVar($varname, '', 'post', 'string', JREQUEST_ALLOWRAW);
		if($$varname != '') UTAdminController::_updateCParam($varname, $$varname);
		$varname = 'showusername';
		$$varname = JRequest::getVar($varname, '', 'post', 'string', JREQUEST_ALLOWRAW);
		if($$varname != '') UTAdminController::_updateCParam($varname, $$varname);
		$varname = 'showip';
		$$varname = JRequest::getVar($varname, '', 'post', 'string', JREQUEST_ALLOWRAW);
		if($$varname != '') UTAdminController::_updateCParam($varname, $$varname);
		$varname = 'showagent';
		$$varname = JRequest::getVar($varname, '', 'post', 'string', JREQUEST_ALLOWRAW);
		if($$varname != '') UTAdminController::_updateCParam($varname, $$varname);
		$varname = 'showurl';
		$$varname = JRequest::getVar($varname, '', 'post', 'string', JREQUEST_ALLOWRAW);
		if($$varname != '') UTAdminController::_updateCParam($varname, $$varname);
		$varname = 'showref';
		$$varname = JRequest::getVar($varname, '', 'post', 'string', JREQUEST_ALLOWRAW);
		if($$varname != '') UTAdminController::_updateCParam($varname, $$varname);
		$varname = 'showtime';
		$$varname = JRequest::getVar($varname, '', 'post', 'string', JREQUEST_ALLOWRAW);
		if($$varname != '') UTAdminController::_updateCParam($varname, $$varname);
		
		UTAdminController::setRedirect('index.php?option=com_usertrace&task=conf', 'Configuration saved');
		return;
	}
	
	function _updateCParam($cparamname, $newvalue, $note=null) {
		$db =& JFactory::getDBO();
		
		// Update notes if different from null
		if($note!=null) {
			$note = ", note = '".$note."'";
		}
		$query = "UPDATE  #__usertrace_config SET value = '$newvalue' $note WHERE name = '$cparamname';";
		$db->setQuery( $query );
		
		if(!$db->query()) {
			UTAdminController::setRedirect('index.php?option=com_usertrace&task=conf', 'Error in updating configuration parameter', 'error');
			return;
		}
	}
	
	function _loadCParamValue($cparamname) {
		$db =& JFactory::getDBO();
		$query = "SELECT value FROM #__usertrace_config WHERE name = '$cparamname';";
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		
		foreach ( $rows as $row ) {
			return $row->value;
		}
		
		return false;
	}
	
	function clearAllData() {
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$db =& JFactory::getDBO();
		$query = "TRUNCATE TABLE #__usertrace;";
		$db->setQuery( $query );
		if($db->query()) {
			UTAdminController::setRedirect('index.php?option=com_usertrace&task=clear', 'All Data Cleared');
			return;
		} else {
			UTAdminController::setRedirect('index.php?option=com_usertrace&task=clear', 'Error clearing data', 'error');
			return;
		}
	}
	
	function exportCsv() {
		JRequest::checkToken() or jexit( 'Invalid Token' );
		$rows = UTAdminController::_getAllEntries();
		
		$sep_char = UTAdminController::_sepChar(JRequest::getVar('sep_char', '', 'post', 'string', JREQUEST_ALLOWRAW)); // Default is ';'
		$newline_char = UTAdminController::_newlineChar(JRequest::getVar('newline_char', '', 'post', 'string', JREQUEST_ALLOWRAW)); // Default is '\n'
		$compression = JRequest::getVar('compression', '', 'post', 'string', JREQUEST_ALLOWRAW); // Default is 'file not zipped'
		
		$out = "";
		$vTitle = true;
		foreach($rows as $r) {
			if(!$vTitle) {
				foreach($r as $key => $value) {
					$out .= '"'.$value.'"'.$sep_char;
				}
				$out .=  $newline_char;
			} else {
				$title = "";
				$content = "";
				foreach($r as $key => $value) {
					$title .= '"'.strtoupper($key).'"'.$sep_char;
					$content .= '"'.$value.'"'.$sep_char;
				}
				$out .=  $title.$newline_char.$content.$newline_char;
				$vTitle = false;
			}
		}
		
		if($compression != "") {
			UTAdminController::_compressFile($out, $compression);
		} else {
			header("Content-type: application/octet-stream"); 
			header("Content-Disposition: attachment; filename=utdata_".date("Y-m-d_H-i").".csv"); 
			header("Pragma: no-cache"); 
			header("Expires: 0");		
			echo $out;
		}
		
		exit();
	}
	
	function _compressFile($content, $cType) {
		require_once(JPATH_COMPONENT_ADMINISTRATOR.DS."views".DS."_shared".DS."lib".DS."archive.php");
		
		$csv_file = JPATH_COMPONENT_ADMINISTRATOR.DS."files".DS."utdata_".date("Y-m-d_H-i").".csv";

		$handle = fopen($csv_file, 'w');
		fwrite($handle, $content);
		fclose($handle);
		
		$cfile = null;
		if($cType=="ZIP") {
			$cfile = new zip_file("utdata_".date("Y-m-d_H-i").".zip"); 
		} else if($cType=="TAR") {
			$cfile = new tar_file("utdata_".date("Y-m-d_H-i").".tar"); 
		} else if($cType=="GZIP") {
			$cfile = new gzip_file("utdata_".date("Y-m-d_H-i").".tgz");
		}
		
		$cfile->set_options(array('inmemory' => 1, 'storepaths' => 0)); 
		$cfile->add_files(array($csv_file));
		$cfile->create_archive();
		$cfile->download_file();
		unlink($csv_file);
	}
	
	function _getAllEntries() {
		$db =& JFactory::getDBO();
		$query = "SELECT * FROM #__usertrace";
		$db->setQuery( $query );

		return $db->loadObjectList();
	}
	
	function _getEntriesNum() {
		$db =& JFactory::getDBO();
		$query = "SELECT COUNT(id) AS enum FROM #__usertrace";
		$db->setQuery( $query );
		$rows = $db->loadObjectList();
		foreach ( $rows as $row ) {
			return $row->enum;
		}
		return false;
	}
	
	function _newlineChar($newline_char) {
		if($newline_char=="GEN") return "\n"; 
		else if($newline_char=="WIN") return "\r\n"; 
		else if ($newline_char=="DAR") return "\r";
		else return "\n";
	}
	
	function _sepChar($sep_char) {
		if ($sep_char==";") return ";";
		else if ($sep_char==",") return ",";
		else if ($sep_char=="TAB") return "\t";
		else return ";";
	}
}