<?php // no direct access
defined('_JEXEC') or die('Restricted access');

$cols = null;
$varname = 'id'; if(UTAdminController::_loadCParamValue('show'.$varname)) { $cols[] = $varname; }
$varname = 'userid'; if(UTAdminController::_loadCParamValue('show'.$varname)) { $cols[] = $varname; }
$varname = 'username'; if(UTAdminController::_loadCParamValue('show'.$varname)) { $cols[] = $varname; }
$varname = 'ip'; if(UTAdminController::_loadCParamValue('show'.$varname)) { $cols[] = $varname; }
$varname = 'agent'; if(UTAdminController::_loadCParamValue('show'.$varname)) { $cols[] = $varname; }
$varname = 'url'; if(UTAdminController::_loadCParamValue('show'.$varname)) { $cols[] = $varname; }
$varname = 'ref'; if(UTAdminController::_loadCParamValue('show'.$varname)) { $cols[] = $varname; }
$varname = 'time'; if(UTAdminController::_loadCParamValue('show'.$varname)) { $cols[] = $varname; }

$db =& JFactory::getDBO();
global $mainframe;
$limit = $mainframe->getUserStateFromRequest('global.list.limit',					'limit', $mainframe->getCfg('list_limit'), 'int');
$limitstart = $mainframe->getUserStateFromRequest('articleelement.limitstart',			'limitstart',		0,	'int');
$filter_order		= $mainframe->getUserStateFromRequest('articleelement.filter_order',		'filter_order',		'',	'cmd');
$filter_order_Dir	= $mainframe->getUserStateFromRequest('articleelement.filter_order_Dir',	'filter_order_Dir',	'',	'word');

// Order
$order = "ORDER BY";
if($filter_order == '') {
	$filter_order = "time";
}
$order .= " $filter_order ";
if($filter_order_Dir == '') {
	$filter_order_Dir = "Desc";
}
$order .= " $filter_order_Dir ";

// Query
$colsname = "";
$query = "";
if(sizeof($cols) > 0){
	for($i=0; $i<sizeof($cols)-1; $i++) {
		$colsname .= $cols[$i].", ";
	}
	$colsname .= end($cols);
	$query = "SELECT $colsname FROM #__usertrace $order";
} else {
	$query = "SELECT SQL_CALC_FOUND_ROWS * FROM #__usertrace $order";
}

$db->setQuery($query, $limitstart, $limit);
$rL=&$db->loadAssocList();

echo '<form action="index.php?option=com_usertrace&amp;task=showall" method="post" name="adminForm">';
	if (empty($rL)) {
		echo '<table><tr><td>No entries available. Please install and enable UserTrace Module.<br />UserTrace will log user activity in the pages where the module is shown.</td></tr><tr><td>To silently log user activity, do not show User Trace Module Title.</td></tr></table>';
		return;
	} else {
		////Here the beauty starts
		$db->setQuery('SELECT FOUND_ROWS();');  //no reloading the query! Just asking for total without limit
		jimport('joomla.html.pagination');
		$pageNav = new JPagination( $db->loadResult(), $limitstart, $limit );
		
		echo '<table class="adminlist">';
		$k=0;
		
		
		$vTitle = true;
		foreach($rL as $r) {
			if(!$vTitle) {
				echo '<tr class="row'.$k.'">';
				foreach($r as $key => $value) {
					echo "<td>$value</td>";
				}
				echo "</tr>";
			} else {
				$title = "<tr><thead>";
				$content = "<tr>";
				foreach($r as $key => $value) {
					$title .= '<th align="center">'.JHTML::_('grid.sort', strtoupper($key), $key, @$filter_order_Dir, @$filter_order ).'</th>';
					$content .= "<td>$value</td>";
				}
				echo $title."</thead></tr>";
				echo '<tr class="row'.$k.'">';
				echo $content."</tr>";
				$vTitle = false;
			}
			
			$k = 1 - $k;
		}
	}
	?>
	<tfoot>
		<tr>
			<td colspan="15">
				<?php echo $pageNav->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>
	</table>
	<input type="hidden" name="filter_order" value="<?php echo $filter_order; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $filter_order_Dir; ?>" />
</form>