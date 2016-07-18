<?php

defined('_JEXEC') or die();

require_once (JPATH_COMPONENT.DS.'view.php');
require_once(JPATH_COMPONENT.DS.'models'.DS.'search.php');

class XtremelocatorViewAlllocation extends XtremelocatorView
{
    function display($tpl = null)
    {
        global $mainframe, $option;

        
        $model=new XtremelocatorModelSearch; 
          
        $conf = $model->getAllLocationConfig();              
        $this->assignRef( 'conf',$conf);
        
        $gconf = $model->getGlobalConfig();              
        $this->assignRef( 'gconf',$gconf);
        
        $css=$model->getCSS();
        $this->assignRef( 'css',$css);
        $model->getLocations($_REQUEST,5);
        
         
        parent::display($tpl);
    }
}
?>
