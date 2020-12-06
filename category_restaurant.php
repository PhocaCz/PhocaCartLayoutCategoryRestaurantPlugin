<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined('_JEXEC') or die;
jimport( 'joomla.plugin.plugin' );
jimport( 'joomla.filesystem.file');
jimport( 'joomla.html.parameter' );


JLoader::registerPrefix('Phocacart', JPATH_ADMINISTRATOR . '/components/com_phocacart/libraries/phocacart');

class plgPCLCategory_Restaurant extends JPlugin
{
	
	protected $name 	= 'category_restaurant';
	protected $options 	= array();
	
	function __construct(& $subject, $config) {
		
		$this->options['ordering'] 		= 'c.ordering';
		$this->options['columns'] 		= array('a.weight', 'a.volume');
		$this->options['layouttype'] 	= 'rowlist';
		
		parent :: __construct($subject, $config);
		$this->loadLanguage();
	}

	
	public function PCLonCategoryInsideLayout($context, &$items, $displayData, $eventData) {
		
		if (!isset($eventData['pluginname']) || isset($eventData['pluginname']) && $eventData['pluginname'] != $this->name) {
			return false;
		}
		
		$path = JPluginHelper::getLayoutPath('pcl', $this->name, 'default');
		include $path;
	}
	
	public function PCLonCategoryGetOptions($context, &$options, $eventData) {
		
		if (!isset($eventData['pluginname']) || isset($eventData['pluginname']) && $eventData['pluginname'] != $this->name) {
			return false;
		}
		
		// This are fixed parameters, accessible even the plugin is not saved in plugin manager
		// Normaly, there are no plugin parameters when the plugin is not saved so this event can set default values for parameters
		// Default values cannot be set when calling the plugin, because it is not fixed set which plugin will be called
		$options = $this->options;
		
		return true;
	}


}
?>
