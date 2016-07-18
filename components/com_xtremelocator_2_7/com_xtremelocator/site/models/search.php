<?php
defined('_JEXEC') or die();

jimport('joomla.application.component.model');

class XtremelocatorModelSearch extends JModel
{
    function getAdvancedSearchConfig(){        
       $db =& JFactory::getDBO(); 
       $query = 'SELECT * FROM #__xtremelocator_config WHERE type=3';
       $db->setQuery( $query );
       $conf = $db->loadObjectList();          
       return $conf[0];
    }
    function getListingConfig(){        
       $db =& JFactory::getDBO(); 
       $query = 'SELECT * FROM #__xtremelocator_config WHERE type=4';
       $db->setQuery( $query );
       $conf = $db->loadObjectList();          
       return $conf[0];
    }
    function getAllLocationConfig(){        
       $db =& JFactory::getDBO(); 
       $query = 'SELECT * FROM #__xtremelocator_config WHERE type=5';
       $db->setQuery( $query );
       $conf = $db->loadObjectList();          
       return $conf[0];
    }
    function getSearchConfig(){        
       $db =& JFactory::getDBO(); 
       $query = 'SELECT * FROM #__xtremelocator_config WHERE type=2';
       $db->setQuery( $query );
       $conf = $db->loadObjectList();  
           
       return $conf[0];
    }
    function getGlobalConfig(){
        $db =& JFactory::getDBO(); 
       $query = 'SELECT * FROM #__xtremelocator_config WHERE type=1';
       $db->setQuery( $query );
       $conf = $db->loadObjectList();          
       return $conf[0];
    }
    function getCSS(){
       $database =&JFactory::getDBO();
       $database->setQuery("SELECT * FROM #__xtremelocator_css"  );
       $fields = $database -> loadObjectList();
       if ($database -> getErrorNum()) {
            echo $database -> stderr();
           return false;
       }
       $ff=array();  
       foreach ($fields as $field){
            $ff[$field->name]['name']=$field->name;
            $ff[$field->name]['class']=$field->class;
       }
     
       return $ff;
    }
    function getFields(){
       $database =&JFactory::getDBO();
       $database->setQuery("SELECT * FROM #__xtremelocator_fields WHERE enabled=1 "  );
       $fields = $database -> loadObjectList();
       if ($database -> getErrorNum()) {
            echo $database -> stderr();
           return false;
       }
       $ff=array();  
       foreach ($fields as $field){
            $ff[]=$field->field_name;
       }        
       $ff[]='_id';
      
       return $ff;
    }
    function getLayout($fid,$type){
        $database =&JFactory::getDBO();
        $database->setQuery("SELECT * FROM #__xtremelocator_layouts AS layouts LEFT JOIN #__xtremelocator_fields AS fl  ON fl.id=layouts.field_id WHERE layouts.layout_id='".$fid."' AND layouts.type=".$type." AND fl.enabled=1 AND layouts.visible=1 ORDER BY `layouts`.`order` ASC " );
        $rows = $database -> loadObjectList();
        $fields=array();
        foreach($rows as $row){
           $fields[$row->field_name]=array(); 
           $fields[$row->field_name]['field_name']=$row->field_name;
           $fields[$row->field_name]['show_title']=$row->show_title;
           $fields[$row->field_name]['lincable']=$row->lincable;
        }
        
        return $fields;
    }
    
    function getCountries(){
        return array("0"=>"USA","1"=>"Canada");
    }
    function getLocations($fields,$type){
        if($type==2){
            $searchC=$this->getSearchConfig();
        }
        if($type==3){
            $searchC=$this->getAdvancedSearchConfig();
        }
        if($type==4){
            $searchC=$this->getListingConfig();
        }
        if($type==5){
            $searchC=$this->getAllLocationConfig();
        }
        $sysFields=array('option','view','jfcookie','Itemid','format');
        $globalC=$this->getGlobalConfig();
        
        $allColumns = implode(",", $this->getFields());
        //print_r($allColumns);
        $searchOptions=array(
            "sid" => $globalC->site_id,
            "type" => "advanced",
            "format" => "CSV",
            "csv_columns" => $allColumns                        
        );
        $c = curl_init("http://app.xtremelocator.com/visitor/findLocations.php");
        foreach ($_REQUEST as $k => $v)
        {                
                    if(!in_array($k,$sysFields)){
                        $searchOptions[$k] = $v;
                    }
               
        }       
        $fields = "";
        foreach ($searchOptions as $name => $val)
        {
            if (strlen($fields) > 0)
            {
                $fields .= "&";
            }
            $fields .= $name."=".urlencode($val);
        }   
        //print_r($searchOptions);    
        curl_setopt($c, CURLOPT_POST, 1);
        curl_setopt($c, CURLOPT_POSTFIELDS, $fields);
        ob_start();
        curl_exec($c);
        $response = ob_get_contents();  
        ob_end_clean();         
        //print_r($fields);
        
        $rows = explode("\n", trim($response));
        $r = array();
        $ca = explode(",", $allColumns);
        foreach ($rows as $row)
        {
            if (strstr($row, '"'))
            {
                $ce = explode(",", $row);
                $f = array();
                $z = array();
                $field = "";
                foreach ($ce as $v)
                {
                    $field .= $v;
                    if ($field[0] == '"' && (substr($field, strlen($field)-1, 1) != '"' || strlen($field) == 1))
                    {
                        $field .= ",";
                    }
                    else
                    {
                        $field = str_replace("\"\"", "\"", $field);
                        if ($field[0] == '"')
                        {
                            $field = substr($field, 1, strlen($field) - 2);
                        }
                        $f[] = $field;
                        $field = "";
                    }
                }
                foreach ($f as $k => $v)
                {
                    $z[ucwords($ca[$k])] = $f[$k];
                }
                $r[] = $z;
            }
        }      
        $_SESSION["xl_results"] = $r;
        $_SESSION["pos"] = 0;
        //print_r($_SESSION["xl_results"]);
    }
}
