<?php $editor =& JFactory::getEditor();?>
<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
<?php if(isset($_GET['t'])){ echo '<input type="hidden" name="t" value="'.$_GET['t'].'"/>';}?>
    <?php if(isset($_GET['sort_by'])){ echo '<input type="hidden" name="sort_by" value="'.$_GET['sort_by'].'"/>';}?>
<table class="adminform">
    <tr>
        <td><?php echo JText::_('SEARCH TYPE');?>:
        </td><td width="80%"><?php echo makeList('search_type',array( JText::_('ZIP')=>'1', JText::_('ZIP&DISTANCE')=>'2',JText::_('ZIP&COUNTRY')=>'0'),$row->search_type);?>
        </td>    
       
    </tr>
    
    <tr>
        <td><?php echo JText::_('MESSAGE');?>:
        </td>
        <td><?php echo $editor->display( 'describtion',  $row->describtion , 600, 250, '50', '15' )."\n" ; ?>
        </td>
       
    </tr>
    
    <tr>
        <td><strong><?php echo JText::_('RESULT PAGE SETUP');?></strong>
        </td>
        <td>
        </td>
       
    </tr>   
    <tr>
        <td><?php echo JText::_('RESULT TYPE');?>:
        
        </td><td>
        <input name="result_type_list" type="radio" value="1" <?php echo ($row->result_type_list==1)?'checked="checked"':''; ?>/><?php echo JText::_('TEXT WITH MAP-IT LINK');?>
          <input name="result_type_list" type="radio" value="2" <?php echo ($row->result_type_list==2)?'checked="checked"':''; ?>/><?php echo JText::_('TEXT&MAP');?>
          <input name="result_type_list" type="radio" value="3" <?php echo ($row->result_type_list==3)?'checked="checked"':''; ?>/> <?php echo JText::_('TEXT ONLY');?> 
        
       </td> 
    </tr> 
    <tr>
        <td><?php echo JText::_('TEXT BLOCK WIDTH');?>:
        </td><td> <input type="text" size="10" maxsize="100" name="text_width_list" value="<?php echo $row->text_width_list;?>" />
        
        </td>
       
    </tr>  
     <tr>
        <td><?php echo JText::_('TEXT BLOCK HEIGHT');?>:
        </td><td> <input type="text" size="10" maxsize="100" name="text_height_list" value="<?php echo $row->text_height_list;?>" />
        
        </td>
       
    </tr>    
    <tr>
        <td><?php echo JText::_('MAP WIDTH');?>:
        </td><td> <input type="text" size="10" maxsize="100" name="map_width_list" value="<?php echo $row->map_width_list;?>" />
        
        </td>
       
    </tr> 
     <tr>
        <td><?php echo JText::_('MAP HEIGHT');?>:
        </td><td> <input type="text" size="10" maxsize="100" name="map_height_list" value="<?php echo $row->map_height_list;?>" />
        
        </td>
       
    </tr> 
   <tr>
        <td><?php echo JText::_('MAP LAYOUT');?>:
        </td><td> <?php echo makeList('map_layout_list',array( JText::_('LEFT')=>'1', JText::_('RIGHT')=>'0', JText::_('TOP')=>'2', JText::_('BOTTOM')=>'3', JText::_('CSS')=>'4'),$row->map_layout_list);?>
        
        </td>
       
    </tr> 
    <tr>
        <td><?php echo JText::_('LOCATIONS PER PAGE');?>:
        </td><td> <input type="text" size="10" maxsize="100" name="locations_per_page" value="<?php echo $row->locations_per_page;?>" />        
        </td>
       
    </tr>
    <tr>
        <td><?php echo JText::_('LOCATION COLUMNS');?>:
        </td><td> <input type="text" size="10" maxsize="100" name="location_columns" value="<?php echo $row->location_columns; ?>" />        
        </td>
       
    </tr>
    
    <tr>
        <td><strong><?php echo JText::_('LOCATION DETAIL PAGE SETUP');?></strong>
        </td>
        <td>
        </td>
       
    </tr> 
    <tr>
        <td><?php echo JText::_('RESULT TYPE');?>:
        
        </td><td>
        <input name="result_type_details" type="radio" value="1" <?php echo ($row->result_type_details==1)?'checked="checked"':''; ?>/><?php echo JText::_('TEXT WITH MAP-IT LINK');?>
          <input name="result_type_details" type="radio" value="2" <?php echo ($row->result_type_details==2)?'checked="checked"':''; ?>/><?php echo JText::_('TEXT&MAP');?>
          <input name="result_type_details" type="radio" value="3" <?php echo ($row->result_type_details==3)?'checked="checked"':''; ?>/> <?php echo JText::_('TEXT ONLY');?> 
        
       </td> 
    </tr>  
    <tr>
        <td><?php echo JText::_('TEXT BLOCK WIDTH');?>:
        </td><td> <input type="text" size="10" maxsize="100" name="text_width_details" value="<?php echo $row->text_width_details;?>" />
        
        </td>
       
    </tr>  
     <tr>
        <td><?php echo JText::_('TEXT BLOCK HEIGHT');?>:
        </td><td> <input type="text" size="10" maxsize="100" name="text_height_details" value="<?php echo $row->text_height_details;?>" />
        
        </td>
       
    </tr>     
    <tr>
        <td><?php echo JText::_('MAP WIDTH');?>:
        </td><td> <input type="text" size="10" maxsize="100" name="map_width_details" value="<?php echo $row->map_width_details;?>" />
        
        </td>
       
    </tr> 
     <tr>
        <td><?php echo JText::_('MAP HEIGHT');?>:
        </td><td> <input type="text" size="10" maxsize="100" name="map_height_details" value="<?php echo $row->map_height_details;?>" />
        
        </td>
       
    </tr> 
   <tr>
        <td><?php echo JText::_('MAP LAYOUT');?>:
        </td><td> <?php echo makeList('map_layout_details',array( JText::_('LEFT')=>'1', JText::_('RIGHT')=>'0', JText::_('TOP')=>'2', JText::_('BOTTOM')=>'3', JText::_('CSS')=>'4'),$row->map_layout_details);?>
        
        </td>
       
    </tr> 
    <tr>
        <td><strong><?php echo JText::_('FIELD CONTROL');?></strong>
        </td>
        <td>
        </td>
       
    </tr> 
    <tr>
        <td colspan="2">
    <table class="adminlist">
                <thead>
                    <tr>                        
                        <th><a href="index2.php?option=com_xtremelocator&amp;task=standard_search&amp;t=1&amp;sort_by=field_name"   ><?php echo JText::_('FIELD');?></a></th>
                        <th><?php echo JText::_('ENABLED');?></th>
                        <th><a href="index2.php?option=com_xtremelocator&amp;task=standard_search&amp;t=1&amp;sort_by=field_id"   ><?php echo JText::_('ID');?></a></th>
                        <th colspan="4"><?php echo JText::_('LOCATION LIST');?></th>
                        <th colspan="3"><?php echo JText::_('LOCATION DETAILS');?></th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong><?php echo JText::_('DETAIL LINK');?></strong></td>
                        <td><strong><?php echo JText::_('VISIBLE');?></strong></td>
                        <td><strong><?php echo JText::_('SHOW TITLE');?></strong></td>
                        <td><strong><a href="index2.php?option=com_xtremelocator&amp;task=standard_search&amp;t=1&amp;sort_by=order"   ><?php echo JText::_('ORDER');?></a></strong></td>
                        <td><strong><?php echo JText::_('VISIBLE');?></strong></td>
                        <td><strong><?php echo JText::_('SHOW TITLE');?></strong></td>
                        <td><strong><a href="index2.php?option=com_xtremelocator&amp;task=standard_search&amp;t=2&amp;sort_by=order"   ><?php echo JText::_('ORDER');?></a></strong></td>                     
                    </tr>
                </thead>
                <tfoot>
                     <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><input name="lincable" type="radio" value="0" /><?php echo JText::_('NO LINK');?></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>                     
                    </tr>
                </tfoot>
                <tbody>
                  <?php
                  
                  if(!isset($_GET['t'])||$_GET['t']==1){
                    $afields=$fields;
                  }else{
                   $afields=$fields2;
                  }
                  foreach ($afields as $i=>$ff){?>
                    <?php isset($fields[$i])?$cfl=$fields[$i]:$cfl=false;?>
                    <?php isset($fields2[$i])?$cfd=$fields2[$i]:$cfd=false;?>
                   
                    <tr>
                        <td><?php echo $afields[$i]->field_name;?></td>
                        <td><?php echo $afields[$i]->enabled==1?JText::_('YES'):JText::_('NO');?></td>
                        
                        <td><?php echo $afields[$i]->field_id2;?></td>
                        <td><input name="lincable" type="radio" value="<?php echo $afields[$i]->id;?>" <?php echo $cfl->lincable==1?'checked="checked"':"";?>/></td>
                        <td><input type="checkbox" name="visible[1_2_<?php echo $afields[$i]->id;?>]" value="1" <?php echo $cfl->visible==1?'checked="checked"':"";?>/>
                       </td>
                        <td><input type="checkbox" name="title[1_2_<?php echo $afields[$i]->id;?>]" value="1" <?php echo $cfl->show_title==1?'checked="checked"':"";?>/></td>
                        <td><input type="text" name="order[1_2_<?php echo $afields[$i]->id;?>]" value="<?php echo $cfl->order;?>" /></td>
                         <td><input type="checkbox" name="visible[2_2_<?php echo $afields[$i]->id;?>]" value="1" <?php echo $cfd->visible==1?'checked="checked"':"";?>/>
                       </td>
                        <td><input type="checkbox" name="title[2_2_<?php echo $afields[$i]->id;?>]" value="1" <?php echo $cfd->show_title==1?'checked="checked"':"";?>/></td>
                        <td><input type="text" name="order[2_2_<?php echo $afields[$i]->id;?>]" value="<?php echo $cfd->order;?>" /></td>                     
                    </tr>
                   <?php }?>
                   
                </tbody>
                
            </table>  
      </td>       
    </tr> 
    <tr>
        <td><?php echo JText::_('SHOW ADVANCED SEARCH LINK');?>:
        </td><td><?php echo makeList('show_advanced_link',array( JText::_('YES')=>'1', JText::_('NO')=>'0'),$row->show_advanced_link);?>
        </td>
       
    </tr>
    
     
     <tr>
        <td><?php echo JText::_('SHOW ALL LOCATION LINK');?>:
        </td><td><?php echo makeList('show_all_location_link',array( JText::_('YES')=>'1', JText::_('NO')=>'0'),$row->show_all_location_link);?>
        </td>
       
    </tr>

</table>
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="com_xtremelocator" />
<input type="hidden" name="task" value="standard_search" />
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</form>