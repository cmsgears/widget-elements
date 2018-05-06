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

	/**
	 * The slug uniquely identity the model.
	 *
	 * @var string
	 */
	public $slug;

	/**
	 * Check whether template mapped to model must be overridden by widget template.
	 * If it's set to true, the template defined in database will be ignored. The widget
	 * template will also be used in absence of database template.
	 *
	 * @var boolean
	 */
	public $forceTemplate;

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
	public $data;

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

			$template	= $this->model->template;
			$this->data	= json_decode(  $this->model->data ); // Load json object

			// Use templates defined in DB by Site Admin
			if( $this->forceTemplate && isset( $template ) ) {

				// TODO: Render using DB Template
			}
			else {

				// Pass model and data to widget view
				$widgetHtml = $this->render( $this->template, [ 'widget' => $this ] );

				// Wrap the view
				if( $this->wrap ) {

					return Html::tag( $this->wrapper, $widgetHtml, $this->options );
				}

				return $widgetHtml;
			}
		}
	}

	// ObjectWidget --------------------------

}
