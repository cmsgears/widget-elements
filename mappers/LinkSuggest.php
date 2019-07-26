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
 * LinkSuggest maps links to models using auto-suggest.
 *
 * @since 1.0.0
 */
class LinkSuggest extends \cmsgears\core\common\widgets\mappers\ObjectSuggest {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $type = null;

	public $mapperTemplate = 'linkMapperTemplate';

	public $notes = '<b>Notes</b>: Type in search box to filter links and select the link to map.';

	public $actionUrl = 'cms/link/auto-search';

	// Protected --------------

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	public function init() {

		parent::init();

		$this->modelObjects = isset( $this->model ) ? $this->model->activeModelLinks : [];
	}

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// yii\base\Widget --------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	// LinkSuggest ---------------------------

}
