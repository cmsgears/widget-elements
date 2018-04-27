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

use cmsgears\cms\common\models\forms\Link;
use cmsgears\cms\common\models\forms\PageLink;

use cmsgears\widgets\nav\BasicNav;

/**
 * Nav widget dynamically show the menu model.
 *
 * @since 1.0.0
 */
class Nav extends BasicNav {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $slug	= 'main';

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

		$user		= Yii::$app->user->getIdentity();
		$menu 		= $this->menuService->getBySlugType( $this->slug, CmsGlobal::TYPE_MENU );
		$pageSlug	= Yii::$app->request->get( 'slug' );

		if( isset( $menu ) && $menu->active ) {

			$pageLinks		= $this->menuService->getPageLinks( $menu, true );
			$pageLinks		= array_keys( $pageLinks );
			$pages			= $this->pageService->getMenuPages( $pageLinks, true );
			$menuItems		= $menu->generateObjectFromJson( true );
			$menuItems		= $menuItems->links;
			$absoluteUrl	= Yii::$app->request->absoluteUrl;

			foreach ( $menuItems as $menuItem ) {

				if( strcmp( $menuItem[ 'type' ], CmsGlobal::TYPE_PAGE ) == 0 ) {

					$link		= new PageLink( $menuItem );
					$item		= null;
					$address	= null;

					if( isset( $pages[ $link->pageId ] ) ) {

						$page	= $pages[ $link->pageId ];

						if( $page->isVisibilityPublic() || ( isset( $user ) ) ) {

							if( strcmp( $page->slug, 'home' ) == 0 ) {

								$address	= Url::toRoute( [ "/" ] );
							}
							else {

								$address	= Url::toRoute( [ "/$page->slug" ] );
							}

							$item		= [ 'url' => $address, 'label' => $page->name, 'icon' => $page->icon ];

							if( isset( $link->htmlOptions ) ) {

								$item[ 'options' ] = json_decode( $link->htmlOptions, true );
							}

							if( isset( $link->urlOptions ) ) {

								$item[ 'urlOptions' ] = json_decode( $link->urlOptions, true );
							}

							if( isset( $pageSlug ) && strcmp( $pageSlug, $page->slug ) == 0 ) {

								$item[ 'options' ] = [ 'class' => 'active' ];
							}

							$this->items[]	= $item;
						}
					}
				}
				else if( strcmp( $menuItem[ 'type' ], CmsGlobal::TYPE_LINK ) == 0 ) {

					$link		= new Link( $menuItem );
					$item		= null;
					$address	= null;

					if( strlen( $link->label ) > 0 ) {

						if( $link->isPublic() || ( isset( $user ) ) ) {

							if( $link->relative ) {

								// Clean URL if first character is slash
								if( substr( $link->address, 0, 1 ) == "/" ) {

									$link->address	= substr( $link->address, 1 );
								}

								$address	= Url::toRoute( [ "/$link->address" ], true );
							}
							else {

								$address			= $link->address;
                                $link->urlOptions  	= json_encode( [ 'target' => '_blank' ] );
							}

							$item		= [ 'url' => $address, 'label' => $link->label, 'icon' => $link->icon ];

							if( isset( $link->htmlOptions ) ) {

								$item[ 'options' ] = json_decode( $link->htmlOptions, true );
							}

							if( isset( $link->urlOptions ) ) {

								$item[ 'urlOptions' ] = json_decode( $link->urlOptions, true );
							}

							if( strcmp( $address, $absoluteUrl ) == 0 ) {

								$item[ 'options' ] = [ 'class' => 'active' ];
							}

							$this->items[]	= $item;
						}
					}
				}
			}
		}

		return parent::renderWidget();
    }

	// DynamicNav ----------------------------
}
