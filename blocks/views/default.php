<?php
// Yii Imports
use yii\helpers\Html;

// CMG Imports
use cmsgears\core\frontend\config\SiteProperties;

use cmsgears\widgets\elements\elements\ElementWidget;

use cmsgears\core\common\utilities\CodeGenUtil;

$model	= $widget->model;
$data	= $widget->modelData;

// Admin Settings - Override widget settings to be controllable from admin.
$settings = $data->settings ?? null;

// Header -------------------

$header				= $settings->header ?? $widget->header;
$headerIcon			= $settings->headerIcon ?? $widget->headerIcon;
$headerIconClass	= !empty( $model->icon ) ? $model->icon : $widget->headerIconClass;
$headerTitle		= $settings->headerTitle && !empty( $model->displayName ) ? $model->displayName : $widget->headerTitle;
$headerInfo			= $settings->headerInfo && !empty( $model->description ) ? $model->description : $widget->headerInfo;
$headerContent		= $settings->headerContent && !empty( $model->summary ) ? $model->summary : $widget->headerContent;

$avatar			= $settings->defaultAvatar || $widget->defaultAvatar ? SiteProperties::getInstance()->getDefaultAvatar() : null;
$headerIconUrl	= !empty( $settings->headerIconUrl ) ? $settings->headerIconUrl : CodeGenUtil::getFileUrl( $model->avatar, [ 'image' => $avatar ] );
$headerIconUrl	= !empty( $headerIconUrl ) ? $headerIconUrl : $widget->headerIconUrl;

// Content ------------------

$content			= $settings->content ?? $widget->content;
$contentTitle		= $settings->contentTitle && !empty( $model->displayName ) ? $model->displayName : $widget->contentTitle;
$contentInfo		= $settings->contentInfo && !empty( $model->description ) ? $model->description : $widget->contentInfo;
$contentSummary		= $settings->contentSummary && !empty( $model->summary ) ? $model->summary : $widget->contentSummary;
$contentData		= $settings->contentData && !empty( $model->content ) ? $model->content : $widget->contentData;

$contentClass		= !empty( $settings->contentClass ) ? $settings->contentClass : $widget->contentClass;
$contentDataClass	= !empty( $settings->contentDataClass ) ? $settings->contentDataClass : $widget->contentDataClass;
$boxWrapClass		= !empty( $settings->boxWrapClass ) ? $settings->boxWrapClass : $widget->boxWrapClass;
$boxWrapper			= !empty( $settings->boxWrapper ) ? $settings->boxWrapper : $widget->boxWrapper;
$boxClass			= !empty( $settings->boxClass ) ? $settings->boxClass : $widget->boxClass;

// Footer -------------------

$footer				= $settings->footer ?? $widget->footer;
$footerIcon			= $settings->footerIcon ?? $widget->footerIcon;
$footerIconClass	= $settings->footerIconClass ?? $widget->footerIconClass;
$footerTitle		= $settings->footerTitle && !empty( $settings->footerTitleData ) ? $settings->footerTitleData : ( $settings->footerTitle && !empty( $model->displayName ) ? $model->displayName : $widget->footerTitle );
$footerInfo			= $settings->footerInfo && !empty( $settings->footerInfoData ) ? $settings->footerInfoData : ( $settings->footerInfo && !empty( $model->description ) ? $model->description : $widget->footerInfo );
$footerContent		= $settings->footerContent && !empty( $settings->footerContentData ) ? $settings->footerContentData : ( $settings->footerContent && !empty( $model->summary ) ? $model->summary : $widget->footerContent );

$footerIconUrl	= $footerIcon && !empty( $settings->footerIconUrl ) ? $settings->footerIconUrl : CodeGenUtil::getFileUrl( $model->avatar, [ 'image' => $avatar ] );
$footerIconUrl	= !empty( $footerIconUrl ) ? $footerIconUrl : $widget->footerIconUrl;

// Meta ---------------------

$attributes			= $settings->attributeData ?? $widget->attributes;
$attributeTypes		= $settings->attributeTypes ?? $widget->attributeTypes;

// Elements -----------------

$elements			= $settings->elements ?? $widget->elements;
$elementType		= $settings->elementType ?? $widget->elementType;

// Max Cover ----------------

$maxCover			= $settings->maxCover ?? $widget->maxCover;
$maxCoverClass		= $settings->maxCoverClass ?? $widget->maxCoverClass;
$maxCoverContent	= $settings->maxCoverContent ?? $widget->maxCoverContent;

// Background ---------------

$bkg			= $settings->bkg ?? $widget->bkg;
$fixedBkg		= $settings->fixedBkg ?? $widget->fixedBkg;
$scrollBkg		= $settings->scrollBkg ?? $widget->scrollBkg;
$parallaxBkg	= $settings->parallaxBkg ?? $widget->parallaxBkg;
$bkgClass		= $settings->bkgClass ?? $widget->bkgClass;

$texture		= $settings->texture ?? $widget->texture;
$textureClass	= !empty( $model->texture ) && $model->texture !== 'texture' ? $model->texture : "$widget->textureClass";

$banner		= $settings->defaultBanner || $widget->defaultBanner ? SiteProperties::getInstance()->getDefaultBanner() : null;
$bannerUrl	= CodeGenUtil::getFileUrl( $model->banner, [ 'image' => $banner ] );
$bkgUrl		= $bannerUrl ?? $widget->bkgUrl;
?>

