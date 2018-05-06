<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

namespace cmsgears\widgets\elements\mappers;

/**
 * ObjectAuto maps objects to models using auto-suggest.
 *
 * @since 1.0.0
 */
abstract class ObjectAuto extends ObjectMapper {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	// Mapping type to classify the mapping
	public $ctype;

	// Search not required for auto-suggest
	public $searchByType = false;

	public $levelList = false;

	public $notes = '<b>Notes</b>: Type in search box to filter objects and select the object to map.';

	public $showNotes = true;

	public $inputType = 'none';

	// Override default view path
	public $template = 'auto';

	public $mapperTemplate = 'objectMapperTemplate';

	public $modelObjects = [];

	// Application
	public $app = 'mapper';

	// Controller where mapping request need to be triggered
	public $controller = 'model';

	// Controller action to handle the search request
	public $action = 'autoSearch';

	// Explicit URL to handle the controller search action request
	public $actionUrl = 'core/object/auto-search';

	// Controller action to handle the mapping request
	public $mapAction = 'mapItem';

	// Explicit URL to handle the controller mapping action request
	public $mapActionUrl = null;

	// Controller action to handle the delete request
	public $deleteAction = 'deleteItem';

	// Explicit URL to handle the controller delete action request
	public $deleteActionUrl	= null;

	// Protected --------------

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// yii\base\Widget --------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	// ObjectAuto ----------------------------

}
