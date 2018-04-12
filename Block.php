<?php
namespace cmsgears\widgets\elements\block;

// Yii Imports
use Yii;

class Block extends \cmsgears\widgets\block\BasicBlock {

	// Variables ---------------------------------------------------

	// Globals -------------------------------

	// Constants --------------

	// Public -----------------

	// Protected --------------

	// Variables -----------------------------

	// Public -----------------

	public $templateDir	= '@cmsgears/widget-elements/views/block';

	public $slug;

	public $block;
	public $videoUrl;

	// Protected --------------

	protected $blockService;

	// Private ----------------

	// Traits ------------------------------------------------------

	// Constructor and Initialisation ------------------------------

    public function init() {

        parent::init();

		$this->blockService	= Yii::$app->factory->get( 'blockService' );

		$this->block 		= $this->blockService->getBySlug( $this->slug );

		if( isset( $this->block ) && $this->block->active ) {

			if( strlen( $this->block->content ) > 0 ) {

				$this->contentData		= $this->block->content;
			}

			$banner		= $this->block->banner;
			$video      = $this->block->video;

			if( isset( $banner ) ) {

				$this->bkgUrl	= $banner->getFileUrl();
			}

			if( isset( $video ) ) {

				$this->videoUrl	= $video->getFileUrl();
			}

			$this->iconClass		= $this->block->icon;
			$this->title			= $this->block->title;
			$this->headerContent	= $this->title;
			$this->description		= $this->block->description;
		}
    }

	// Instance methods --------------------------------------------

	// Yii interfaces ------------------------

	// Yii parent classes --------------------

	// yii\base\Widget --------

	// CMG interfaces ------------------------

	// CMG parent classes --------------------

	public function renderWidget( $config = [] ) {

		if( isset( $this->block ) && $this->block->active ) {

			return parent::renderWidget( $config );
		}
	}

	// DynamicBlock --------------------------

}
