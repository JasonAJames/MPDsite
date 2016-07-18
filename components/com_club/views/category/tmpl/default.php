<?php defined( '_JEXEC' ) or die(); ?>
<?php if ( $this->params->get( 'show_page_title' ) ) : ?>
<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<?php if ($this->category->name) :
	echo $this->params->get('page_title').' - '.$this->category->name;
else :
	echo $this->params->get('page_title');
endif; ?>
</div>
<?php endif; ?>
<?php echo $this->category->picture; ?>
<br/><br/>
<?php if ( $this->category->coach ) : ?>
   <?php echo JText::_("COACH") . $this->category->coach; ?>
<?php endif; ?>
<?php if ( $this->category->trainer ) : ?>
   <?php echo JText::_("TRAINER") . $this->category->trainer; ?>
<?php endif; ?>
<div class="contentpane<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<script language="javascript" type="text/javascript">
	function tableOrdering( order, dir, task ) {
	var form = document.adminForm;

	form.filter_order.value 	= order;
	form.filter_order_Dir.value	= dir;
	document.adminForm.submit( task );
}
</script>
<form action="<?php echo htmlentities($this->action); ?>" method="post" name="adminForm">
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
	<thead>
		<tr>
			<td align="right" colspan="6">
			<?php if ($this->params->get('show_limit')) :
				echo JText::_('Display Num') .'&nbsp;';
				echo $this->pagination->getLimitBox();
			endif; ?>
			</td>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td align="center" colspan="6" class="sectiontablefooter<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
				<?php echo $this->pagination->getPagesLinks(); ?>
			</td>
		</tr>
		<tr>
			<td colspan="6" align="right">
				<?php echo $this->pagination->getPagesCounter(); ?>
			</td>
		</tr>
	</tfoot>
	<tbody>
		<tr>
			<td width="5" align="center" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
				<?php echo JHTML::_('grid.sort',  'Number', 'cd.number', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</td>
			<td height="20" align="center" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
				<?php echo JHTML::_('grid.sort',  'Name', 'cd.name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
			</td>
		</tr>
	<?php echo $this->loadTemplate('items'); ?>
</tbody>
</table>

<br />
<small><?php echo JText::_("DESIGNEDBY")?><a href="http://danieljamesscott.org">http://danieljamesscott.org</a></small>
<input type="hidden" name="option" value="com_club" />
<input type="hidden" name="catid" value="<?php echo $this->category->id;?>" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="" />
</form>
</div>