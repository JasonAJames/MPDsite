<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<script type="text/javascript" >
function NewWindow(mypage, myname, w, h, scroll) {
 var winl = (screen.width - w) / 2;
 var wint = (screen.height - h) / 2; 
 winprops = 'height='+h+',width='+w+',top='+wint+',left='+winl+',scrollbars='+scroll+',resizable'
 win = window.open(mypage, myname, winprops)
 if (parseInt(navigator.appVersion) >= 4) { win.window.focus(); }
}
</script>
<?php JHTML::stylesheet( 'xtremelocator_pub.css', '/components/com_xtremelocator/css/' );?>
<?php if($this->conf->describtion!=""){?> <div id="<?php echo $this->css['xl_form_message']['class'];?>"><?php echo $this->conf->describtion;?></div><?php }?>
<?php if($this->conf->show_advanced_link==1){ echo '<div id="'.$this->css['xl_advanced_search_link']['class'].'"><a href="'.JRoute::_( 'index.php?option=com_xtremelocator&view=advanced').'">'. JText::_( 'ADVANCED SEARCH' ).'</a> </div>';}?>
<?php if($this->gconf->show_slogan==1){ echo '<div id="xl_powered_link"><a href="http://www.xtremelocator.com">'. JText::_( 'POWERED BY' ).'</a> </div>';}?>
<?php 
    if(isset($_GET['lid']))
    {
        $r[] = $_SESSION["xl_results"][$_GET['lid']];
    }else{
        $r = $_SESSION["xl_results"];
    }       
    if (isset($_GET["pos"]))
    {
        $position = max($_GET["pos"], 0);
    }else{
        $position=0;
    }    

    $start = $position;
    //print_r($r);
    $pageSize=$this->conf->locations_per_page;

    $end = min(count($r), $position + $pageSize); 
