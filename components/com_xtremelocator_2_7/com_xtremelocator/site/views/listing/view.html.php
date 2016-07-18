<?php

defined('_JEXEC') or die();

require_once (JPATH_COMPONENT.DS.'view.php');
require_once(JPATH_COMPONENT.DS.'models'.DS.'search.php');

class XtremelocatorViewListing extends XtremelocatorView
{
    function display($tpl = null)
    {
        global $mainframe, $option;

        
        $model=new XtremelocatorModelSearch; 
          
        $conf = $model->getListingConfig();              
        $this->assignRef( 'conf',$conf);
        
        $gconf = $model->getGlobalConfig();              
        $this->assignRef( 'gconf',$gconf);
        
        $list_fields=$model->getLayout(4,1);        
        $this->assignRef( 'list_fields',$list_fields);
        
        $detailed_fields=$model->getLayout(4,2);
        $this->assignRef( 'detailed_fields',$detailed_fields);
       
        $css=$model->getCSS();
        $this->assignRef( 'css',$css);
        
        $model->getLocations($_REQUEST,4);
        
         
        parent::display($tpl);
    }
}
?>
