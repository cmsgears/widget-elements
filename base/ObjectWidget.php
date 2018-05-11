<?php
/**
 * This file is part of CMSGears Framework. Please view License file distributed
 * with the source code for license details.
 *
 * @link https://www.cmsgears.org/
 * @copyright Copyright (c) 2015 VulpineCode Technologies Pvt. Ltd.
 */

namespace cmsgears\widgets\elements\base;

// Yii Imports
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

// CMG Imports
use cmsgears\core\common\base\Widget;

/**
 * ObjectWidget widget dynamically show the object model.
 *
 * @since 1.0.0
 */
abstract class ObjectWidget extends Widget {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $wrap = true;

	/**
	 * The slug uniquely identity the model.
	 *
	 * @var string
	 */
	public $slug;

	/**
	 * Check whether default avatar can be used in absence of model banner.
	 *
	 * @var boolean
	 */
	public $defaultAvatar = false;

	/**
	 * Check whether default banner can be used in absence of model banner.
	 *
	 * @var boolean
	 */
	public $defaultBanner = false;

	/**
	 *
	 * @var \cmsgears\core\common\models\entities\ObjectData
	 */
	public $model;

	/**
	 * The JSON data stored in model.
	 *
	 * @var Object
	 */
	public $modelData;

	// Protected --------------

	protected $type;

	/**
	 * The model service used to find the model.
	 *
	 * @var \cmsgears\core\common\services\interfaces\entities\IObjectService
	 */
	protected $modelService;

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// yii\base\Widget --------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	/**
	 * Render the view by passing widget data to view
	 */
	public function renderWidget( $config = [] ) {

		if( isset( $this->model ) && $this->model->isActive() && $this->model->isVisible() ) {

			// Model Template
			$template = $this->model->template;

			// Model Data
			$this->modelData = json_decode( $this->model->data );

			// Use template defined by Admin
			if( isset( $template ) && $template->fileRender ) {

				$this->templateDir	= $template->viewPath;
				$this->template		= $template->view;
			}

			// Pass model and data to widget view
			$widgetHtml = $this->render( $this->template, [ 'widget' => $this ] );

			// Wrap the view
			if( $this->wrap ) {

				$htmlOptions = json_decode( $this->model->htmlOptions, true );

				$options = !empty( $this->model->htmlOptions ) ? ArrayHelper::merge( $this->options, $htmlOptions ) : $this->options;

				return Html::tag( $this->wrapper, $widgetHtml, $options );
			}

			return $widgetHtml;
		}
	}

	// ObjectWidget --------------------------

}
