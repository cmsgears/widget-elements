<?php
// CMG Imports
use cmsgears\core\frontend\config\SiteProperties;
use cmsgears\core\common\utilities\CodeGenUtil;

$model	= $widget->model;
$data	= $widget->data;
$footer	= isset( $data->footer ) ? $data->footer : null;

$title	= !empty( $model->title ) ? $model->title : $model->name;

$avatar		= $widget->defaultAvatar ? SiteProperties::getInstance()->getDefaultAvatar() : null;
$avatarUrl	= CodeGenUtil::getFileUrl( $model->avatar, [ 'image' => $avatar ] );

$banner		= $widget->defaultBanner ? SiteProperties::getInstance()->getDefaultBanner() : null;
$bannerUrl	= CodeGenUtil::getFileUrl( $model->banner, [ 'image' => $banner ] );
?>
<div class="box">
	<div class="box-header">
		<div class="box-header-icon">
			<i class="<?= $model->icon ?>"></i>
		</div>
		<div class="box-header-title">
			<?= $title ?>
		</div>
		<div class="box-header-info">
			<?= $model->description ?>
		</div>
		<div class="box-header-content">
			<?= $model->summary ?>
		</div>
	</div>
	<div class="box-content-wrap">
		<div class="box-content">
			<?= $model->content ?>
		</div>
	</div>
	<div class="box-footer">
		<div class="box-footer-info">
			<?= isset( $footer->info ) ? $footer->info : null ?>
		</div>
		<div class="box-footer-content">
			<?= isset( $footer->content ) ? $footer->content : null ?>
		</div>
	</div>
</div>
