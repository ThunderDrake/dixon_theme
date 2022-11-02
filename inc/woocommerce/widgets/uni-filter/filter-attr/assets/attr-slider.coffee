jQuery( ( $ ) ->

	class ThemeAttrFilter
		constructor: ( $range ) ->
			range = $($range)
			range_i = range.find('.range-slider')
			input = range_i.get(0)
			input_min = range.find('input[name=^"min_"]')
			input_max = range.find('input[name=^"max_"]')

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

	$.fn.theme_attr_filter = () ->
		new ThemeAttrFilter( this )
		return this

	$( document.body ).ready () ->
		$('.attr-slider').each () ->
			$( this ).theme_attr_filter()
)