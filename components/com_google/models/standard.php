<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.model' );

class ModelGoogleStandard extends JModel
{
	var $_data = null;
	var $_id = null;
	
	function __construct()
	{
		global $mainframe;
				
		parent::__construct();
		$params =& $mainframe->getParams();
		$id = $params->get('id', 0);
		
		if(!$id)
		{
			$id = JRequest::getVar('id', 0);
		}

		$this->_id = $id;
	}
	
	
	/**
	 * Returns the query
	 * @return string The query to be used to retrieve the rows from the database
	 */
	function _buildQuery($id)
	{
		$query = 'SELECT a.*'
			. ' FROM #__google_destinations AS a, #__google AS b '
			. ' WHERE a.published=1 AND b.published=1 AND a.catid=b.id AND b.id='. (int) $id
			;
		return $query;
	}

	/**
	 * Retrieves the google data
	 * @return array Array of objects containing the data from the database
	 */
	function getData()
	{
		// Lets load the data if it doesn't already exist
		if (empty( $this->_data ))
		{
			$query = $this->_buildQuery($this->_id);
			$this->_data = $this->_getList( $query );
		}

		return $this->_data;
	}
	
	/**
	 * returns the category data
	 */
	function getCategoryData()
	{
		$db =& JFactory::getDBO();    
	    $query = ' SELECT * FROM #__google '.
				'  WHERE published=1 AND id = '. (int) $this->_id;		
	    $db->setQuery($query);
	    $results=$db->loadObject();
		
		if(!$results->published)
			{
				JError::raiseError( 404, "Invalid ID provided" );
			}

		return $results;
	}
	
	/**
	 * returns a icon list
	 */
	 function buildIcon($place){
		$files = array();
		$lists = array();
		$results = array();
		$path = $place;
		$handle = @opendir($path) or die("Unable to open folder");
		
		while (false !== ($file = readdir($handle))) {
			if (substr($file,-4) == ".png" && $file != "map_shadow.png")  {
				$files[] = $file;
			}
		  
		}
		closedir($handle);
		sort($files);
		foreach ($files as $file_get) {
			$results[] = $file_get;
		}    
		return $results;
	}
	
	
}

?>