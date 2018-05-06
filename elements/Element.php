<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

namespace cmsgears\widgets\elements\elements;

// Yii Imports
use Yii;

// CMG Imports
use cmsgears\cms\common\config\CmsGlobal;

use cmsgears\widgets\elements\base\ObjectWidget;

/**
 * Element widget dynamically show the element model.
 *
 * @since 1.0.0
 */
class Element extends ObjectWidget {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	// Protected --------------

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// yii\base\Widget --------

    public function init() {

        parent::init();

		$this->modelService = Yii::$app->factory->get( 'elementService' );

		if( isset( $this->slug ) ) {

			// Find Model
			$this->model = $this->modelService->getBySlugType( $this->slug, CmsGlobal::TYPE_ELEMENT );
		}
    }

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	// Element -------------------------------

}
