<?php

defined('_JEXEC') or die();

require_once (JPATH_COMPONENT.DS.'view.php');


class XtremelocatorViewSearch extends XtremelocatorView
{
	function display($tpl = null)
	{
		global $mainframe, $option;
                
		$model = &$this->getModel('search');       
        $conf = $model->getSearchConfig();              
        $this->assignRef( 'conf',$conf);
        
        $gconf = $model->getGlobalConfig();              
        $this->assignRef( 'gconf',$gconf);
        
        $list_fields=$model->getLayout(2,1);        
        $this->assignRef( 'list_fields',$list_fields);
        
        $detailed_fields=$model->getLayout(2,2);
        $this->assignRef( 'detailed_fields',$detailed_fields);
       
        $css=$model->getCSS();
        $this->assignRef( 'css',$css);
        
        if($conf->search_type==0){   
            $countriesList=$model->getCountries();
            $countries=array();
            foreach ($countriesList as $cid=>$country){
                $countries[] = JHTML::_('select.option',  $cid, JText::_($country ) );
            } 
            $cList= JHTML::_('select.genericlist',   $countries, 'country', 'id="xl_search_country"', 'value', 'text', ($_SESSION["xl_search"]['country']>"0"?$_SESSION["xl_search"]['country']:"0") );
            $this->assignRef('cList',$cList);       
        }
        
        if(count($_POST)>0){
            $model->getLocations($_REQUEST,2);
            $_SESSION["xl_search"] = $_POST;
        }
        
       
        
        $zip=isset($_SESSION["xl_search"]['zip'])?$_SESSION["xl_search"]['zip']:"";
        $distance=isset($_SESSION["xl_search"]['zip'])?$_SESSION["xl_search"]['zip']:"";
       
        $this->assignRef('zip',$zip);
        $this->assignRef('distance',$distance);
        
        //print_r($_SESSION["xl_results"]);
       	parent::display($tpl);
	}
}
?>
