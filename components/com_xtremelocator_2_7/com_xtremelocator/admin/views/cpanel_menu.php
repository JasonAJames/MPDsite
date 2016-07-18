<?php defined('_JEXEC') or die('Restricted access'); 
function createMenuElement($title,$task,$icon){
    $el='<div style="float:left;">
            <div class="icon">
                <a href="index2.php?option=com_xtremelocator&amp;task='.$task.'"   >
                    <img src="components/com_xtremelocator/images/icon-48-'.$icon.'.png" alt="'.$title.'"  /><span>'.$title.'</span>
                </a>
            </div>
        </div>';
    return $el;
}
?>
<form action="index.php" method="post" name="adminForm">
<table class="adminform">
    <tr>
        <td width="55%" valign="top">
            <div id="cpanel">
                <?php echo createMenuElement(JText::_('SETTINGS'),'settings','settings');?> 
                <?php echo createMenuElement(JText::_('CSS STYLES'),'css_styles','css');?> 
                <?php echo createMenuElement(JText::_('HELP'),'help','help');?> 
                <?php echo createMenuElement(JText::_('STANDARD SEARCH'),'standard_search','search');?>
                <?php echo createMenuElement(JText::_('ADVANCED SEARCH'),'advanced_search','advanced_search');?>
                <?php echo createMenuElement(JText::_('ALL LOCATION MAP SETUP'),'all_locations','all_locations');?>                
                <?php echo createMenuElement(JText::_('PUBLIC REGISTRATION FORM SETUP'),'add_locations','add_locations');?>
                <?php echo createMenuElement(JText::_('LOCATION LISTING PAGE SETUP'),'list_locations','list_locations');?>
                <?php echo createMenuElement(JText::_('LOCATION ADMIN LOGIN FORM'),'location_admin','xtremelocator');?>
            </div>
        </td>
        <td width="45%" valign="top">
        <div style="width: 100%"> 
             <div class="t">
                <div class="t">
                    <div class="t"></div>
                </div>

            </div> 
            <div class="m"> 
                  <div align="center"><img src="components/com_xtremelocator/images/xtremelocator.png" alt="XtremeLocator"  /></div>
                  <div class="xl_describtion">
                  <table> 
                    <tr>
                        <td><?php echo JText::_('VERSION');?>:
                        </td>
                        <td>
                            2.0
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo JText::_('DEVELOPED BY');?>:
                        </td>
                        <td>
                           <a href="http://www.iqservices.com">IQservices.com</a>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo JText::_('VISIT US');?>:
                        </td>
                        <td>
                           <a href="http://www.iqservices.com">www.IQservices.com</a> | 
                           <a href="http://www.xtremelocator.com">www.XtremeLocator.com</a>
                        </td>
                    </tr>
                    <tr>
                        <td><?php echo JText::_('LICENSE');?>:
                        </td>
                        <td>
                           <a href="http://www.gnu.org/licenses/gpl-2.0.html">GPLv2</a>
                        </td>
                    </tr>
                  </table>
                 </div>
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

<input type="hidden" name="option" value="com_xtremelocator" />
<input type="hidden" name="task" value="control" />
<input type="hidden" name="boxchecked" value="0" />
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</form>
