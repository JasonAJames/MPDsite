<?php

defined('_JEXEC') or die();

require_once (JPATH_COMPONENT.DS.'view.php');
require_once(JPATH_COMPONENT.DS.'models'.DS.'search.php');

class XtremelocatorViewAdvanced extends XtremelocatorView
{
	function display($tpl = null)
	{
		global $mainframe, $option;

		
        $model=new XtremelocatorModelSearch; 
          
        $conf = $model->getAdvancedSearchConfig();              
        $this->assignRef( 'conf',$conf);
        
        $gconf = $model->getGlobalConfig();              
        $this->assignRef( 'gconf',$gconf);
      
        $list_fields=$model->getLayout(3,1);        
        $this->assignRef( 'list_fields',$list_fields);
        
        $detailed_fields=$model->getLayout(3,2);
        $this->assignRef( 'detailed_fields',$detailed_fields);
       
        $css=$model->getCSS();
        $this->assignRef( 'css',$css);
        
        if(count($_POST)>0){
            $model->getLocations($_REQUEST,2);
        }
         
       	parent::display($tpl);
	}
}
?>
