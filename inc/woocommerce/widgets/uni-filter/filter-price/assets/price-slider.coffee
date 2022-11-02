jQuery( ( $ ) ->

	class ThemePriceFilter
		constructor: ( $range ) ->
			range = $($range)
			range_i = range.find('.range-slider')
			input = range_i.get(0)
			input_min = range.find('input[name="min_price"]')
			input_max = range.find('input[name="max_price"]')

			min = parseInt(input_min.data('min'))
			max = parseInt(input_max.data('max'))

			min_v = parseInt(input_min.val())
			max_v = parseInt(input_max.val())

			step = parseInt(range_i.data('step'))

			noUiSlider.create input,
				start: [min_v,max_v]
				connect: true
				step: step
				orientation: "horizontal"
				tooltips: false
				format: wNumb({
					decimals: filter_price_slider_params.currency_format_num_decimals
					mark: filter_price_slider_params.currency_format_decimal_sep
					thousand: filter_price_slider_params.currency_format_thousand_sep
					prefix: filter_price_slider_params.currency_format.prefix
					suffix: filter_price_slider_params.currency_format.suffix
				})
				range:
					'min': min
					'max': max

			# on range change we change inputs values
			inputs = [input_min,input_max]
			input.noUiSlider.on 'update', (values, index) ->
				v = values[index]+''
				v = v.replace(/\s/g, "")
				inputs[index].val parseInt(v)

			# on inputs change we change range values
			$(inputs).each (index,field) ->
				$(field).on 'change', () ->
					v = [null,null]
					v[index] = $(this).val()
					input.noUiSlider.set(v)

	$.fn.theme_price_filter = () ->
		new ThemePriceFilter( this )
		return this

	$( document.body ).ready () ->
		$('.price-slider').each () ->
			$( this ).theme_price_filter()
)

	# # keyboard range handles control
	# handlers = range.find('.noUi-handle')

	# handlers.each (index,handler) ->
	# 	$(handler).on 'keydown', (e) ->
	# 		v = [null,null]
	# 		q = parseInt(inputs[index].val())

	# 		switch e.which
	# 			when 37
	# 				v[index] = q - 100
	# 				range_i.noUiSlider.set( v )
	# 			when 39
	# 				v[index] = q + 100
	# 				range_i.noUiSlider.set( v )