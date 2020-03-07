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
use yii\helpers\Url;

// CMG Imports
use cmsgears\cms\common\config\CmsGlobal;

/**
 * Nav widget dynamically show the menu model.
 *
 * @since 1.0.0
 */
class Nav extends \cmsgears\widgets\nav\BasicNav {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $slug = 'main';

	public $view;

	// Protected --------------

	protected $menuService;

	protected $pageService;

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

	public function init() {

		parent::init();

		$this->menuService	= Yii::$app->factory->get( 'menuService' );

		$this->pageService	= Yii::$app->factory->get( 'pageService' );
	}

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// yii\base\Widget --------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

    public function renderWidget( $config = [] ) {

		$user		= Yii::$app->core->getUser();
		$menu 		= $this->menuService->getBySlugType( $this->slug, CmsGlobal::TYPE_MENU );
		$pageSlug	= Yii::$app->request->get( 'slug' );

		if( isset( $menu ) && $menu->isActive() ) {

			$links = $menu->activeLinks;

			// Collect page ids
			$pageIds = [];

			foreach( $links as $link ) {

				if( isset( $link->pageId ) ) {

					$pageIds[] = $link->pageId;
				}
			}

			// Get menu pages map
			$pages		= $this->pageService->getMenuPages( $pageIds, true );
			$baseUrl	= Yii::$app->request->absoluteUrl;

			// Generate Links
			foreach( $links as $link ) {

				$item		= null;
				$label		= empty( $link->title ) ? $link->name : $link->title;
				$icon		= $link->icon;
				$address	= null;

				if( isset( $link->pageId ) ) {

					$page	= $pages[ $link->pageId ];
					$label	= empty( $link->title ) ? $page->name : $link->title;
					$icon	= $link->icon ?? $page->icon;

					if( $page->isVisibilityPublic() || ( isset( $user ) ) ) {

						if( strcmp( $page->slug, 'home' ) == 0 ) {

							$address = Url::toRoute( [ "/" ] );
						}
						else {

							$address = Url::toRoute( [ "/$page->slug" ] );
						}

						$item = [ 'url' => $address, 'label' => $label, 'icon' => $icon ];

						if( isset( $link->htmlOptions ) ) {

							$item[ 'options' ] = json_decode( $link->htmlOptions, true );
						}

						if( isset( $link->urlOptions ) ) {

							$item[ 'urlOptions' ] = json_decode( $link->urlOptions, true );
						}

						if( isset( $pageSlug ) && strcmp( $pageSlug, $page->slug ) == 0 ) {

							$item[ 'options' ] = [ 'class' => 'active' ];
						}

						$this->items[] = $item;
					}
				}
				else {

					$item		= null;
					$address	= null;
					$urlOptions	= [];

					if( strlen( $label ) > 0 ) {

						if( !$link->user || ( isset( $user ) ) ) {

							if( $link->absolute ) {

								$address	= $link->url;
								$urlOptions	= [ 'target' => '_blank' ];
							}
							else {

								// Clean URL if first character is slash
								if( substr( $link->url, 0, 1 ) == '/' ) {

									$link->url = substr( $link->url, 1 );
								}

								$address = !empty( $link->url ) ? Url::toRoute( [ "/$link->url" ], true ) : null;
							}

							$item = [ 'url' => $address, 'label' => $label, 'icon' => $link->icon ];

							if( isset( $link->htmlOptions ) ) {

								$item[ 'options' ] = json_decode( $link->htmlOptions, true );
							}

							if( isset( $link->urlOptions ) ) {

								$item[ 'urlOptions' ] = json_decode( $link->urlOptions, true );
							}
							else {

								$item[ 'urlOptions' ] = $urlOptions;
							}

							if( $address == $baseUrl ) {

								$item[ 'options' ] = [ 'class' => 'active' ];
							}

							$this->items[] = $item;
						}
					}
				}
			}
		}

		return parent::renderWidget();
    }

	// Nav -----------------------------------

}
