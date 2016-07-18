<?php // no direct access
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_COMPONENT.DS.'controller.php' );
$utc = new UserTraceController();

$sections = $utc->_getSections();
?>
	
<div class="componentheading">Sections</div>
<p>&nbsp;</p>
<?php
	if(is_array($sections)) {
		echo '<table><tr align="center"><th>Title</th><th>Status</th></tr>';
		
		for($i=0; $i<sizeof($sections["id"]); $i++) {
			$status_array = $utc->_getSectionStatusArray($sections['id'][$i]);
			echo "<tr><td><a href=\"".JRoute::_( 'index.php?option=com_usertrace&task=showart&sid=' ).$sections['id'][$i]."\">".$sections['title'][$i]."</a></td>";
			echo "<td>";
			foreach($status_array as $statusname => $articlenum) {
				echo $utc->_getSectionStatusHtml($statusname, $articlenum)."&nbsp;&nbsp;";
			}
			echo "</td></tr>";
		}
		echo "</table>";
	} else {
		echo "No sections available";
	}