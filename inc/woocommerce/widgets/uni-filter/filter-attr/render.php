<div class="filter attr-filter">
	<div class="toggler"><?=$name?></div>
	<div class="dropdown">
		<div class="checkbox-inputs">
		<?php
			global $wp;
			$found = false;

			if ( $taxonomy !== $this->get_current_taxonomy() ) {
				$term_counts          = $this->get_filtered_term_product_counts( wp_list_pluck( $terms, 'term_id' ), $taxonomy );
				$_chosen_attributes   = $this->get_filter_chosen_attributes();
				$taxonomy_filter_name = wc_attribute_taxonomy_slug( $taxonomy );
				$taxonomy_label       = wc_attribute_label( $taxonomy );

				$current_values = isset( $_chosen_attributes[ $taxonomy ] ) ? $_chosen_attributes[ $taxonomy ] : array();
			}

			foreach($terms as $term)
			{
				if ( $term->term_id === $this->get_current_term_id() ) {
					continue;
				}

				// Get count based on current view.
				$option_is_set = in_array( strval($term->slug), $current_values, true );
				$count         = isset( $term_counts[ $term->term_id ] ) ? $term_counts[ $term->term_id ] : 0;

				// Only show options with count > 0.
				if ( 0 < $count ) {
					$found = true;
				} elseif ( 0 === $count && ! $option_is_set ) {
					continue;
				}

				if('color' == $display_type)
				{
					$multicolor = get_term_meta($term->term_id,'multicolor',true);
					$color = get_term_meta($term->term_id,'color',true);
					$data_color = ($multicolor) ? 'url('.get_template_directory_uri().'/assets/images/multicolor.png)' : $color;
				?>
				<div class="input bordered">
					<input id="cf_<?=esc_html( $taxonomy_filter_name )?>-<?=esc_html( $term->slug )?>" type="checkbox" name="cf_<?=esc_html( $taxonomy_filter_name )?>[]" value="<?=esc_html( $term->slug )?>" <?=checked( $option_is_set, true, false )?>>
					<label for="cf_<?=esc_html( $taxonomy_filter_name )?>-<?=esc_html( $term->slug )?>">
						<span class="visual" style="background:<?=$data_color?>;"></span>
						<span><?=esc_html( $term->name )?></span>
					</label>
				</div>
				<?php
				}
				else
				{
				?>
				<div class="input bordered">
					<input id="cf_<?=esc_html( $taxonomy_filter_name )?>-<?=esc_html( $term->slug )?>" type="checkbox" name="cf_<?=esc_html( $taxonomy_filter_name )?>[]" value="<?=esc_html( $term->slug )?>" <?=checked( $option_is_set, true, false )?>>
					<label for="cf_<?=esc_html( $taxonomy_filter_name )?>-<?=esc_html( $term->slug )?>">
						<span><?=esc_html( $term->name )?></span>
					</label>
				</div>
				<?php
				}
			}
		?>
		</div>
	</div>
</div>
<?php return $found; ?>