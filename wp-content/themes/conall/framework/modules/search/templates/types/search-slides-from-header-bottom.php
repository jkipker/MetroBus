<form action="<?php echo esc_url(home_url('/')); ?>" class="edgtf-search-slide-header-bottom" method="get">
	<?php if ( $search_in_grid ) { ?>
	<div class="edgtf-container">
		<div class="edgtf-container-inner clearfix">
			<?php } ?>
			<div class="edgtf-form-holder-outer">
				<div class="edgtf-form-holder">
					<input type="text" placeholder="<?php esc_html_e('Search', 'conall'); ?>" name="s" class="edgtf-search-field" autocomplete="off" />
					<a class="edgtf-search-submit" href="javascript:void(0)">
						<?php print $search_icon ?>
					</a>
				</div>
			</div>
			<?php if ( $search_in_grid ) { ?>
		</div>
	</div>
	<?php } ?>
</form>