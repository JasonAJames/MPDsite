<?php 
defined( '_JEXEC' ) or die( 'Restricted access' );

// ensure user has access to this function
JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');
require_once( JApplicationHelper::getPath( 'admin_html' ) ); 

switch($task) {
	case "save":
	   saveConfiguration($option);
	break;
    case "help":
       help($option);
    break;
    case "settings":
       settings($option);
    break;
    case "settings_add":
       settings_add($option);
    break;
    case "settings_add_save":
       settings_add_save($option);
    break;
    case "settings_delete":
        settings_delete($option);
    break;
    case "settings_apply":
       settings_save($option,2);
    break;
    case "settings_save":
       settings_save($option);
    break;
    case "standard_search":
       standard_search($option);
    break;
    case "standard_search_save":
       standard_search_save($option);
    break;
    case "standard_search_apply":
       standard_search_save($option,2);
    break;
    case "advanced_search":
       advanced_search($option);
    break;
    case "advanced_search_save":
       advanced_search_save($option);
    break;
    case "advanced_search_apply":
       advanced_search_save($option,2);
    break;
    case "all_locations":
       all_locations($option);
    break;
    case "all_locations_save":
       all_locations_save($option);
    break;
    case "all_locations_apply":
       all_locations_save($option,2);
    break;
    case "add_locations":
       add_locations($option);
    break;
    case "list_locations":
       list_locations($option);
    break;
    case "list_locations_save":
       list_locations_save($option);
    break;
    case "list_locations_apply":
       list_locations_save($option,2);
    break;   
    case "css_styles":
       css_styles($option);
    break; 
    case "css_styles_save":
        css_styles_save($option,1);
    break;
    case "css_styles_apply":
       css_styles_save($option,2);
    break; 
    case "location_admin":
       location_admin($option);
    break;     
	default:
	 control($option);
	break;
}

   
function control($option){
    HTML_xtremelocator::control($option);
}
function settings($option){
    $database =&JFactory::getDBO();
    $database->setQuery("SELECT * FROM #__xtremelocator_config WHERE type=1"  );
    $rows = $database -> loadObjectList();
    if ($database -> getErrorNum()) {
        echo $database -> stderr();
        return false;
    }  
    $fields=getAllFields();
        
    HTML_xtremelocator::settings($option,$rows[0],$fields);
}
function settings_save($option,$type=1){
    global $mainframe;
    $database =&JFactory::getDBO();
    $row =&JTable ::getInstance('xtremelocator_config', 'Table');    
    $post = JRequest::get( 'post' , JREQUEST_ALLOWRAW ); 
    if(!isset($post['show_slogan'])){
        $post['show_slogan']=0;
    }
    
    if (!$row -> bind($post)) {
        echo "<script> alert('"
            .$row -> getError()
            ."'); window.history.go(-1); </script>\n";
        exit();
    } 
    if (!$row -> store()) {
        echo "<script> alert('"
            .$row -> getError()
            ."'); window.history.go(-1); </script>\n";
        exit(); 
    }
   
    if(count($post['enabled'])>0){
        $keys=array_keys($post['enabled']);
    }else{
        $keys=array(0);
    }
       
    $database->setQuery(" UPDATE `#__xtremelocator_fields` SET enabled=0 WHERE id NOT IN (".implode(',', $keys).")");
    $database->query();    
    $database->setQuery(" UPDATE `#__xtremelocator_fields` SET enabled=1 WHERE id IN (".implode(',', $keys).")");
    $database->query(); 
    
    if($type==1){
        $mainframe->redirect( "index2.php?option=".$option, JText::_('CHANGES SAVED') ); 
    }else{
        $mainframe->redirect( "index.php?option=com_xtremelocator&task=settings", JText::_('CHANGES SAVED') ); 
    }   
        
}
function standard_search($option){    
    $database =&JFactory::getDBO();
    $database->setQuery("SELECT * FROM #__xtremelocator_config WHERE type=2 OR type=1"  );
    $rows = $database -> loadObjectList();
    if ($database -> getErrorNum()) {
        echo $database -> stderr();
        return false;
    }  
    $fields=getfieldLayout(2,1);
    $fields_detailed=getfieldLayout(2,2);
    $afields=getAllFields();
    HTML_xtremelocator::standard_search($option,$rows[0],$rows[1],$fields,$fields_detailed,$afields);
}
function standard_search_save($option,$type=1){
    global $mainframe;
    $database =&JFactory::getDBO();
    $row =&JTable ::getInstance('xtremelocator_config', 'Table');    
    $post = JRequest::get( 'post' , JREQUEST_ALLOWRAW );      
    $post=saveLayoutData($post,2);
    if (!$row -> bind($post)) {
        echo "<script> alert('"
            .$row -> getError()
            ."'); window.history.go(-1); </script>\n";
        exit();
    } 
    if (!$row -> store()) {
        echo "<script> alert('"
            .$row -> getError()
            ."'); window.history.go(-1); </script>\n";
        exit(); 
    }
    if($type==1){
        $mainframe->redirect( "index2.php?option=".$option, JText::_('CHANGES SAVED') ); 
    }else{
        $mainframe->redirect( "index.php?option=com_xtremelocator&task=standard_search".(isset($_POST['t'])?"&t=".$_POST['t']:"").(isset($_POST['sort_by'])?"&sort_by=".$_POST['sort_by']:""), JText::_('CHANGES SAVED') ); 
    } 
}
function advanced_search($option){
    $database =&JFactory::getDBO();
    $database->setQuery("SELECT * FROM #__xtremelocator_config WHERE type=3 OR type=1"  );
    $rows = $database -> loadObjectList();
    if ($database -> getErrorNum()) {
        echo $database -> stderr();
        return false;
    }  
    $fields=getfieldLayout(3,1);
    $fields_detailed=getfieldLayout(3,2);
    $afields=getAllFields();
    HTML_xtremelocator::advanced_search($option,$rows[0],$rows[1],$fields,$fields_detailed,$afields);
}
function advanced_search_save($option,$type=1){
    global $mainframe;
    $database =&JFactory::getDBO();
    $row =&JTable ::getInstance('xtremelocator_config', 'Table');    
    $post = JRequest::get( 'post' , JREQUEST_ALLOWRAW );      
    $post=saveLayoutData($post,3);
    if (!$row -> bind($post)) {
        echo "<script> alert('"
            .$row -> getError()
            ."'); window.history.go(-1); </script>\n";
        exit();
    } 
    if (!$row -> store()) {
        echo "<script> alert('"
            .$row -> getError()
            ."'); window.history.go(-1); </script>\n";
        exit(); 
    }
    
    if($type==1){
        $mainframe->redirect( "index2.php?option=".$option, JText::_('CHANGES SAVED') ); 
    }else{
        $mainframe->redirect( "index.php?option=com_xtremelocator&task=advanced_search".(isset($_POST['t'])?"&t=".$_POST['t']:"").(isset($_POST['sort_by'])?"&sort_by=".$_POST['sort_by']:""), JText::_('CHANGES SAVED') ); 
    }       
}
function all_locations($option){
    $database =&JFactory::getDBO();
    $database->setQuery("SELECT * FROM #__xtremelocator_config WHERE type=5 OR type=1"  );
    $rows = $database -> loadObjectList();
    if ($database -> getErrorNum()) {
        echo $database -> stderr();
        return false;
    }  
    HTML_xtremelocator::all_locations($option,$rows[0],$rows[1]);
}
function all_locations_save($option,$type){
     global $mainframe;
    $database =&JFactory::getDBO();
    $row =&JTable ::getInstance('xtremelocator_config', 'Table');    
    $post = JRequest::get( 'post' , JREQUEST_ALLOWRAW ); 
    if($post['lincable_field']==""){
        $post['lincable_field']=";";
    }
    if (!$row -> bind($post)) {
        echo "<script> alert('"
            .$row -> getError()
            ."'); window.history.go(-1); </script>\n";
        exit();
    } 
    if (!$row -> store()) {
        echo "<script> alert('"
            .$row -> getError()
            ."'); window.history.go(-1); </script>\n";
        exit(); 
    }
    if($type==1){
        $mainframe->redirect( "index2.php?option=".$option, JText::_('CHANGES SAVED') ); 
    }else{
        $mainframe->redirect( "index.php?option=com_xtremelocator&task=all_locations".(isset($_POST['t'])?"&t=".$_POST['t']:"").(isset($_POST['sort_by'])?"&sort_by=".$_POST['sort_by']:""), JText::_('CHANGES SAVED') ); 
    }     
}
function css_styles($option){
    $database =&JFactory::getDBO();
    $database->setQuery("SELECT * FROM #__xtremelocator_css"  );
    $rows = $database -> loadObjectList();
    if ($database -> getErrorNum()) {
        echo $database -> stderr();
        return false;
    }  
    HTML_xtremelocator::css_styles($option,$rows);
}
function css_styles_save($option,$type){
     global $mainframe;
    $database =&JFactory::getDBO();        
    $post = JRequest::get( 'post' , JREQUEST_ALLOWRAW );
    foreach ($post['xl'] as $nm=>$css){        
        $database->setQuery("UPDATE #__xtremelocator_css SET `class` = '".$css."' WHERE `id` =".$nm);
        $database -> query();       
    } 
     $folder=substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], "administrator/index.php"));
    $cssFile = $folder."components/com_xtremelocator/css/xtremelocator_pub.css";    
    $myFile = "testFile.txt";
    $fh = fopen($cssFile, 'w') or die("can't open file");
    $stringData = $_POST["css_source"];
    fwrite($fh, $stringData);   
    fclose($fh);
    if($type==1){
        $mainframe->redirect( "index2.php?option=".$option, JText::_('CHANGES SAVED') ); 
    }else{
        $mainframe->redirect( "index.php?option=com_xtremelocator&task=css_styles", JText::_('CHANGES SAVED') ); 
    }     
}
function add_locations($option){
    
}
function list_locations($option){
    $database =&JFactory::getDBO();
    $database->setQuery("SELECT * FROM #__xtremelocator_config WHERE type=4 OR type=1"  );
    $rows = $database -> loadObjectList();
    if ($database -> getErrorNum()) {
        echo $database -> stderr();
        return false;
    }  
    $fields=getfieldLayout(4,1);
    $fields_detailed=getfieldLayout(4,2);
    $afields=getAllFields();
    HTML_xtremelocator::list_locations($option,$rows[0],$rows[1],$fields,$fields_detailed,$afields);
}
function list_locations_save($option,$type){
    global $mainframe;
    $database =&JFactory::getDBO();
    $row =&JTable ::getInstance('xtremelocator_config', 'Table');    
    $post = JRequest::get( 'post' , JREQUEST_ALLOWRAW );      
    $post=saveLayoutData($post,4);
    if (!$row -> bind($post)) {
        echo "<script> alert('"
            .$row -> getError()
            ."'); window.history.go(-1); </script>\n";
        exit();
    } 
    if (!$row -> store()) {
        echo "<script> alert('"
            .$row -> getError()
            ."'); window.history.go(-1); </script>\n";
        exit(); 
    }
    
     if($type==1){
        $mainframe->redirect( "index2.php?option=".$option, JText::_('CHANGES SAVED') ); 
    }else{
        $mainframe->redirect( "index.php?option=com_xtremelocator&task=list_locations".(isset($_POST['t'])?"&t=".$_POST['t']:"").(isset($_POST['sort_by'])?"&sort_by=".$_POST['sort_by']:""), JText::_('CHANGES SAVED') ); 
    }     
    }
    function settings_add($option){
        $rw='';
        if(isset($_REQUEST['id'])){
            $database =&JFactory::getDBO();
            $database->setQuery("SELECT * FROM #__xtremelocator_fields WHERE id=".$_REQUEST['id'] );
            $rows = $database -> loadObjectList();
            if ($database -> getErrorNum()) {
                echo $database -> stderr();
                return false;
            }  
            $rw=$rows[0];
        }
        HTML_xtremelocator::settings_add($option,$rw);
    }
    function settings_add_save($option){
        global $mainframe;
        $database =&JFactory::getDBO();
        $row =&JTable ::getInstance('xtremelocator_fields', 'Table');    
        $post = JRequest::get( 'post' , JREQUEST_ALLOWRAW );       
        if (!$row -> bind($post)) {
            echo "<script> alert('"
                .$row -> getError()
                ."'); window.history.go(-1); </script>\n";
            exit();
        } 
        if (!$row -> store()) {
            echo "<script> alert('"
                .$row -> getError()
                ."'); window.history.go(-1); </script>\n";
            exit(); 
        }        
        $mainframe->redirect( "index.php?option=com_xtremelocator&task=settings&option=".$option, JText::_('FIELD SAVED') ); 
    }
    function settings_delete($option){
        
        global $mainframe;        
        if(count($_POST['remove']>0)){
            $ids=implode(',',array_keys($_POST['remove']));
            $database =&JFactory::getDBO();
            $database->setQuery("DELETE FROM #__xtremelocator_fields WHERE id in (".$ids.")"  );
            $database -> query();
       }
       $mainframe->redirect( "index.php?option=com_xtremelocator&task=settings&option=".$option, JText::_('FIELDS REMOVED') ); 
    }
    function getfieldlayout($fid,$type){
        $database =&JFactory::getDBO();
        if(!isset($_GET['sort_by'])||$_GET['sort_by']=="field_name"){
            $sort_by='fl.field_name';
        }else{
            $sort_by="layouts.".$_GET['sort_by'];
        }
        $database->setQuery("SELECT * FROM #__xtremelocator_fields AS fl LEFT JOIN #__xtremelocator_layouts AS layouts ON fl.id=layouts.field_id WHERE layouts.layout_id='".$fid."' AND layouts.type=".$type." AND fl.enabled=1 ORDER BY fl.enabled DESC, ".$sort_by." ASC " );
        $rows = $database -> loadObjectList();
        $a=array();
        foreach ($rows as $row){
            $a[$row->id]=$row;
        }        
        $database->setQuery("SELECT * FROM #__xtremelocator_fields AS fl WHERE fl.id NOT IN (SELECT field_id from #__xtremelocator_layouts AS layouts WHERE layouts.layout_id='".$fid."' AND layouts.type=".$type.") AND fl.enabled=1");
        $rows = $database -> loadObjectList();         
        foreach ($rows as $row){
            $row->layout_id=$fid;
            $row->type=$type;
            $row->visible=0;
            $row->show_title=0;
            $row->order=0;
            $row->lincable=0;            
            $a[$row->id]=$row;
        }    
        return $a;
    }
    function getAllFields(){
        $database =&JFactory::getDBO();
        $database->setQuery("SELECT * FROM #__xtremelocator_fields"  );
        $fields = $database -> loadObjectList();
        if ($database -> getErrorNum()) {
            echo $database -> stderr();
            return false;
        }  
        return $fields;
    }
    function saveLayoutData($results,$lid){
            $visible=$results['visible'];
            $show_title=$results['title'];
            $order=$results['order'];
            unset($results['visible']);
            unset($results['title']);
            unset($results['order']);
            $database =&JFactory::getDBO();
            $database->setQuery("DELETE  FROM #__xtremelocator_layouts WHERE layout_id=".$lid);
            $database->query(); 
            $fields=getAllFields();
            foreach($fields as $field){
                $database->setQuery("INSERT INTO `jos_xtremelocator_layouts` ( `field_id` , `layout_id` , `type` ,  `visible` , `show_title` , `order` , `lincable` ) VALUES ( '".$field->id."', '".$lid."', '1', '".(isset($visible['1_'.$lid.'_'.$field->id])?1:0)."', '".(isset($show_title['1_'.$lid.'_'.$field->id])?1:0)."', '".($order['1_'.$lid.'_'.$field->id]>0?$order['1_'.$lid.'_'.$field->id]:$field->id)."', '".($results['lincable']==$field->id?1:0)."' )"); 
                $database->query(); 
                
                $database->setQuery("INSERT INTO `jos_xtremelocator_layouts` ( `field_id` , `layout_id` , `type` ,  `visible` , `show_title` , `order` , `lincable` ) VALUES ( '".$field->id."', '".$lid."', '2', '".(isset($visible['2_'.$lid.'_'.$field->id])?1:0)."', '".(isset($show_title['2_'.$lid.'_'.$field->id])?1:0)."', '".($order['2_'.$lid.'_'.$field->id]>0?$order['2_'.$lid.'_'.$field->id]:$field->id)."', '".($results['lincable']==$field->id?1:0)."' )"); 
                $database->query(); 
            }            
            unset($results['lincable']);         
        return $results;
    }
    function location_admin($options){
        HTML_xtremelocator::location_admin($options);
    }
    function help($options){
         HTML_xtremelocator::help($options);
    }
?>