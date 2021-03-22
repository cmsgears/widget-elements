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
use Yii;

// CMG Imports
use cmsgears\cms\common\config\CmsGlobal;

/**
 * SocialNav widget dynamically show the menu model with social links.
 *
 * @since 1.0.0
 */
class SocialNav extends \cmsgears\widgets\nav\BasicNav {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $label	= false;
	public $icon	= true;

	public $slug = 'social';

	public $view;

	// Protected --------------

	protected $menuService;

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	public function init() {

		parent::init();

		$this->menuService = Yii::$app->factory->get( 'menuService' );
	}

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// yii\base\Widget --------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

    public function renderWidget( $config = [] ) {

		$menu = $this->menuService->getBySlugType( $this->slug, CmsGlobal::TYPE_MENU );

		if( isset( $menu ) && $menu->isActive() ) {

			$links = $menu->activeLinks;

			// Generate Links
			foreach( $links as $link ) {

				if( $link->active ) {

					$urlOptions	= [];

					$address	= $link->url;
					$urlOptions	= [ 'target' => '_blank' ];
					$urlOptions	= [ 'title' => $link->title ];

					$item = [ 'url' => $address, 'label' => null, 'icon' => $link->icon ];

					if( isset( $link->htmlOptions ) ) {

						$item[ 'options' ] = json_decode( $link->htmlOptions, true );
					}

					if( isset( $link->urlOptions ) ) {

						$item[ 'urlOptions' ] = json_decode( $link->urlOptions, true );
					}
					else {

						$item[ 'urlOptions' ] = $urlOptions;
					}

					$this->items[] = $item;
				}
			}
		}

		return parent::renderWidget();
    }

	// SocialNav -----------------------------

}
