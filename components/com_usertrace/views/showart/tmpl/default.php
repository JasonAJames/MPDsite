<?php // no direct access
defined('_JEXEC') or die('Restricted access');

require_once( JPATH_COMPONENT.DS.'controller.php' );
$utc = new UserTraceController();

$articles = $utc->_getArticles();
$atrace = $utc->_getArticlesTrace();
?>
	
<div class="componentheading">Articles</div>
<p>&nbsp;</p>
<?php
	if(is_array($articles)) {
		echo '<table><tr align="center"><th>Title</th><th>Status</th></tr>';
		for($i=0; $i<sizeof($articles["id"]); $i++) {
			$status = '<img src="components/com_usertrace/views/_shared/images/publish_x.png" />&nbsp;&nbsp;<font color="#C80000"><b>Not read</b></font>';
			if(!empty($atrace['id'])) {
				if($key = array_search($articles['id'][$i], $atrace['id'])) {
					if($articles['modified'][$i] != "" && strtotime($articles['modified'][$i]) > strtotime($atrace['time'][$key])) {
						$status = '<img src="components/com_usertrace/views/_shared/images/publish_y.png" />&nbsp;&nbsp;<font color="#FF9900"><b>Updated</b></font>';
					} else {
						$status = '<img src="components/com_usertrace/views/_shared/images/tick.png" />&nbsp;&nbsp;<font color="green"><b>Read</b></font>';
					}
				}
			}
			echo "<tr><td><a href=\"".JRoute::_( 'index.php?option=com_content&view=article&id=' ).$articles['id'][$i]."\">".$articles['title'][$i]."</a></td><td style=\"padding-left: 10px;\">$status</td></tr>";
		}
		echo "</table>";
	} else {
		echo "No articles available";
	}