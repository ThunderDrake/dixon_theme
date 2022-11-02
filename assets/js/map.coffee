class Map
	constructor: (container,data) ->
		@params = data
		@map = null
		@container = $(container).get(0)
		if !('ymaps_loading' in window)
			window.ymaps_loading = false
		if !('google_loading' in window)
			window.google_loading = false
		@init()
		return @
	init: () ->
		switch @params.type
			when 'yandex'
				@initYandex()
				break
			when 'google'
				@initGoogle()
				break
		return @
	inited: () ->
		if 'MapInited' of window
			for key,func of window.MapInited
				func(@)
	## ## ##
	_loadScript: (url, params, callback=false) ->
		exists = $('script[src="' + url + '"]')
		params = params || {}
		if exists.length == 0
			script = document.createElement('script')
			script.type = 'text/javascript'
			if script.readyState
				script.onreadystatechange = () ->
					if script.readyState == 'loaded' || script.readyState == 'complete'
						script.onreadystatechange = null
						if callback
							callback()
						else
							return true
			else
				script.onload = () ->
					if callback
						callback()
					else
						return true
			scriptsProperties = ['type', 'src', 'htmlFor', 'event', 'charset', 'async', 'defer', 'crossOrigin', 'text', 'onerror']
			if typeof params == 'object' && !$.isEmptyObject(params)
				for key of params
					if params.hasOwnProperty(key) && $.inArray(key, scriptsProperties)
						script[key] = params[key]
			script.src = url
			target = if params['lazyLoad'] then 'body' else 'head'
			document.getElementsByTagName(target)[0].appendChild(script)
		else
			if callback
				callback()
			else
				return true
	loadScript: () ->
		M = @
		switch @params.type
			when 'yandex'
				if window.ymaps_loading == false
					window.ymaps_loading = true
					setTimeout () ->
						M._loadScript('https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=' + yandex_api_key)
					, 2500
				break
			when 'google'
				if window.google_loading == false
					window.google_loading = true
					setTimeout () ->
						M._loadScript('https://maps.googleapis.com/maps/api/js?key=' + google_api_key)
					, 2500
				break
		return
	## ## ##
	initYandex: () ->
		M = @
		if typeof ymaps != 'undefined'
			ymaps.ready(@buildYandex,@)
		else
			@loadScript()
			setTimeout () ->
				M.initYandex()
			, 100
	initGoogle: () ->
		M = @
		if typeof google != 'undefined'
			@buildGoogle()
		else
			@loadScript()
			setTimeout () ->
				M.initGoogle()
			, 100
	## ## ##
	buildYandex: () ->
		M = @
		az = false
		if M.params.zoom == 'auto'
			az = true
			zoom = 16
		else
			zoom = parseFloat(M.params.zoom)
		if M.params.center
			center = M.params.center.split(/\s*,\s*/)
			center = [parseFloat(center[0]), parseFloat(center[1])]
		else
			center = false
		mapState =
			zoom: zoom
			center: center
			controls: []
		mapOptions = 
			suppressMapOpenBlock: true
			yandexMapDisablePoiInteractivity: true

		if not 'balloon' of M.params
			M.params.balloon = true

		M.map = new ymaps.Map(M.container, mapState, mapOptions)
		M.map.behaviors.disable('scrollZoom')
		M.map.controls.add('zoomControl')
		M.parseMarkersYandex()
		if az
			M.map.setBounds(M.map.geoObjects.getBounds())

		@inited()
		return
	buildGoogle: () ->
		M = @
		center = M.params.center.split(/\s*,\s*/)
		center = { 'lat': parseFloat(center[0]), 'lng': parseFloat(center[1]) }
		mapOptions =
			zoom: parseFloat(M.params.zoom)
			center: center
			disableDefaultUI: true
			scrollwheel: false
			zoomControl: true
			scaleControl: false
			mapTypeId: 'roadmap'
		M.map = new google.maps.Map(M.container, mapOptions)
		M.parseMarkersGoogle()
		@inited()
		return
	## ## ##
	parseMarkersYandex: () ->
		M = @
		for index,mark of M.params.markers
			if mark.type == 'Point'
				M.appendYandexMarker(mark)
			if mark.type == 'Circle'
				M.appendYandexCircle(mark)
	parseMarkersGoogle: () ->
		M = @
		for index,mark of M.params.markers
			if mark.type == 'Point'
				M.appendGoogleMarker(mark)
			if mark.type == 'Circle'
				M.appendGoogleCircle(mark)
	## ## ##
	appendYandexMarker: (mark) ->
		M = @
		if M.params.icon
			marker = new ymaps.Placemark(
				mark.coords,
				{
					iconCaption: mark.name,
					balloonContent: mark.name+'<br>'+mark.content
				},
				{
					hasBalloon: M.params.balloon
					iconLayout: 'default#image'
					iconImageHref: M.params.icon.url
					iconImageSize: [M.params.icon.width, M.params.icon.height]
					iconImageOffset: [-M.params.icon.w_offset, -M.params.icon.h_offset]
				}
			)
		else
			marker = new ymaps.Placemark(
				mark.coords,
				{
					iconCaption: mark.name
					balloonContent: mark.name+'<br>'+mark.content
					iconContent: mark.name
				},
				{
					hasBalloon: M.params.balloon
					preset:'islands#blueStretchyIcon'
				}
			)
		return M.map.geoObjects.add(marker)
	appendGoogleMarker: (mark) ->
		M = @
		marker = new google.maps.Marker(
			map: M.map
			position: {'lat':parseFloat(mark.coords[0]), 'lng':parseFloat(mark.coords[1]) }
			title: M.params.title
			icon: M.params.icon
		)
		if mark.content != ''
			infoWindow = new google.maps.InfoWindow({content: mark.content})
			marker.addListener 'click', () ->
				infoWindow.open(M.map, marker)
	## ## ##
	appendGoogleCircle: (mark) ->
		M = @
		circle = new google.maps.Circle(
			map: M.map
			center: {'lat':parseFloat(mark.coords[0]), 'lng':parseFloat(mark.coords[1]) }
			radius: mark.circle_size
			strokeColor: '#de3b3c'
			strokeWeight: 2
			strokeOpacity: 0.8
			fillColor: '#de3b3c'
			fillOpacity: 0.35
		)
		if mark.content != ''
			infoWindow = new google.maps.InfoWindow({content: mark.content})
			circle.addListener 'click', () ->
				infoWindow.open(M.map, circle)
	appendYandexCircle: (mark) ->
		M = @
		circle = new ymaps.Circle(
			[mark.coords, mark.circle_size],
			{
				balloonContent: mark.name+'<br>'+mark.content
			},
			{
				hasBalloon: M.params.balloon
				draggable: false
				fillColor: "#de3b3c59"
				strokeColor: "#de3b3c"
				strokeOpacity: 0.8
				strokeWidth: 2
			}
		)
		return M.map.geoObjects.add(circle)

$(document).ready () ->
	window.jsmaps = {}
	if window.MapData
		for container,data of window.MapData
			window.jsmaps[container] = new Map(container,data)