?> 
<div id="<?php echo $this->css['xl_search_results']['class'];?>">
    <div id="<?php echo $this->css['xl_search_locations']['class'];?>">
        <?php 
        $resultType=isset($_GET['lid'])?$this->conf->result_type_details:$this->conf->result_type_list;      
        $columns=$this->list_fields;
        $locationColumns=$this->detailed_fields;      
        $lok=isset($_GET['lid'])?$locationColumns:$columns;
        $map_pos=isset($_GET['lid'])?$this->conf->map_layout_details:$this->conf->map_layout_list;
        $c=0;
        for ($i = $start; $i < $end; $i++)
        {
            
            $row = $r[$i];
            $map="";
             if($resultType==3){
            $map_it="";
            $map_it2=""; 
         }else{
            $map_it="<div class='map_it'><a href='#' onClick=\"NewWindow('http://app.xtremelocator.com/visitor/googlemap.php?lid=".$row['_id']."&sid=".$this->gconf->site_id."&zoom=14&language=&info=1&width=".(isset($_GET['lid'])?$this->conf->map_width_details:$this->conf->map_width_list)."px&height=".(isset($_GET['lid'])?$this->conf->map_height_details:$this->conf->map_height_list)."px', '_blank', ".(isset($_GET['lid'])?$this->conf->map_width_details:$this->conf->map_width_list).", ".(isset($_GET['lid'])?$this->conf->map_height_details:$this->conf->map_height_list).", 0);return false;\"><img src='".$this->baseurl."/components/com_xtremelocator/css/mapit.gif'/></a><br/>".JText::_('MAP & DIRECTIONS')."</div>";
            $map_it2= !isset($_GET['lid'])?"<div class='zoom_it'><a href='#' onClick=\"NewWindow('http://app.xtremelocator.com/visitor/googlemap.php?lid=".$row['_id']."&sid=".$this->gconf->site_id."&zoom=14&language=&info=1&width=".$this->conf->map_width_details."px&height=".$this->conf->map_height_details."px', '_blank', ".$this->conf->map_width_details.", ".$this->conf->map_height_details.", 0);return false;\"><img src='".$this->baseurl."/components/com_xtremelocator/css/glass.gif'/></a></div>":""; 
           } 
        if($resultType==2){                            
           $map='<div class="'.$this->css['xl_result_item_map']['class'].'">
                             <iframe width="'.(!isset($_GET['lid'])?$this->conf->map_width_list:$this->conf->map_width_details).'" height="'.(!isset($_GET['lid'])?$this->conf->map_height_list:$this->conf->map_height_details).'" scrolling="no" frameborder="0" hspace="0" vspace="0" marginheight="0"  marginwidth="0" src="http://app.xtremelocator.com/visitor/googlemap.php?infoWindow=false&lid='.$row['_id'].'&sid='.$this->gconf->site_id.'&_center=0&zoom=10&width='.(!isset($_GET['lid'])?$this->conf->map_width_list:$this->conf->map_width_details).'px&height='.(!isset($_GET['lid'])?$this->conf->map_height_list:$this->conf->map_height_details).'px"></iframe>  
       '.$map_it2.'</div>';
        }
      $style="";
        if(isset($_GET['lid'])&&($this->conf->text_width_details!="0"||$this->conf->text_height_details!="0")){
            $style="style='";
            if($this->conf->text_width_details!="0"){
                $style.="width:".$this->conf->text_width_details."px;";
            }
            if($this->conf->text_height_details!="0"){
                $style.="height:".$this->conf->text_height_details."px;";
            }
            $style.="'";
        }elseif( !isset($_GET['lid'])&&($this->conf->text_width_list!="0"||$this->conf->text_height_list!="0")){
            $style="style='";
            if($this->conf->text_width_list!="0"){
                $style.="width:".$this->conf->text_width_list."px;";
            }
            if($this->conf->text_height_list!="0"){
                $style.="height:".$this->conf->text_height_list."px;";
            }
            $style.="'";
        }
        echo "<div class='".$this->css['xl_result']['class'].(!isset($_GET['lid'])&&$this->conf->location_columns>1?'_columns'.$this->conf->location_columns:'')."' >".($map_pos==1||$map_pos==2?$map:'').($map_pos==2?'<div class="xl_clear"></div>':'')."<div class='".$this->css['xl_result_location']['class'].($resultType==2?'_map':'')."' ".$style."/>";
       
       $c++;  
        foreach ($lok as $k => $v)           
            {
                        
            
                $k=ucwords($k);
                if($k!=''&&$k!='Id'){
                    
                            if(substr($row[$k], 7, 4) == "file")
                            {
                                 
                                  $row[$k] = "<a href=\"http://app.xtremelocator.com/common/file.php?id=$row[$k]\">".JText::_('DOWNLOAD')."</a>"; 
                                  
                            }
                            if(($k=='Image'||$k=='Location Image')&& $row[$k] != ""){
                                
                                $row[$k]="<img src='http://app.xtremelocator.com/common/file.php?id=".$row[$k]."'>";
                                
                            }
                            if($k == "E-mail" && $row[$k] != "")
                            {
                                $row[$k] = "<a href=mailto:".$row[$k].">".$row[$k]."</a>";
                            }
                            if($k == "Url" && $row[$k] != "")
                            {
                                $url = $row[$k];
                                if (!strstr($url, "://"))
                                {
                                    $url = "http://".$url;
                                }
                                $row[$k] = "<a href=".$url." target='_blank'>".$row[$k]."</a>";
                            }
                            if($k == "Distance")
                            {
                                $row[$k] = $row[$k] >=0 ? sprintf("%.1f", $row[$k])." ".JText::_('MILES') : null;
                            }
                            if(!isset($_GET['lid'])&& $v['lincable']==1){
                                $row[$k]="<a href='".JRoute::_( 'index.php?option=com_xtremelocator&view=listing')."&lid=".$i."'>".$row[$k]."</a>";
                            }               
                            echo $row[$k]!=''?'<div class="'.$this->css['xl_result_item']['class'].'"><div id="xl_'.$k.'_title" class="'.$this->css['xl_results_title']['class'].'">'.($v['show_title']=='1'?$k:'').'</div> <div id="xl_'.$k.'_value" class="'.$this->css['xl_results_value']['class'].'">'.str_replace("\\n", "<br>", $row[$k]).'</div><div class="xl_clear"></div></div>':'';
                           
                    }
                
            } 
            echo '</div>'.($map_pos==3?'<div class="xl_clear"></div>':'').($map_pos==0||$map_pos==3||$map_pos==4?$map:'').($resultType==1?$map_it:"");
            ?>
            
            </div>
            <?php if($c==$this->conf->location_columns){ 
                echo '<div class="xl_clear"></div>'; 
                $c=0;
            }    
          }            
        ?>  
    </div>
    <?php if(count($r) == 0){echo '<div id="'.$this->css['xl_search_footer']['class'].'">'.JText::_('NO RECORDS FOUND').'</div>';
    }elseif(!isset($_GET['lid'])){ echo '<div id="'.$this->css['xl_search_footer']['class'].'">'.($position>0?"<a href='index.php?option=com_xtremelocator&view=listing&pos=".($position - $pageSize)."'>&lt; ".JText::_('PREVIOUS')."</a> ":"").JText::_('RECORDS').' ' .($start + 1)." - ".($end)." (".count($r).")".($position + $pageSize < count($r)?"<a href='index.php?option=com_xtremelocator&view=listing&pos=".($position+$pageSize)."'> ".JText::_('NEXT')."&gt;</a>":"").'</div>';};?>
    
    <?php if(isset($_GET['lid'])){?><div id="xl_search_back"><a href="javascript:history.back();"><?php echo JText::_('BACK');?></a></div><?php }?>
</div>

