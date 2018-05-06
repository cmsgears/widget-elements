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
 * BlockAuto maps blocks to models using auto-suggest.
 *
 * @since 1.0.0
 */
class BlockAuto extends ObjectAuto {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $type	= CmsGlobal::TYPE_BLOCK;
	public $ctype	= CmsGlobal::TYPE_BLOCK;

	public $mapperTemplate = 'blockMapperTemplate';

	public $notes = '<b>Notes</b>: Type in search box to filter blocks and select the block to map.';

	public $actionUrl = 'cms/block/auto-search';

	// Protected --------------

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	public function init() {

		parent::init();

		$this->modelObjects = isset( $this->model ) ? $this->model->activeModelBlocks : [];
	}

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// yii\base\Widget --------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	// BlockAuto -----------------------------

}
