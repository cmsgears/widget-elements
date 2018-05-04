<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

namespace cmsgears\widgets\elements\mappers;

// CMG Imports
use cmsgears\cms\common\config\CmsGlobal;

/**
 * WidgetAuto maps widgets to models using auto-suggest.
 *
 * @since 1.0.0
 */
class WidgetAuto extends ObjectAuto {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $type			= CmsGlobal::TYPE_WIDGET;
	public $ctype			= CmsGlobal::TYPE_WIDGET;

	public $mapperTemplate	= 'widgetMapperTemplate';

	public $notes			= '<b>Notes</b>: Type in search box to filter widgets and select the widget to map.';

	public $actionUrl		= 'cms/block/auto-search';

	// Protected --------------

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	public function init() {

		parent::init();

		$this->modelObjects = isset( $this->model ) ? $this->model->activeModelWidgets : [];
	}

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// yii\base\Widget --------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	// WidgetAuto ----------------------------

}