<?php if( !empty( $bkgUrl ) ) { ?>
	<?php if( $bkg ) { ?>
		<div class="block-bkg <?= $bkgClass ?>" style="background-image:url(<?= $bkgUrl ?>);" ></div>
	<?php } ?>

	<?php if( $fixedBkg ) { ?>
		<div class="block-bkg-fixed <?= $bkgClass ?>" style="background-image:url(<?= $bkgUrl ?>);" ></div>
	<?php } ?>

	<?php if( $scrollBkg ) { ?>
		<div class="block-bkg-scroll <?= $bkgClass ?>" style="background-image:url(<?= $bkgUrl ?>);" ></div>
	<?php } ?>

	<?php if( $parallaxBkg ) { ?>
		<div class="block-bkg-parallax <?= $bkgClass ?>" style="background-image:url(<?= $bkgUrl ?>);" ></div>
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
		<div class="block-header-wrap">
			<div class="block-header">
				<?php if( $headerIcon && !empty( $headerIconClass ) && $headerIconClass !== 'icon' ) { ?>
					<div class="block-header-icon">
						<i class="<?= $headerIconClass ?>"></i>
					</div>
				<?php } ?>
				<?php if( $headerIcon && !empty( $headerIconUrl ) ) { ?>
					<div class="block-header-icon">
						<img class="fluid" src="<?= $headerIconUrl ?>" />
					</div>
				<?php } ?>
				<?php if( !empty( $headerTitle ) ) { ?>
					<div class="block-header-title"><?= $headerTitle ?></div>
				<?php } ?>
				<?php if( !empty( $headerInfo ) ) { ?>
					<div class="block-header-info reader"><?= $headerInfo ?></div>
				<?php } ?>
				<?php if( !empty( $headerContent ) ) { ?>
					<div class="block-header-content reader"><?= $headerContent ?></div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>

	<?php if( $content ) { ?>
		<div class="block-content <?= $contentClass ?>">
			<?php if( !empty( $contentTitle ) ) { ?>
				<div class="block-content-title"><?= $contentTitle ?></div>
			<?php } ?>
			<?php if( !empty( $contentInfo ) ) { ?>
				<div class="block-content-info reader"><?= $contentInfo ?></div>
			<?php } ?>
			<?php if( !empty( $contentSummary ) ) { ?>
				<div class="block-content-summary reader"><?= $contentSummary ?></div>
			<?php } ?>
			<?php if( !empty( $contentData ) ) { ?>
				<div class="block-content-data reader <?= $contentDataClass ?>"><?= $contentData ?></div>
			<?php } ?>
			<div class="block-content-buffer">
				<?php if( isset( $widget->buffer ) ) { ?>
					<?= $widget->bufferData ?>
				<?php } ?>
			</div>
			<?php if( $attributes ) { ?>
				<div class="box-content-meta">
					<?php

						$attributeTypes = preg_split( '/,/', $attributeTypes );

						if( count( $attributeTypes ) == 1 ) {

							$attributes = $model->getActiveMetasByType( $attributeTypes[ 0 ] );
						}
						else if( count( $attributeTypes ) > 1 ) {

							$attributes = $model->getActiveMetasByTypes( $attributeTypes );
						}
						else {

							$attributes = $model->activeMetas;
						}

						foreach( $attributes as $attribute ) {

							$title = isset( $attribute->label ) ? $attribute->label : ucfirst( $attribute->name );
					?>
							<div class="box-meta">
								<span class="h5 inline-block"><?= $title ?></span> - <span class="inline-block"><?= $attribute->value ?></span>
							</div>
					<?php
						}
					?>
				</div>
			<?php } ?>
			<?php if( $elements ) { ?>
				<div class="block-box-wrap <?= $boxWrapClass ?>">
					<?php
						$elements = $model->activeElements;

						if( !empty( $elementType ) ) {

							$telements	= Yii::$app->factory->get( 'elementService' )->getActiveByType( $elementType );
							$elements	= ArrayHelper::merge( $elements, $telements );
						}

						foreach( $elements as $element ) {

							$elementContent = ElementWidget::widget( [ 'model' => $element ] );

							if( !empty( $boxClass ) ) {

								echo Html::tag( $boxWrapper, $elementContent, [ 'class' => $boxClass ] );
							}
							else {

								echo $elementContent;
							}
						}
					?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if( $footer ) { ?>
		<div class="block-footer-wrap">
			<div class="block-footer">
				<?php if( $footerIcon && !empty( $footerIconClass ) ) { ?>
					<div class="block-footer-icon">
						<i class="<?= $footerIconClass ?>"></i>
					</div>
				<?php } ?>
				<?php if( $footerIcon && !empty( $footerIconUrl ) ) { ?>
					<div class="block-footer-icon">
						<img class="fluid" src="<?= $footerIconUrl ?>" />
					</div>
				<?php } ?>
				<?php if( !empty( $footerTitle ) ) { ?>
					<div class="block-footer-title"><?= $footerTitle ?></div>
				<?php } ?>
				<?php if( !empty( $footerInfo ) ) { ?>
					<div class="block-footer-info reader"><?= $footerInfo ?></div>
				<?php } ?>
				<?php if( !empty( $footerContent ) ) { ?>
					<div class="block-footer-content reader"><?= $footerContent ?></div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>
</div>
