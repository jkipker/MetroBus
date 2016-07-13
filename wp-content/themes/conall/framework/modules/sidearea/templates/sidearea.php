<section class="edgtf-side-menu right">
	<?php if ($show_side_area_title) {
		conall_edge_get_side_area_title();
	} ?>
	<div class="edgtf-close-side-menu-holder">
		<div class="edgtf-close-side-menu-holder-inner">
			<a href="#" target="_self" class="edgtf-close-side-menu">
				<span aria-hidden="true" class="icon_close"></span>
			</a>
		</div>
	</div>
	<?php if(is_active_sidebar('sidearea')) {
		dynamic_sidebar('sidearea');
	} ?>
</section>