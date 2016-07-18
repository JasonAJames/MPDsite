<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::stylesheet( 'xtremelocator_pub.css', '/components/com_xtremelocator/css/' );?>
<?php if($this->conf->describtion!=""){?> <div id="<?php echo $this->css['xl_form_message']['class'];?>"><?php echo $this->conf->describtion;?></div><?php }?>

<div id="<?php echo $this->css['xl_search_results']['class'];?>">
    <iframe width="<?php echo $this->conf->map_width_details;?>" height="<?php echo $this->conf->map_height_details;?>" scrolling="no" frameborder="0" hspace="0" vspace="0" marginheight="0" 'marginwidth="0" src="http://app.xtremelocator.com/visitor/googlemap.php?show=all&sid=<?php echo $this->gconf->site_id; ?>&_center=<?php echo $this->conf->center_coordinates;?>&zoom=<?php echo $this->conf->zoom_level;?>&width=<?php echo $this->conf->map_width_details;?>px&height=<?php echo $this->conf->map_height_details;?>px" name="mapContainer" id="mapContainer"></iframe>            
</div>
<?php if($this->conf->show_advanced_link==1){ echo '<div id="'.$this->css['xl_advanced_search_link']['class'].'"><a href="'.JRoute::_( 'index.php?option=com_xtremelocator&view=advanced').'">'. JText::_( 'ADVANCED SEARCH' ).'</a> </div>';}?>
<?php if($this->conf->show_all_location_link==1){ echo '<div id="'.$this->css['xl_all_locations_link']['class'].'"><a href="'.JRoute::_( 'index.php?option=com_xtremelocator&view=listing').'">'. JText::_( 'ALL LOCATIONS' ).'</a> </div>';}?>
<?php if($this->gconf->show_slogan==1){ echo '<div id="xl_powered_link"><a href="http://www.xtremelocator.com">'. JText::_( 'POWERED BY' ).'</a> </div>';}?>

