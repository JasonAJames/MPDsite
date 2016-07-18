<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
<table class="adminform" >
    <tr>
        <td><?php echo JText::_('ACCOUNT ID');?>:
        </td><td width="80%"><input type="text" size="10" maxsize="100" name="site_id" value="<?php echo $row->site_id; ?>" />
        </td>
       
    </tr>
     <tr>
        <td><?php echo JText::_('CSS PATH');?>:
        </td><td width="80%"><input type="text" size="100" maxsize="100" value="<?php 
        $folder = substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'], "administrator/"));
        echo $folder;?>components/com_xtremelocator/css/xtremelocator_pub.css" readonly=""/>
        </td>
       
    </tr>
    <tr>
    <tr>
        <td><strong><?php echo JText::_('AVAILABLE FIELDS');?></strong>
        </td>       
    </tr>   
    <tr>
        <td>
            <table class="adminlist">
                <thead>
                    <tr>
                        <th>#</th>
                        <th ><?php echo JText::_('FIELD');?></th>
                        <th><?php echo JText::_('ENABLED');?></th>
                        <th><?php echo JText::_('ID');?></th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($fields as $field){?>
                    <tr>
                        <td><input type="checkbox" name="remove[<?php echo $field->id;?>]" value="1" /></td>
                        <td style="white-space: nowrap;"><a href="index.php?option=com_xtremelocator&task=settings_add&id=<?php echo $field->id;?>"><?php echo $field->field_name;?></a></td>
                        <td><input type="checkbox" name="enabled[<?php echo $field->id;?>]" value="1" <?php echo $field->enabled==1?' checked="checked"':'';?>/></td>                                
                        <td><?php echo $field->field_id2;?></td>
                    </tr>
                    <?php }?>
                </tbody>
                
            </table>
        </td>       
    </tr>    
     
</table>
<input type="hidden" name="id" value="<?php echo $row->id; ?>" />
<input type="hidden" name="option" value="com_xtremelocator" />
<input type="hidden" name="task" value="settings" />
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</form>