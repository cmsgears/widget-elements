<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

namespace cmsgears\widgets\elements;

// Yii Imports
use \Yii;
use yii\helpers\Html;

// CMG Imports
use cmsgears\core\common\config\CoreGlobal;
use cmsgears\cms\common\config\CmsGlobal;

use cmsgears\core\common\base\Widget;

/**
 * Element widget dynamically show the element model.
 *
 * @since 1.0.0
 */
class Element extends Widget {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $slug			= null;
	public $adminTemplate	= true;

	// Protected --------------

	protected $data = null;

	protected $widgetService;

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// yii\base\Widget --------

    public function init() {

        parent::init();

		$this->widgetService	= Yii::$app->factory->get( 'widgetService' );

		if( isset( $this->slug ) ) {

			// Find Model
			$model		= $this->widgetService->getBySlugType( $this->slug, CmsGlobal::TYPE_WIDGET );

			if( isset( $model ) && $model->active ) {

				$template		= $model->template;
				$this->data		= $model->data;

				// Use templates defined in DB by Site Admin
				if( isset( $template ) && $this->adminTemplate ) {

					$this->templateDir	= Yii::$app->templateManager->getRenderPath( $template );
					$this->template		= CoreGlobal::TEMPLATE_VIEW_PUBLIC;
				}
			}
		}
    }

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	/**
	 * Render the view by passing widget data to view
	 */
	public function renderWidget( $config = [] ) {

		if( isset( $this->data ) ) {

			$widgetData	= json_decode( $this->data, true );

			$content	= $this->render( $this->template, [ 'data' => $widgetData ] );

			return Html::tag( 'div', $content, $this->options );
		}
	}

	// Element -------------------------------

}
