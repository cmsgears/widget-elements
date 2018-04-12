<!-- Block Background -->
<?php if( $widget->bkg ) { ?>
	<div class="block-bkg <?= $widget->bkgClass ?>" <?php if( isset( $widget->bkgUrl ) ) echo "style=\"background-image:url($widget->bkgUrl);\"" ?>></div>
<?php } ?>

<?php if( $widget->fixedBkg ) { ?>
	<div class="block-bkg-fixed <?= $widget->bkgClass ?>" <?php if( isset( $widget->bkgUrl ) ) echo "style=\"background-image:url($widget->bkgUrl);\"" ?>></div>
<?php } ?>

<?php if( $widget->scrollBkg ) { ?>
	<div class="block-bkg-scroll <?= $widget->bkgClass ?>" <?php if( isset( $widget->bkgUrl ) ) echo "style=\"background-image:url($widget->bkgUrl);\"" ?>></div>
<?php } ?>

<?php if( $widget->parallaxBkg ) { ?>
	<div class="block-bkg-parallax <?= $widget->bkgClass ?>" <?php if( isset( $widget->bkgUrl ) ) echo "style=\"background-image:url($widget->bkgUrl);\"" ?>></div>
<?php } ?>

<!-- Block Texture -->
<?php if( $widget->texture ) { ?>
	<div class="texture <?= $widget->textureClass ?>" <?php if( isset( $widget->textureUrl ) ) echo "style=\"background-image:url($widget->textureUrl);\"" ?>></div>
<?php } ?>

<!-- Block Max Cover -->
<?php if( $widget->maxCover ) { ?>
	<div class="max-cover <?= $widget->maxCoverClass ?>"><?= $widget->maxCoverContent ?></div>
<?php } ?>

<!-- Content Wrapper -->
<div class="block-content-wrap <?= $widget->contentWrapClass ?>">

	<!-- Content Header -->
	<?php if( $widget->header ) { ?>
		<div class="block-header <?=  $widget->headerClass ?>">
			<?php if( $widget->icon && strlen( $widget->iconClass ) > 0 ) { ?>
				<div class="wrap-icon"><i class="<?= $widget->iconClass ?>"></i></div>
			<?php } ?>
			<?php if( $widget->icon && strlen( $widget->iconImage ) > 0 ) { ?>
				<div class="wrap-icon"><img src="<?= $widget->iconImage ?>" /></div>
			<?php } ?>
			<div class="block-header-content"><?= $widget->headerContent ?></div>
		</div>
	<?php } ?>

	<?php if( isset( $widget->content ) ) { ?>
		<div class="block-content <?= $widget->contentClass ?>">
			<?= $widget->contentData ?>
		</div>
	<?php } ?>

	<?php if( isset( $widget->extraContent ) ) { ?>
		<?= $widget->extraContent ?>
	<?php } ?>
</div>
