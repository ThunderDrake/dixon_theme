class Product
	constructor: () ->
		@configure()
		@init()
		return @
	configure: () ->
		@regex = /0*$/g
		@regex2 = /\.$/g
		@price = $('[data-node="price"]')
		@price_val = parseFloat(@price.data('price'))
		@form   = $('#cart-controls')
		@counts = $('input.qty',@form)
		@countp = $('button.qty-plus',@form)
		@countm = $('button.qty-minus',@form)

		@min_cnt = 1
		@max_cnt = 100
		min = @counts.attr('min')
		max = @counts.attr('max')
		if max
			@max_cnt = parseInt(max)
		if min
			@min_cnt = parseInt(min)

		@input_price = $('.count-controls input[type="hidden"][name="price"]')

		@gallery = $('.product-gallery-wrapper')
		@gallery_images = $('.product-images',@gallery)
		@gallery_thumbnails = $('.product-thumbnails',@gallery)
		@gallery_thumb_nxt = $('.swiper-button-next',@gallery)
		@gallery_thumb_prv = $('.swiper-button-prev',@gallery)
		return
	init: () ->
		@initGallery()
		@countsListener()
		@ajaxAddToCart()
		return
	initGallery: () ->
		IP = @
		if @gallery.length > 0
			config =
				loop: true
				slidesPerView: 1
				speed: 500
				effect: 'slide'
				roundLengths: true
				watchOverflow: true
			if @gallery_thumbnails.length > 0
				config['thumbs'] =
					swiper:
						el: @gallery_thumbnails
						loop: false
						slidesPerView: 3
						spaceBetween: 5
						speed: 500
						effect: 'slide'
						roundLengths: true
						watchOverflow: true
						navigation:
							nextEl: @gallery_thumb_nxt
							prevEl: @gallery_thumb_prv

			@images = new Swiper(@gallery_images,config)
	countsListener: () ->
		I = @

		@counts.on 'change', (ev) ->
			ev.stopPropagation()
			ev.preventDefault()
			I.countsListenerCallback('chk')
		@countm.on 'click', (ev) ->
			ev.stopPropagation()
			ev.preventDefault()
			I.countsListenerCallback('dcr')
		@countp.on 'click', (ev) ->
			ev.stopPropagation()
			ev.preventDefault()
			I.countsListenerCallback('icr')

		@countsListenerCallback('chk')
		return
	countsListenerCallback: (dir) ->
		val = 0
		switch dir
			when 'dcr'
				val = @counts.val()
				val--
				if val < @min_cnt
					val = @min_cnt
				@counts.val(val)
				break

			when 'icr'
				val = @counts.val()
				val++
				if val > @max_cnt
					val = @max_cnt
				@counts.val(val)
				break

			when 'chk'
				val = @counts.val()
				if val < @min_cnt
					val = @min_cnt
				if val > @max_cnt
					val = @max_cnt
				@counts.val(val)
				break

		if val <= @min_cnt
			@countm.attr('disabled','disabled')
		else
			@countm.removeAttr('disabled')
		if val >= @max_cnt
			@countp.attr('disabled','disabled')
		else
			@countp.removeAttr('disabled')

	# formatPrice: (number) ->
	# 	decimal = 2
	# 	decpoint = '.'
	# 	format_string = '# руб'
	# 	r = parseFloat(number)

	# 	exp10 = Math.pow(10,decimal)
	# 	r = Math.round(r*exp10) / exp10

	# 	rr = Number(r).toFixed(decimal).toString().split('.')

	# 	r = (if rr[1] then rr[0]+decpoint+rr[1] else rr[0])
	# 	r = r.replace(decpoint+'00','')

	# 	return format_string.replace('#', r)

	ajaxAddToCart: () ->
		P = @
		$warp_fragment_refresh =
			url: wc_cart_fragments_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_refreshed_fragments' ),
			type: 'POST',
			success: ( data ) ->
				$(document.body).trigger("added_to_cart", [data.fragments, data.cart_hash, false])
		@form.on 'submit', (e) ->
			e.preventDefault()
			product_url = window.location
			form = $(this)

			$.post product_url, form.serialize()+'&_wp_http_referer='+product_url, (result) ->
				$.ajax($warp_fragment_refresh)

$(document).ready () ->
	window.Product = new Product()