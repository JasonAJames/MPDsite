<?php // no direct access
defined('_JEXEC') or die('Restricted access');
?>

<form id="FR-form" name="FR-form" action="<?php echo JRoute::_( 'index.php?option=com_usertrace&task=exportcsv' ); ?>" method="post">
	<table>
		<tr>
			<td>Please select FIELD SEPARATOR character</td>
			<td>
				<select name="sep_char">
					<option value=",">Comma [,]</option>
					<option value=";">Semicolon [;]</option>
					<option value="TAB">TAB [\t]</option>
					<option value=".">Dot [.]</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Please select NEW LINE character</td>
			<td>
				<select name="newline_char">
					<option value="GEN">General New line [\n]</option>
					<option value="WIN">Windows New line [\r\n]</option>
					<option value="DAR">Mac New line [\r]</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>File compression</td>
			<td>
				<select name="compression" id="compression">
					<option value="">(no compression)</option>
					<option value="ZIP">ZIP (.zip)</option>
					<option value="TAR">TAR (.tar)</option>
					<option value="GZIP">GZIP (.tgz.tz)</option>
				</select>
			</td>
		</tr>
		<tr><td><br /></td></tr>
		<tr>
			<td><input type="submit" value="Export CSV" /></td>
		</tr>
	</table>
	<?php echo JHTML::_( 'form.token' ); ?>
</form>	