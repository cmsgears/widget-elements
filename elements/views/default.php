<?php
// CMG Imports
use cmsgears\core\frontend\config\SiteProperties;
use cmsgears\core\common\utilities\CodeGenUtil;

$model	= $widget->model;
$data	= $widget->modelData;

// Admin Settings - Override widget settings to be controllable from admin.
$settings	= $data->settings ?? null;

$bkg		= $settings->bkg ?? $widget->bkg;
$bkgClass	= $settings->bkgClass ?? $widget->bkgClass;

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

$avatar		= $widget->defaultAvatar ? SiteProperties::getInstance()->getDefaultAvatar() : null;
$avatarUrl	= CodeGenUtil::getFileUrl( $model->avatar, [ 'image' => $avatar ] );

$banner		= $widget->defaultBanner ? SiteProperties::getInstance()->getDefaultBanner() : null;
$bannerUrl	= CodeGenUtil::getFileUrl( $model->banner, [ 'image' => $banner ] );
$bkgUrl		= $bannerUrl ?? $widget->bkgUrl;
?>

<?php if( $bkg && !empty( $bkgUrl ) ) { ?>
	<div class="box-bkg <?= $bkgClass ?>" <?= "style=\"background-image:url($bkgUrl);\"" ?>></div>
<?php } ?>

<?php if( $texture ) { ?>
	<div class="<?= $textureClass ?>"></div>
<?php } ?>

<?php if( $maxCover ) { ?>
	<div class="max-cover <?= $maxCoverClass ?>">
		<?= $maxCoverContent ?>
	</div>
<?php } ?>

<div class="box-content-wrap">
	<?php if( $header ) { ?>
		<div class="box-header">
			<?php if( $headerIcon && !empty( $headerIconClass ) ) { ?>
				<div class="box-header-icon"><i class="<?= $headerIconClass ?>"></i></div>
			<?php } ?>
			<?php if( $headerIcon && !empty( $headerIconUrl ) ) { ?>
				<div class="box-header-icon"><img src="<?= $headerIconUrl ?>" /></div>
			<?php } ?>
			<?php if( !empty( $headerTitle ) ) { ?>
				<div class="box-header-title"><?= $headerTitle ?></div>
			<?php } ?>
			<?php if( !empty( $headerInfo ) ) { ?>
				<div class="box-header-info"><?= $headerInfo ?></div>
			<?php } ?>
			<?php if( !empty( $headerContent ) ) { ?>
				<div class="box-header-content"><?= $headerContent ?></div>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if( isset( $content ) ) { ?>
		<div class="box-content">
			<?= $contentData ?>
			<?php if( isset( $widget->buffer ) ) { ?>
				<?= $widget->bufferData ?>
			<?php } ?>
		</div>
	<?php } ?>

	<?php if( $footer ) { ?>
		<div class="box-footer">
			<?php if( $footerIcon && !empty( $footerIconClass ) ) { ?>
				<div class="box-footer-icon"><i class="<?= $footerIconClass ?>"></i></div>
			<?php } ?>
			<?php if( $footerIcon && !empty( $footerIconUrl ) ) { ?>
				<div class="box-footer-icon"><img src="<?= $footerIconUrl ?>" /></div>
			<?php } ?>
			<?php if( !empty( $footerTitle ) ) { ?>
				<div class="box-footer-title"><?= $footerTitle ?></div>
			<?php } ?>
			<?php if( !empty( $footerInfo ) ) { ?>
				<div class="box-footer-info"><?= $footerInfo ?></div>
			<?php } ?>
			<?php if( !empty( $footerContent ) ) { ?>
				<div class="box-footer-content"><?= $footerContent ?></div>
			<?php } ?>
		</div>
	<?php } ?>
</div>
