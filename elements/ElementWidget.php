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
 * ElementWidget dynamically show the element model.
 *
 * @since 1.0.0
 */
class ElementWidget extends ObjectWidget {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $options = [ 'class' => 'box' ];

	// Background
	public $bkg			= false;
	public $bkgUrl		= null;
	public $bkgClass	= null;

	// Texture
	public $texture			= false;
	public $textureClass	= null;

	// Max cover on top of content
	public $maxCover		= false;
	public $maxCoverContent	= null;
	public $maxCoverClass	= null;

	// Header
	public $header			= false;
	public $headerIcon		= false;
	public $headerIconClass	= null;
	public $headerIconUrl	= null;
	public $headerTitle		= null;
	public $headerInfo		= null;
	public $headerContent	= null;

	// Content
	public $content			= false;
	public $contentTitle	= null;
	public $contentInfo		= null;
	public $contentSummary	= null;
	public $contentData		= null;

	public $contentClass		= null;
	public $contentDataClass	= null;

	// Footer
	public $footer			= false;
	public $footerIcon		= false;
	public $footerIconClass	= null;
	public $footerIconUrl	= null;
	public $footerTitle		= null;
	public $footerInfo		= null;
	public $footerContent	= null;

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

		if( $this->buffer ) {

			ob_start();

			ob_implicit_flush( false );
		}
    }

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

    public function renderWidget( $config = [] ) {

		// Default background class defined in css as - .bkg-element { background-image: url(<image url>) }
		if( $this->bkg && !isset( $this->bkgUrl ) && !isset( $this->bkgClass ) ) {

			$this->bkgClass	= 'bkg-element';
		}

		return parent::renderWidget( $config );
    }

	// Element -------------------------------

}
