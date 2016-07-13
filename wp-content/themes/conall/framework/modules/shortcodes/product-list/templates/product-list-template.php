<div class="edgtf-product-list-holder <?php echo esc_attr($holder_classes) ?>">
	<div class="edgtf-product-list">
		<div class="edgtf-product-list-sizer"></div>
		<div class="edgtf-product-list-gutter"></div>
		<?php if($query_result->have_posts()): while ($query_result->have_posts()) : $query_result->the_post(); ?>
			<?php 
				$product = conall_edge_return_woocommerce_global_variable();

				$image_size = get_post_meta(get_the_ID(), 'edgtf_product_featured_image_size', true);
				if(empty($image_size)) {
					$image_size = '';
				}
			?>
			<div class="edgtf-pli <?php echo esc_html($image_size); ?> clearfix">
				<div class="edgtf-pli-inner">
					<div class="edgtf-pli-image">
						<a class="edgtf-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php if ( $product->is_on_sale() ) : ?>
								<span class="edgtf-pli-onsale"><?php esc_html_e('SALE', 'conall'); ?></span>
							<?php endif; ?>
							<?php echo get_the_post_thumbnail(get_the_ID()); ?>
						</a>
						<div class="edgtf-pli-button">
							<?php
								print sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
	                                esc_url( $product->add_to_cart_url() ),
	                                esc_attr( isset( $quantity ) ? $quantity : 1 ),
	                                esc_attr( $product->id ),
	                                esc_attr( $product->get_sku() ),
	                                esc_attr( 'edgtf-button' ),
	                                esc_html( $product->add_to_cart_text() )
	                            );
							?>
						</div>	
					</div>
					<div class="edgtf-pli-text" <?php echo conall_edge_get_inline_style($product_info_styles); ?>>
						<h5 itemprop="name" class="entry-title edgtf-pli-title"><a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
						<div class="edgtf-pli-price"><?php print $product->get_price_html(); ?></div>
					</div>
				</div>
			</div>
		<?php endwhile;	else: ?>
			<div class="edgtf-pli-messsage">
				<p><?php esc_html_e('No posts were found.', 'conall'); ?></p>
			</div>
		<?php endif;
			wp_reset_postdata();
		?>
	</div>
</div>