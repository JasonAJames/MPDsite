<div id="<?php echo $this->css['xl_search_form']['class'];?>">
<?php if($this->conf->describtion!=""){?> <div id="<?php echo $this->css['xl_form_message']['class'];?>"><?php echo $this->conf->describtion;?></div><?php }?>
<form id="<?php echo $this->css['searchForm']['class'];?>" action="<?php echo JRoute::_( 'index.php?option=com_xtremelocator&view=search');?>" method="post" name="searchForm">
<div class="<?php echo $this->css['xl_wraper']['class'];?>">
<label for="xl_search_zip" id="xl_search_zip_label" >
     <?php echo JText::_( 'ZIP' ); ?>:
    </label>
    <input type="text" name="zip" id="xl_search_zip"  value="<?php echo $this->zip;?>"/>
</div>
<?php if($this->conf->search_type==0){?>    
   <div class="<?php echo $this->css['xl_wraper']['class'];?>">
   <label for="country" id="xl_search_country_label">
     <?php echo JText::_( 'COUNTRY' ); ?>:
    </label>
    <?php echo $this->cList;?>
    </div>
<?php }elseif($this->conf->search_type==2){?>
   <div class="<?php echo $this->css['xl_wraper']['class'];?>">
    <label for="xl_search_distance" id="xl_search_distance_label" >
     <?php echo JText::_( 'DISTANCE' ); ?>:
    </label>
    <input type="text" name="distance" id="xl_search_distance"/> </div>
<?php }?>
<input type="hidden" name="option" value="com_xtremelocator" />
<input type="hidden" name="view" value="search" />
<input type="submit" value="<?php echo JText::_( 'SEARCH' ); ?>" id="<?php echo $this->css['xl_search_submit']['class'];?>" />
<?php if($this->conf->show_advanced_link==1){ echo '<div id="'.$this->css['xl_advanced_search_link']['class'].'"><a href="'.JRoute::_( 'index.php?option=com_xtremelocator&view=advanced').'">'. JText::_( 'ADVANCED SEARCH' ).'</a> </div>';}?>
<?php if($this->conf->show_all_location_link==1){ echo '<div id="'.$this->css['xl_all_locations_link']['class'].'"><a href="'.JRoute::_( 'index.php?option=com_xtremelocator&view=listing').'">'. JText::_( 'ALL LOCATIONS' ).'</a> </div>';}?>
<?php if($this->gconf->show_slogan==1){ echo '<div id="xl_powered_link"><a href="http://www.xtremelocator.com">'. JText::_( 'POWERED BY' ).'</a> </div>';}?>
</form>
</div>