
<form action="index.php" method="post" name="adminForm">
<?php if(isset($_GET['t'])){ echo '<input type="hidden" name="t" value="'.$_GET['t'].'"/>';}?>
    <?php if(isset($_GET['sort_by'])){ echo '<input type="hidden" name="sort_by" value="'.$_GET['sort_by'].'"/>';}?>
<table class="adminform">
    <tr>
        <td width="55%" valign="top">
            
            <table width="100%">
            <?php foreach ($styles as $style){?>
            <tr>
                <td><strong><?php echo JText::_(strtoupper($style->name));?></strong></td>
                <td><input type="text" name="xl[<?php echo $style->id;?>]" value="<?php echo $style->class;?>"/></td>
            </tr>
            <?php }?>
            </table>
            
        </td>
        <td width="45%" valign="top">
        <div style="width: 100%"> 
             <div class="t">
                <div class="t">
                    <div class="t"></div>
                </div>

            </div> 
            <div class="m"> 
                  <h3><?php echo JText::_('CSS STYLES LAYOUT');?>;</h3><div align="center">
                  <img src="components/com_xtremelocator/images/layouts.jpg" alt="Layouts"  /></div>                 
            </div> 
            <div class="b">
                <div class="b">
                    <div class="b"></div>
                </div>

            </div>  
        </div>
        </td>
    </tr>
</table>
<div><strong><?php echo JText::_('CSS SOURCE');?></strong></div>
<textarea name="css_source" rows="80" cols="150" > 
<?php 
    $folder = substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], "administrator/index.php"));
    $cssFile = $folder."components/com_xtremelocator/css/xtremelocator_pub.css";    
    if(is_file($cssFile)){        
        $fh = fopen($cssFile, 'r');
        $cssData = fread($fh,filesize($cssFile));
        fclose($fh);
        echo $cssData;
    }
?>
</textarea>
<input type="hidden" name="option" value="com_xtremelocator" />
<input type="hidden" name="task" value="css_styles" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</form>
