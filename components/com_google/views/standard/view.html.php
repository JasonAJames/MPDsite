<?php

defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.view');

class ViewStandard extends JView
{
	function display($tpl = null)
	{
		
		global $option, $mainframe;
		
		$model =& $this->getModel();
		$document	=& JFactory::getDocument();
		$pathway	=& $mainframe->getPathway();
		$user		=& JFactory::getUser();
		$items	= & $this->get( 'Data');
		$category = $model->getCategoryData();	
		$lists['icon'] = $model->buildIcon(JPATH_SITE.DS.'components'.DS.'com_google'.DS.'icons'); 
		$params = &JComponentHelper::getParams( 'com_google' );
		$menus = &JSite::getMenu();
		$menu  = $menus->getActive();
		
		//Process data
		$txt = $category->description;
		$txt = JFilterOutput::cleanText($txt);
		$txt = substr($txt, 0, 100);
		$name = $category->name;
		
		//set title and metadata
		$document->setTitle( $params->get( 'page_title' ) );
		$document->setMetadata('Description', $txt); 
		$document->setMetadata('Keywords', 'GoolgeMap,joomla component googlemap,'.$name); 
		
		//set breadcrumbs
		if(is_object($menu) && $menu->query['view'] != 'standard') {
			$pathway->addItem($category->name, '');
		}
		
		//merge params
		$category_params = new JParameter($category->params);
		

		$this->assignRef('google', 	$items);
		$this->assignRef('category',$category);
		$this->assignRef('option', 	$option);
		$this->assignRef('params',	$params);
		$this->assignRef('params_cat',	$category_params);
		$this->assignRef('user',	$user);
		$this->assignRef('lists',	$lists);
		
		parent::display($tpl);

	}
}

?>