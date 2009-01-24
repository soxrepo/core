<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  Leo Feyer 2005
 * @author     Leo Feyer <leo@typolight.org>
 * @package    Backend
 * @license    LGPL
 * @filesource
 */


/**
 * Table tl_form
 */
$GLOBALS['TL_DCA']['tl_form'] = array
(

	// Config
	'config' => array
	(
		'dataContainer'               => 'Table',
		'switchToEdit'                => true,
		'enableVersioning'            => true,
		'ctable'                      => array('tl_form_field'),
		'onload_callback' => array
		(
			array('tl_form', 'checkPermission')
		)
	),

	// List
	'list' => array
	(
		'sorting' => array
		(
			'mode'                    => 1,
			'fields'                  => array('title'),
			'flag'                    => 1,
			'panelLayout'             => 'filter;search,limit',
		),
		'label' => array
		(
			'fields'                  => array('title', 'formID'),
			'format'                  => '%s <span style="color:#b3b3b3; padding-left:3px;">[%s]</span>'
		),
		'global_operations' => array
		(
			'all' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
				'href'                => 'act=select',
				'class'               => 'header_edit_all',
				'attributes'          => 'onclick="Backend.getScrollOffset();"'
			)
		),
		'operations' => array
		(
			'edit' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_form']['edit'],
				'href'                => 'table=tl_form_field',
				'icon'                => 'edit.gif'
			),
			'copy' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_form']['copy'],
				'href'                => 'act=copy',
				'icon'                => 'copy.gif'
			),
			'delete' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_form']['delete'],
				'href'                => 'act=delete',
				'icon'                => 'delete.gif',
				'attributes'          => 'onclick="if (!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\')) return false; Backend.getScrollOffset();"'
			),
			'show' => array
			(
				'label'               => &$GLOBALS['TL_LANG']['tl_form']['show'],
				'href'                => 'act=show',
				'icon'                => 'show.gif'
			)
		)
	),

	// Palettes
	'palettes' => array
	(
		'__selector__'                => array('storeValues', 'sendViaEmail'),
		'default'                     => 'title,formID,method;jumpTo;storeValues;sendViaEmail;attributes,allowTags,tableless'
	),

	// Subpalettes
	'subpalettes' => array
	(
		'storeValues'                 => 'targetTable',
		'sendViaEmail'                => 'recipient,subject,format,skipEmpty'
	),

	// Fields
	'fields' => array
	(
		'title' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_form']['title'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255)
		),
		'formID' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_form']['formID'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('nospace'=>true, 'maxlength'=>64)
		),
		'method' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_form']['method'],
			'default'                 => 'POST',
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'select',
			'options'                 => array('POST', 'GET')
		),
		'allowTags' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_form']['allowTags'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox'
		),
		'storeValues' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_form']['storeValues'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true)
		),
		'targetTable' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_form']['targetTable'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'select',
			'options_callback'        => array('tl_form', 'getAllTables')
		),
		'tableless' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_form']['tableless'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox'
		),
		'sendViaEmail' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_form']['sendViaEmail'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox',
			'eval'                    => array('submitOnChange'=>true)
		),
		'recipient' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_form']['recipient'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'rgxp'=>'extnd')
		),
		'subject' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_form']['subject'],
			'exclude'                 => true,
			'search'                  => true,
			'inputType'               => 'text',
			'eval'                    => array('mandatory'=>true, 'maxlength'=>255, 'decodeEntities'=>true)
		),
		'format' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_form']['format'],
			'default'                 => 'raw',
			'exclude'                 => true,
			'inputType'               => 'select',
			'options'                 => array('raw', 'email', 'xml', 'csv'),
			'reference'               => &$GLOBALS['TL_LANG']['tl_form'],
			'eval'                    => array('helpwizard'=>true)
		),
		'skipEmpty' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_form']['skipEmtpy'],
			'exclude'                 => true,
			'filter'                  => true,
			'inputType'               => 'checkbox'
		),
		'jumpTo' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_form']['jumpTo'],
			'exclude'                 => true,
			'inputType'               => 'pageTree',
			'eval'                    => array('fieldType'=>'radio', 'helpwizard'=>true),
			'explanation'             => 'jumpTo'
		),
		'attributes' => array
		(
			'label'                   => &$GLOBALS['TL_LANG']['tl_form']['attributes'],
			'exclude'                 => true,
			'inputType'               => 'text',
			'eval'                    => array('multiple'=>true, 'size'=>2)
		)
	)
);


/**
 * Class tl_form
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Leo Feyer 2005
 * @author     Leo Feyer <leo@typolight.org>
 * @package    Controller
 */
class tl_form extends Backend
{

	/**
	 * Import the back end user object
	 */
	public function __construct()
	{
		parent::__construct();
		$this->import('BackendUser', 'User');
	}


	/**
	 * Check permissions to edit table tl_form
	 */
	public function checkPermission()
	{
		if ($this->User->isAdmin)
		{
			return;
		}

		// Set root IDs
		if (!is_array($this->User->forms) || count($this->User->forms) < 1)
		{
			$root = array(0);
		}
		else
		{
			$root = $this->User->forms;
		}

		$GLOBALS['TL_DCA']['tl_form']['list']['sorting']['root'] = $root;

		// Check current action
		switch ($this->Input->get('act'))
		{
			case 'create':
			case 'select':
				// Allow
				break;

			case 'edit':
				// Dynamically add the record to the user profile
				if (!in_array($this->Input->get('id'), $root))
				{
					$arrNew = $this->Session->get('new_records');

					if (is_array($arrNew['tl_form']) && in_array($this->Input->get('id'), $arrNew['tl_form']))
					{
						$objUser = $this->Database->prepare("SELECT forms FROM tl_user WHERE id=?")
												  ->limit(1)
												  ->execute($this->User->id);

						// $forms only contains user permissions
						$forms = deserialize($objUser->forms);
						$forms[] = $this->Input->get('id');

						$this->Database->prepare("UPDATE tl_user SET forms=? WHERE id=?")
									   ->execute(serialize($forms), $this->User->id);

						// $root also contains group permissions
						$root[] = $this->Input->get('id');
						$this->User->forms = $root;
					}
				}
				// No break;

			case 'copy':
			case 'delete':
			case 'show':
				if (!in_array($this->Input->get('id'), $root))
				{
					$this->log('Not enough permissions to '.$this->Input->get('act').' form ID "'.$this->Input->get('id').'"', 'tl_form checkPermission', 5);
					$this->redirect('typolight/main.php?act=error');
				}
				break;

			case 'editAll':
			case 'deleteAll':
				$session = $this->Session->getData();
				$session['CURRENT']['IDS'] = array_intersect($session['CURRENT']['IDS'], $root);
				$this->Session->setData($session);
				break;

			default:
				if (strlen($this->Input->get('act')))
				{
					$this->log('Not enough permissions to '.$this->Input->get('act').' forms', 'tl_form checkPermission', 5);
					$this->redirect('typolight/main.php?act=error');
				}
				break;
		}
	}


	/**
	 * Get all tables and return them as array
	 * @return array
	 */
	public function getAllTables()
	{
		return $this->Database->listTables();
	}
}

?>