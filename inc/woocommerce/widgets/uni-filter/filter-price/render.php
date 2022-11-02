<div class="filter price-filter">
	<div class="toggler open"><?=$name?></div>
	<div class="dropdown">
		<div class="price-slider">
			<div class="inputs">
				<input type="number" id="min_price-<?=$this->number?>" name="min_price" value="<?php echo esc_attr( $current_min_price ); ?>" data-min="<?php echo esc_attr( $min_price ); ?>">
				<input type="number" id="max_price-<?=$this->number?>" name="max_price" value="<?php echo esc_attr( $current_max_price ); ?>" data-max="<?php echo esc_attr( $max_price ); ?>">
			</div>
			<div id="price_slider-<?=$this->number?>" class="range-slider" data-step="<?php echo esc_attr( $step ); ?>"></div>
		</div>
	</div>
</div>