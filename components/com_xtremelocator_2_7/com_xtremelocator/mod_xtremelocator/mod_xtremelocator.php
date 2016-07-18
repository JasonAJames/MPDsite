<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
$type = trim( $params->get( 'type', 'standard' ));
$advanced = intval( $params->get( 'advanced', '0' ));
$list = intval( $params->get( 'list', '0' ));
JHTML::stylesheet( 'xtremelocator_pub.css', '/components/com_xtremelocator/css/' );
function getModel()
    {
        if (!class_exists( 'XtremelocatorModelSearch' ))
        {
           
            $path = JPATH_SITE.DS.'components'.DS.'com_xtremelocator'.DS.'models'.DS.'search.php';
            $false = false;
                        
            if (file_exists( $path )) {
                require_once( $path );
                if (!class_exists( 'XtremelocatorModelSearch' )) {
                    JError::raiseWarning( 0, 'Model class XtremelocatorModelSearch not found in file.' );
                    return $false;
                }
            } else {
                JError::raiseWarning( 0, 'Model XtremelocatorModelSearch not supported. File not found.' );
                return $false;
            }
        }

        $model = new XtremelocatorModelSearch();
        return $model;
    }
    
$model=getModel();

if($type=="standard"){
    $config=$model->getSearchConfig();    
    ?>
    <form id="xl_mod_search_form" action="<?php echo JRoute::_( 'index.php?option=com_xtremelocator&view=search');?>" method="post" name="searchForm">
<div class="xl_mod_search_form_wrap">
<label for="xl_mod_search_zip" id="xl_mod_search_zip_label" >
     <?php echo JText::_( 'ZIP' ); ?>:
    </label>
    <input type="text" name="zip" id="xl_mod_search_zip"  value="<?php echo isset($_POST['zip'])?$_POST['zip']:"";?>"/>
</div>
<?php if($config->search_type==0){
        $countries=array();
        foreach ($countriesList as $cid=>$country){
            $countries[] = JHTML::_('select.option',  $cid, JText::_($country ) );
        }        
        
        if(count($_POST)>0){
            $model->getLocations($_REQUEST,2);
            $_SESSION["xl_search"] = $_POST;
        }
        
        $cList= JHTML::_('select.genericlist',   $countries, 'country', 'id="xl_mod_search_country"', 'value', 'text', ($_SESSION["xl_search"]['country']>"0"?$_SESSION["xl_search"]['country']:"0") );
    ?>    
   <div class="xl_mod_search_form_wrap">
   <label for="country" id="xl_mod_search_country_label">
     <?php echo JText::_( 'COUNTRY' ); ?>:
    </label>
    <?php echo $cList;?>
    </div>
<?php }elseif($config->search_type==2){?>
   <div class="xl_mod_search_form_wrap">
    <label for="xl_mod_search_distance" id="xl_search_distance_label" >
     <?php echo JText::_( 'DISTANCE' ); ?>:
    </label>
    <input type="text" name="distance" id="xl_mod_search_distance" value="<?php echo isset($_POST['distance'])?$_POST['distance']:"";?>"/> </div>
<?php }?>
<input type="hidden" name="option" value="com_xtremelocator" />
<input type="hidden" name="view" value="search" />
<input type="submit" value="<?php echo JText::_( 'SEARCH' ); ?>" id="xl_mod_search_submit" />
</form>
    <?php
}else{
    $config=$model->getAdvancedSearchConfig();
    ?><div id="xl_mod_advanced_form_code"><?php echo $config->form_code;?></div>
    <?php
}
?>
<?php if($advanced==1){ echo '<div id="xl_mod_advanced_search_link"><a href="'.JRoute::_( 'index.php?option=com_xtremelocator&view=advanced').'">'. JText::_( 'ADVANCED SEARCH' ).'</a> </div>';}?>
<?php if($list==1){ echo '<div id="xl_mod_all_locations_link"><a href="'.JRoute::_( 'index.php?option=com_xtremelocator&view=listing').'">'. JText::_( 'ALL LOCATIONS' ).'</a> </div>';}?>

