<?php // no direct access
defined('_JEXEC') or die('Restricted access');
?>

<form id="FR-form" name="FR-form" onsubmit="return true;" action="<?php echo JRoute::_( 'index.php?option=com_usertrace&task=clearalldata' ); ?>" method="post">
	<input type="submit" value="Clear Data" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>	