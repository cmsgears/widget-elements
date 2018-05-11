<?php
// Yii Imports
use yii\helpers\ArrayHelper;

// CMG Imports
use cmsgears\core\frontend\config\SiteProperties;

use cmsgears\widgets\elements\elements\Element;

use cmsgears\core\common\utilities\CodeGenUtil;

$model	= $widget->model;
$data	= $widget->modelData;

// Admin Settings - Override widget settings to be controllable from admin.
$settings	= $data->settings ?? null;

$bkg			= $settings->bkg ?? $widget->bkg;
$fixedBkg		= $settings->fixedBkg ?? $widget->fixedBkg;
$scrollBkg		= $settings->scrollBkg ?? $widget->scrollBkg;
$parallaxBkg	= $settings->parallaxBkg ?? $widget->parallaxBkg;
$bkgClass		= $settings->bkgClass ?? $widget->bkgClass;

$texture		= $settings->texture ?? $widget->texture;
$textureClass	= !empty( $model->texture ) ? $model->texture : "texture $widget->textureClass";

$maxCover			= $settings->maxCover ?? $widget->maxCover;
$maxCoverClass		= $settings->maxCoverClass ?? $widget->maxCoverClass;
$maxCoverContent	= $settings->maxCoverContent ?? $widget->maxCoverContent;

$header				= $settings->header ?? $widget->header;
$headerIcon			= $settings->headerIcon ?? $widget->headerIcon;
$headerIconClass	= !empty( $model->icon ) ? $model->icon : $widget->headerIconClass;
$headerIconUrl		= $settings->headerIconUrl ?? $widget->headerIconUrl;
$headerTitle		= !empty( $model->title ) ? $model->title : ( !empty( $model->name ) ? $model->name : $widget->headerTitle );
$headerInfo			= !empty( $model->description ) ? $model->description : $widget->headerInfo;
$headerContent		= !empty( $model->summary ) ? $model->summary : $widget->headerContent;

$content			= $settings->content ?? $widget->content;
$contentData		= !empty( $model->content ) ? $model->content : $widget->contentData;

$footer				= $settings->footer ?? $widget->footer;
$footerIcon			= $settings->footerIcon ?? $widget->footerIcon;
$footerIconClass	= $settings->footerIconClass ?? $widget->footerIconClass;
$footerIconUrl		= $settings->footerIconUrl ?? $widget->footerIconUrl;
$footerTitle		= $settings->footerTitle ?? $model->name ?? $widget->footerTitle;
$footerInfo			= $settings->footerInfo ?? $widget->footerInfo;
$footerContent		= $settings->footerContent ?? $widget->footerContent;

$elements			= $settings->elements ?? $widget->elements;
$elementType		= $settings->elementType ?? $widget->elementType;

$avatar		= $widget->defaultAvatar ? SiteProperties::getInstance()->getDefaultAvatar() : null;
$avatarUrl	= CodeGenUtil::getFileUrl( $model->avatar, [ 'image' => $avatar ] );

$banner		= $widget->defaultBanner ? SiteProperties::getInstance()->getDefaultBanner() : null;
$bannerUrl	= CodeGenUtil::getFileUrl( $model->banner, [ 'image' => $banner ] );
$bkgUrl		= $bannerUrl ?? $widget->bkgUrl;
?>

<?php if( !empty( $bkgUrl ) ) { ?>
	<?php if( $bkg ) { ?>
		<div class="block-bkg <?= $bkgClass ?>" <?= "style=\"background-image:url($bkgUrl);\"" ?>></div>
	<?php } ?>

	<?php if( $fixedBkg ) { ?>
		<div class="block-bkg-fixed <?= $bkgClass ?>" <?= "style=\"background-image:url($bkgUrl);\"" ?>></div>
	<?php } ?>

	<?php if( $scrollBkg ) { ?>
		<div class="block-bkg-scroll <?= $bkgClass ?>" <?= "style=\"background-image:url($bkgUrl);\"" ?>></div>
	<?php } ?>

	<?php if( $parallaxBkg ) { ?>
		<div class="block-bkg-parallax <?= $bkgClass ?>" <?= "style=\"background-image:url($bkgUrl);\"" ?>></div>
	<?php } ?>
<?php } ?>

<?php if( $texture ) { ?>
	<div class="<?= $textureClass ?>"></div>
<?php } ?>

<?php if( $maxCover ) { ?>
	<div class="max-cover <?= $maxCoverClass ?>">
		<?= $maxCoverContent ?>
	</div>
<?php } ?>

<div class="block-content-wrap">
	<?php if( $header ) { ?>
		<div class="block-header">
			<?php if( $headerIcon && !empty( $headerIconClass ) ) { ?>
				<div class="block-header-icon"><i class="<?= $headerIconClass ?>"></i></div>
			<?php } ?>
			<?php if( $headerIcon && !empty( $headerIconUrl ) ) { ?>
				<div class="block-header-icon"><img src="<?= $headerIconUrl ?>" /></div>
			<?php } ?>
			<?php if( !empty( $headerTitle ) ) { ?>
				<div class="block-header-title"><?= $headerTitle ?></div>
			<?php } ?>
			<?php if( !empty( $headerInfo ) ) { ?>
				<div class="block-header-info"><?= $headerInfo ?></div>
			<?php } ?>
			<?php if( !empty( $headerContent ) ) { ?>
				<div class="block-header-content"><?= $headerContent ?></div>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if( isset( $content ) ) { ?>
		<div class="block-content">
			<?= $contentData ?>
			<?php if( isset( $widget->buffer ) ) { ?>
				<?= $widget->bufferData ?>
			<?php } ?>

			<?php if( $elements ) { ?>
				<div class="block-box-wrap">
					<?php
						$elements = $model->elements;

						if( !empty( $elementType ) ) {

							$telements	= Yii::$app->factory->get( 'elementService' )->getByType( $elementType );
							$elements	= ArrayHelper::merge( $elements, $telements );
						}

						foreach( $elements as $element ) {

							echo Element::widget( [ 'model' => $element ] );
						}
					?>
				</div>
			<?php } ?>

		</div>
	<?php } ?>

	<?php if( $footer ) { ?>
		<div class="block-footer">
			<?php if( $footerIcon && !empty( $footerIconClass ) ) { ?>
				<div class="block-footer-icon"><i class="<?= $footerIconClass ?>"></i></div>
			<?php } ?>
			<?php if( $footerIcon && !empty( $footerIconUrl ) ) { ?>
				<div class="block-footer-icon"><img src="<?= $footerIconUrl ?>" /></div>
			<?php } ?>
			<?php if( !empty( $footerTitle ) ) { ?>
				<div class="block-footer-title"><?= $footerTitle ?></div>
			<?php } ?>
			<?php if( !empty( $footerInfo ) ) { ?>
				<div class="block-footer-info"><?= $footerInfo ?></div>
			<?php } ?>
			<?php if( !empty( $footerContent ) ) { ?>
				<div class="block-footer-content"><?= $footerContent ?></div>
			<?php } ?>
		</div>
	<?php } ?>
</div>
