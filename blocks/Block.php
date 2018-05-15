<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

namespace cmsgears\widgets\elements\blocks;

// Yii Imports
use Yii;

// CMG Imports
use cmsgears\cms\common\config\CmsGlobal;

use cmsgears\widgets\elements\base\ObjectWidget;

/**
 * Block widget dynamically show the block model.
 *
 * @since 1.0.0
 */
class Block extends ObjectWidget {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $options = [ 'class' => 'block' ];

	// Background
	public $bkg			= false;
	public $fixedBkg	= false;
	public $scrollBkg	= false;
	public $parallaxBkg	= false;
	public $bkgUrl		= null;
	public $bkgClass	= null;

	// Texture
	public $texture			= false;
	public $textureClass	= null;

	// Max cover on top of block content
	public $maxCover		= false;
	public $maxCoverContent	= null;
	public $maxCoverClass	= null;

	// Block Header
	public $header			= false;
	public $headerIcon		= false;
	public $headerIconClass	= null;
	public $headerIconUrl	= null;
	public $headerTitle		= null;
	public $headerInfo		= null;
	public $headerContent	= null;

	// Block Content
	public $description		= false;
	public $summary			= false;
	public $content			= false;
	public $contentData		= null;
	public $contentClass		= null;
	public $contentDataClass	= null;
	public $boxWrapClass		= null;

	// Block Footer
	public $footer			= false;
	public $footerIcon		= false;
	public $footerIconClass	= null;
	public $footerIconUrl	= null;
	public $footerTitle		= null;
	public $footerInfo		= null;
	public $footerContent	= null;

	// Block Elements
	public $elements		= false;
	public $elementType		= null;

	// Protected --------------

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

    public function init() {

        parent::init();

		$this->modelService = Yii::$app->factory->get( 'blockService' );

		if( isset( $this->slug ) ) {

			// Find Model
			$this->model = $this->modelService->getBySlugType( $this->slug, CmsGlobal::TYPE_BLOCK );
		}

		if( $this->buffer ) {

			ob_start();

			ob_implicit_flush( false );
		}
    }

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// yii\base\Widget --------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

    public function renderWidget( $config = [] ) {

		// Default background class defined in css as - .bkg-block { background-image: url(<image url>) }
		if( $this->bkg && !isset( $this->bkgUrl ) && !isset( $this->bkgClass ) ) {

			$this->bkgClass	= 'bkg-block';
		}

		return parent::renderWidget( $config );
    }

	// Block ---------------------------------

}
