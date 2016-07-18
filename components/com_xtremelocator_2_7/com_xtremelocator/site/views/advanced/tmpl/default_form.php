<div id="<?php echo $this->css['xl_search_form']['class'];?>">
<?php if($this->conf->describtion!=""){?> <div id="<?php echo $this->css['xl_form_message']['class'];?>"><?php echo $this->conf->describtion;?></div><?php }?>
<div id="xl_advanced_form_code"><?php echo $this->conf->form_code;?></div>
<?php if($this->conf->show_all_location_link==1){ echo '<div id="'.$this->css['xl_all_locations_link']['class'].'"><a href="'.JRoute::_( 'index.php?option=com_xtremelocator&view=listing').'">'. JText::_( 'ALL LOCATIONS' ).'</a> </div>';}?>
<?php if($this->gconf->show_slogan==1){ echo '<div id="xl_powered_link"><a href="http://www.xtremelocator.com">'. JText::_( 'POWERED BY' ).'</a> </div>';}?>
</div>

