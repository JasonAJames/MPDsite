<?php // no direct access
defined('_JEXEC') or die('Restricted access');

JHTML::script('jquery-1.3.2.min.js', 'components/com_usertrace/views/_shared/js/', false);
?>

<script type="text/javascript">
	$(document).ready(function(){
		$('#showid').val('<?php echo UTAdminController::_loadCParamValue('showid'); ?>');
		$('#showuserid').val('<?php echo UTAdminController::_loadCParamValue('showuserid'); ?>');
		$('#showusername').val('<?php echo UTAdminController::_loadCParamValue('showusername'); ?>');
		$('#showip').val('<?php echo UTAdminController::_loadCParamValue('showip'); ?>');
		$('#showagent').val('<?php echo UTAdminController::_loadCParamValue('showagent'); ?>');
		$('#showurl').val('<?php echo UTAdminController::_loadCParamValue('showurl'); ?>');
		$('#showref').val('<?php echo UTAdminController::_loadCParamValue('showref'); ?>');
		$('#showtime').val('<?php echo UTAdminController::_loadCParamValue('showtime'); ?>');
	});
	
	function showall() {
		$('#showid').val('1');
		$('#showuserid').val('1');
		$('#showusername').val('1');
		$('#showip').val('1');
		$('#showagent').val('1');
		$('#showurl').val('1');
		$('#showref').val('1');
		$('#showtime').val('1');
	}
</script>

<form id="FR-form" name="FR-form" onsubmit="return true;" action="<?php echo JRoute::_( 'index.php?option=com_usertrace&task=saveconf' ); ?>" method="post">

	<fieldset>
		<legend>
			<?php echo JText::_( 'Configuration' );?>
		</legend>
		<table>
			<tr><td>Show ID column</td><td><select id="showid" name="showid"><option value="1">Yes</option><option value="0">No</option></select></td></tr>
			<tr><td>Show USERID column</td><td><select id="showuserid" name="showuserid"><option value="1">Yes</option><option value="0">No</option></select></td></tr>
			<tr><td>Show USERNAME column</td><td><select id="showusername" name="showusername"><option value="1">Yes</option><option value="0">No</option></select></td></tr>
			<tr><td>Show IP column</td><td><select id="showip" name="showip"><option value="1">Yes</option><option value="0">No</option></select></td></tr>
			<tr><td>Show AGENT column</td><td><select id="showagent" name="showagent"><option value="1">Yes</option><option value="0">No</option></select></td></tr>
			<tr><td>Show URL column</td><td><select id="showurl" name="showurl"><option value="1">Yes</option><option value="0">No</option></select></td></tr>
			<tr><td>Show REF column</td><td><select id="showref" name="showref"><option value="1">Yes</option><option value="0">No</option></select></td></tr>
			<tr><td>Show TIME column</td><td><select id="showtime" name="showtime"><option value="1">Yes</option><option value="0">No</option></select></td></tr>
			<tr><td></td><td><input type="button" value="All yes" onclick="showall();"/></td><tr>
		</table>
	</fieldset>
	<?php echo JHTML::_( 'form.token' ); ?>

	<input type="submit" value="Save data" />
</form>	