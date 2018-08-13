<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

namespace cmsgears\widgets\elements\sidebars;

// Yii Imports
use Yii;

// CMG Imports
use cmsgears\cms\common\config\CmsGlobal;

use cmsgears\widgets\elements\base\ObjectWidget;

/**
 * SidebarWidget dynamically show the sidebar model.
 *
 * @since 1.0.0
 */
class SidebarWidget extends ObjectWidget {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $options = [ 'class' => 'sidebar' ];

	// Background
	public $bkg			= false;
	public $bkgUrl		= null;
	public $bkgClass	= null;

	// Texture
	public $texture			= false;
	public $textureClass	= null;

	// Header
	public $header			= false;
	public $headerIcon		= false;
	public $headerIconClass	= null;
	public $headerIconUrl	= null;
	public $headerTitle		= null;

	// Content
	public $content			= false;
	public $contentTitle	= null;
	public $contentInfo		= null;
	public $contentSummary	= null;
	public $contentData		= null;

	public $contentClass		= null;
	public $contentDataClass	= null;

	// Meta
	public $attributes		= false;
	public $attributeTypes	= null;

	public $attributeWrapClass	= null;

	// Widgets
	public $widgets		= false;
	public $widgetType	= null;

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

		$this->modelService = Yii::$app->factory->get( 'sidebarService' );

		if( isset( $this->slug ) ) {

			// Find Model
			$this->model = $this->modelService->getBySlugType( $this->slug, CmsGlobal::TYPE_SIDEBAR );
		}

		if( $this->buffer ) {

			ob_start();

			ob_implicit_flush( false );
		}
    }

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

    public function renderWidget( $config = [] ) {

		// Default background class defined in css as - .bkg-sidebar { background-image: url(<image url>) }
		if( $this->bkg && !isset( $this->bkgUrl ) && !isset( $this->bkgClass ) ) {

			$this->bkgClass	= 'bkg-sidebar';
		}

		return parent::renderWidget( $config );
    }

	// SidebarWidget -------------------------

}
