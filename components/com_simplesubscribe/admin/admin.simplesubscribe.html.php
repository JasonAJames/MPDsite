<?php
/**
* @Copyright Copyright (C) 2010- Gary Teh Name1price.Com
* @license GNU/GPL http://www.gnu.org/copyleft/gpl.html
**/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * HTML View class for the Content component
 *
 * @static
 * @package		Joomla
 * @subpackage	Content
 * @since 1.0
 */
class SimpleSubscribeView
{
	/**
	* Writes a list of the articles
	* @param array An array of article objects
	*/
	function showConfigurations( )
	{

		global $mainframe;

		// Initialize variables
		$db		=& JFactory::getDBO();
		$user	=& JFactory::getUser();
		$config	=& JFactory::getConfig();
		$now	=& JFactory::getDate();

		$query = "select * from jos_simplesub_options";
		$db->setQuery($query);

		$rows = $db->loadAssocList();

		$results = array();
		foreach($rows	as $row){

			$results[$row['field_name']] = $row['field_value'];
		}



		/*
		//Ordering allowed ?
		$ordering = ($lists['order'] == 'section_name' || $lists['order'] == 'cc.title' || $lists['order'] == 'c.ordering');
		JHTML::_('behavior.tooltip');*/

		global $mainframe;

/*
		$myxmltemplate_helper = new XMLTemplateHelper();
		$this->lists['available_XMLtemplates'] = $myxmltemplate_helper->availableXMLTemplates();



		$document =& JFactory::getDocument();
		$listStyle = "
			<ul id=\"submenu\">
				<li><a id=\"details\" href=\"?option=com_simpleworkflow&task=showuploadedxmlform\">".JText::_('Install New XML Template')."</a></li>
				<li><a id=\"thumbs\" href=\"?option=com_simpleworkflow&task=XMlTemplates\">".JText::_('XML Templates')."</a></li>
				<li><a id=\"details\" href=\"?option=com_simpleworkflow&task=showbusinessclasses\">".JText::_('Business Classes')."</a></li>
			</ul>
		";
		$document->setBuffer($listStyle, 'modules', 'submenu');
		$document->title = "Existing Workflow XML Templates ";
		*/
		?>
		<form action="index.php?option=com_simplesubscribe" method="post" name="adminForm">

		<table class="adminlist" cellspacing="1">
					<thead>
						<tr>
							<th width="250px;"  >
								<?php echo JText::_( 'Fields' ); ?>
							</th>

							<th class="title" >
								<?php echo JText::_( 'Configurations'); ?>
							</th>
						</tr>
					</thead>
					<tfoot>
					<tr>
						<td colspan="2">
							<?php //echo $page->getListFooter(); ?>
						</td>
					</tr>
					</tfoot>
					<tbody>

							<!--Paypal email address-->
							<tr>
								<td>
									Your Paypal Account
								</td>
								<td>
								<input type="text" name="paypal_id" value="<?php echo $results['paypal_id'] ; ?>"/>

								</td>
							</tr>


							<!--Amount to Charge-->
							<tr>
								<td>
									Membership Subscription Amount
								</td>
								<td>
									<input type="text" name="subscription_amount" value="<?php echo $results['subscription_amount'] ; ?>"/>
								</td>
							</tr>

							<!--Currency -->
							<tr>
								<td>
									Currency (e.g. SGD, USD)
								</td>
								<td>
									<input type="text" name="currency" value="<?php echo $results['currency'] ; ?>"/>
								</td>
							</tr>


					</tbody>
		</table>
		<input type="hidden" name="task" value="" />


		</form>

		<?php



	}

}
?>