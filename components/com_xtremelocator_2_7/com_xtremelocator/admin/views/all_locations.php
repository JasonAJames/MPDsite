<script type="text/javascript">
   function getParams(){    
     url_code=document.getElementById('url_code');
     ucode=url_code.value;
     center=document.getElementById("center_coordinates"); 
     zoom=document.getElementById("zoom_level");
      mwidth=document.getElementById("map_width_details");
       mheight=document.getElementById("map_height_details");
     if(ucode!=""){ 
        
        center.value=ucode.substring(ucode.indexOf("&_center=")+9,ucode.indexOf("&zoom="));        
        zoom.value=ucode.substring(ucode.indexOf("&zoom=")+6,ucode.indexOf("&width="));       
        mwidth.value=ucode.substring(ucode.indexOf("&width=")+7,ucode.indexOf("px&height"));
        mheight.value=ucode.substring(ucode.indexOf("&height=")+8,ucode.length-2);     
       
     } 
     
      mmap=document.getElementById('mapContainer');
       mmap.width=mwidth.value;
       mmap.height=mheight.value;
     mmap.src='http://app.xtremelocator.com/visitor/googlemap.php?show=all&sid=<?php echo $gobal_config->site_id;?>&_center='+center.value+'&zoom='+zoom.value+'&width='+mwidth.value+'px&height='+mheight.value+'px';              
   }
</script>
<?php $editor =& JFactory::getEditor();?>
<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
<?php if(isset($_GET['t'])){ echo '<input type="hidden" name="t" value="'.$_GET['t'].'"/>';}?>
    <?php if(isset($_GET['sort_by'])){ echo '<input type="hidden" name="sort_by" value="'.$_GET['sort_by'].'"/>';}?>
<table class="adminform">
   <tr>
        <td><?php echo JText::_('MESSAGE');?>:
        </td>
        <td><?php echo $editor->display( 'describtion',  $row->describtion , 600, 250, '50', '15' )."\n" ; ?>
        </td>
       
    </tr>
        
    <tr>
        <td><?php echo JText::_('MAP WIDTH');?>:
        </td><td> <input type="text" size="10" maxsize="100" name="map_width_details" value="<?php echo $row->map_width_details;?>" id="map_width_details"/>
        
        </td>
       
    </tr> 
     <tr>
        <td><?php echo JText::_('MAP HEIGHT');?>:
        </td><td> <input type="text" size="10" maxsize="100" name="map_height_details" value="<?php echo $row->map_height_details;?>" id="map_height_details"/>
         </td>
       
    </tr> 
    <tr>
        <td><?php echo JText::_('CENTER CORDINATE');?>:
        </td><td> <input type="text" size="30" maxsize="100" name="center_coordinates" value="<?php echo $row->center_coordinates;?>" id="center_coordinates"/>
         </td>
       
    </tr>   
     <tr>
        <td><?php echo JText::_('ZOOM LEVEL');?>:
        </td><td> <input type="text" size="10" maxsize="100" name="zoom_level" value="<?php echo $row->zoom_level;?>" id="zoom_level"  />
         </td>
       
    </tr>   
     <tr>
        <td><?php echo JText::_('URL CODE FROM XTREMELOCATOR');?>:
        </td><td> <input type="text" size="100" maxsize="500" name="URLcode"   id="url_code"/>
         <input type="button" onClick="getParams();return true;" value="<?php echo JText::_('UPDATE');?>"/>
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
<input type="hidden" name="task" value="all_locations" />
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</form>  
<iframe width="<?php echo $row->map_width_details;?>" height="<?php echo $row->map_height_details;?>" scrolling="no" frameborder="0" hspace="0" vspace="0" marginheight="0" 'marginwidth="0" src="http://app.xtremelocator.com/visitor/googlemap.php?show=all&sid=<?php echo $gobal_config->site_id; ?>&_center=<?php echo$row->center_coordinates;?>&zoom=<?php echo $row->zoom_level;?>&width=<?php echo $row->map_width_details;?>px&height=<?php echo $row->map_height_details;?>px" name="mapContainer" id="mapContainer"></iframe>    