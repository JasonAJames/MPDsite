<form action="index2.php" method="post" name="adminForm" id="adminForm" class="adminForm">
<?php if(isset($row->id)){ echo '<input type="hidden" name="id" value="'.$row->id.'"/>';};?>
<table class="adminform">
    <tr>
        <td><?php echo JText::_('FIELD ID');?>:
        </td><td width="80%"><input type="text" size="10" maxsize="100" name="field_id2" value="<?php echo isset($row->field_id2)?$row->field_id2:""; ?>" />
        </td>
       
    </tr>
    <tr>
        <td><?php echo JText::_('FIELD NAME');?>:
        </td><td width="80%"><input type="text" size="10" maxsize="100" name="field_name" value="<?php echo isset($row->field_name)?$row->field_name:""; ?>" />
        </td>       
    </tr>       
</table>
<?php if(isset($row->id)){?><input type="hidden" name="id" value="<?php echo $row->id; ?>" /><?php }?>
<input type="hidden" name="option" value="com_xtremelocator" />
<input type="hidden" name="task" value="settings_add" />
<input type="hidden" name="<?php echo JUtility::getToken(); ?>" value="1" />
</form>