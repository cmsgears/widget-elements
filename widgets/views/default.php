<?php
// CMG Imports
use cmsgears\core\frontend\config\SiteProperties;

use cmsgears\core\common\utilities\CodeGenUtil;

$model	= $widget->model;
$data	= $widget->modelData;

// Admin Settings - Override widget settings to be controllable from admin.
$settings = $data->settings ?? null;

// Header -------------------

$header				= $settings->header ?? $widget->header;
$headerTitle		= isset( $settings ) && $settings->headerTitle && !empty( $model->displayName ) ? $model->displayName : $widget->headerTitle;

$avatar			= ( isset( $settings ) && $settings->defaultAvatar ) || $widget->defaultAvatar ? SiteProperties::getInstance()->getDefaultAvatar() : null;
$headerIconUrl	= !empty( $settings->headerIconUrl ) ? $settings->headerIconUrl : CodeGenUtil::getFileUrl( $model->avatar, [ 'image' => $avatar ] );
$headerIconUrl	= !empty( $headerIconUrl ) ? $headerIconUrl : $widget->headerIconUrl;

// Content ------------------

$content			= $settings->content ?? $widget->content;
$contentTitle		= isset( $settings ) && $settings->contentTitle && !empty( $model->displayName ) ? $model->displayName : $widget->contentTitle;
$contentInfo		= isset( $settings ) && $settings->contentInfo && !empty( $model->description ) ? $model->description : $widget->contentInfo;
$contentSummary		= isset( $settings ) && $settings->contentSummary && !empty( $model->summary ) ? $model->summary : $widget->contentSummary;
$contentData		= isset( $settings ) && $settings->contentData && !empty( $model->content ) ? $model->content : $widget->contentData;

$contentClass		= isset( $settings ) && !empty( $settings->contentClass ) ? $settings->contentClass : $widget->contentClass;
$contentDataClass	= isset( $settings ) && !empty( $settings->contentDataClass ) ? $settings->contentDataClass : $widget->contentDataClass;

// Meta ---------------------

$attributes			= $settings->attributes ?? $widget->attributes;
$attributeTypes		= $settings->attributeTypes ?? $widget->attributeTypes;

$attributeWrapClass	= isset( $settings ) && !empty( $settings->metaWrapClass ) ? $settings->metaWrapClass : $widget->attributeWrapClass;

// Background ---------------

$bkg		= $settings->bkg ?? $widget->bkg;
$bkgClass	= $settings->bkgClass ?? $widget->bkgClass;

$texture		= $settings->texture ?? $widget->texture;
$textureClass	= !empty( $model->texture ) ? $model->texture : $widget->textureClass;

$banner		= ( isset( $settings ) && $settings->defaultBanner ) || $widget->defaultBanner ? SiteProperties::getInstance()->getDefaultBanner() : null;
$bannerUrl	= CodeGenUtil::getFileUrl( $model->banner, [ 'image' => $banner ] );
$bkgUrl		= $bannerUrl ?? $widget->bkgUrl;
?>

<?php if( $bkg && !empty( $bkgUrl ) ) { ?>
	<div class="widget-bkg <?= $bkgClass ?>" style="background-image:url(<?= $bkgUrl ?>);" ></div>
<?php } ?>

<?php if( $texture ) { ?>
	<div class="<?= $textureClass ?>"></div>
<?php } ?>

<div class="widget-content-wrap">
	<?php if( $header ) { ?>
		<div class="widget-header-wrap">
			<div class="widget-header">
				<?php if( $headerIcon && !empty( $headerIconClass ) && $headerIconClass !== 'icon' ) { ?>
					<div class="widget-header-icon">
						<i class="<?= $headerIconClass ?>"></i>
					</div>
				<?php } ?>
				<?php if( $headerIcon && !empty( $headerIconUrl ) ) { ?>
					<div class="widget-header-icon">
						<img class="fluid" src="<?= $headerIconUrl ?>" />
					</div>
				<?php } ?>
				<?php if( !empty( $headerTitle ) ) { ?>
					<div class="widget-header-title"><?= $headerTitle ?></div>
				<?php } ?>
			</div>
		</div>
	<?php } ?>

	<?php if( $content ) { ?>
		<div class="widget-content <?= $contentClass ?>">
			<?php if( !empty( $contentTitle ) ) { ?>
				<div class="widget-content-title"><?= $contentTitle ?></div>
			<?php } ?>
			<?php if( !empty( $contentInfo ) ) { ?>
				<div class="widget-content-info reader"><?= $contentInfo ?></div>
			<?php } ?>
			<?php if( !empty( $contentSummary ) ) { ?>
				<div class="widget-content-summary reader"><?= $contentSummary ?></div>
			<?php } ?>
			<?php if( !empty( $contentData ) ) { ?>
				<div class="widget-content-data <?= $contentDataClass ?>"><?= $contentData ?></div>
			<?php } ?>
			<div class="widget-content-buffer">
				<?php if( isset( $widget->buffer ) ) { ?>
					<?= $widget->bufferData ?>
				<?php } ?>
			</div>
			<?php if( $attributes ) { ?>
				<div class="widget-content-meta <?= $attributeWrapClass ?>">
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
							<div class="widget-meta">
								<span class="h5 inline-block"><?= $title ?></span> - <span class="inline-block"><?= $attribute->value ?></span>
							</div>
					<?php
						}
					?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
</div>
