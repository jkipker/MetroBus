<div class = "edgtf-portfolio-filter-holder <?php echo esc_attr($masonry_filter)?>">
	<div class = "edgtf-portfolio-filter-holder-inner">
		<?php 
		$rand_number = rand();
		if(is_array($filter_categories) && count($filter_categories)){ ?>
		<ul>
			<?php if($type == 'masonry' || $type == 'pinterest' || $type == 'masonry-with-space'){ ?>
				<li class="filter" data-filter="*"><span><?php  print esc_html__('Show All', 'edgt_core')?></span></li>
			<?php } else{ ?>
				<li data-class="filter_<?php print $rand_number ?>" class="filter_<?php print $rand_number ?>" data-filter="all"><span><?php  print esc_html__('Show All', 'edgt_core')?></span></li>
			<?php } ?>
			<?php foreach($filter_categories as $cat){				
				if($type == 'masonry' || $type == 'pinterest' || $type == 'masonry-with-space'){?>
					<li data-class="filter"  class="filter" data-filter = ".portfolio_category_<?php print $cat->term_id  ?>">
						<span data-lang="en" class="edgtf-shuffle"><?php print $cat->name ?></span>
					</li>
				<?php }else{ ?>
					<li data-class="filter_<?php print $rand_number ?>" class="filter_<?php print $rand_number ?>" data-filter = ".portfolio_category_<?php print $cat->term_id  ?>">
					<span data-lang="en" class="edgtf-shuffle"><?php print $cat->name ?></span>
				</li>
			<?php }} ?>
		</ul> 
		<?php }?>
		<?php if((($type == 'standard' || $type == 'gallery' || $type == 'showcase')) && ($change_layout == 'yes') &&($filter == 'yes')) { ?>
			<span class="edgtf-layout-changer">
				<span class="edgtf-layout-changer-inner">
					<span class="edgtf-original-layout">
						<a href="javascript:void(0)"></a>
						<span class="edgtf-cube edgtf-cube-1 active"></span>
						<span class="edgtf-cube edgtf-cube-2 active"></span>
						<span class="edgtf-cube edgtf-cube-3 active"></span>
						<span class="edgtf-cube edgtf-cube-4 edgtf-cube-bottom active"></span>
						<span class="edgtf-cube edgtf-cube-5 edgtf-cube-bottom active"></span>
						<span class="edgtf-cube edgtf-cube-6 edgtf-cube-bottom active"></span>
					</span>
					<span class="edgtf-two-columns">
						<a href="javascript:void(0)"></a>
						<span class="edgtf-cube edgtf-cube-1"></span>
						<span class="edgtf-cube edgtf-cube-2"></span>
						<span class="edgtf-cube edgtf-cube-3 edgtf-cube-bottom"></span>
						<span class="edgtf-cube edgtf-cube-4 edgtf-cube-bottom"></span>
					</span>
				</span>
			</span>
		<?php } ?>
	</div>		
</div>
