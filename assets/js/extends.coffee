$.fn.exists = () ->
	return @length>0
$.fn.eserialize = (selector='') ->
	formData = new FormData()
	error_obj = []
	all = true
	phone_mask = /^\+7\s\(\d{3}\)\s\d{3}\-\d{2}\-\d{2}$/
	if selector == ''
		selector = 'input, textarea, select, button[type="submit"]'
	@.find(selector).each (index,input) ->
		if input.value != ''
			if input.getAttribute('type') == 'tel'
				if not phone_mask.test(input.value)
					error_obj.push input
					all = false
				else
					formData.append(input.name,input.value)
			else if input.getAttribute('type') == 'file'
				formData.append(input.name,input.files[0])
			else if input.getAttribute('type') == 'checkbox'
				if input.checked == true
					formData.append(input.name,input.value)
				else
					if input.getAttribute('required') != null
						error_obj.push input
						all = false
			else if input.getAttribute('type') == 'radio'
				if input.checked == true
					formData.append(input.name,input.value)
			else
				formData.append(input.name,input.value)
			return true
		else
			if input.getAttribute('required') != null
				error_obj.push input
				all = false
			return true
	return {status:all, data:formData, error:error_obj}
$.fn.scrollto = () ->
	obj = @.eq(0)
	selector = obj.data('anchor')
	is_safari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent)

	if is_safari
		container = document.body
	else
		container = document.documentElement

	scrolled_to_top = container.scrollTop
	scroll_height = container.scrollHeight

	offset_to_top = $('[data-scrolltarget="'+selector+'"]')
	if offset_to_top.exists()
		offset_to_top = offset_to_top.get(0).getBoundingClientRect().top
		height = scroll_height - window.innerHeight

		if (scrolled_to_top + offset_to_top) > height then stop_h = height else stop_h = scrolled_to_top + offset_to_top
		qr = scrolled_to_top
		c = 0
		step = (time) ->
			if offset_to_top < 0
				r = Math.max((container.scrollTop - 55), stop_h)
			else
				r = Math.min((container.scrollTop + 55), stop_h)

			container.scrollTop = r

			if r != stop_h and c < 5
				if r == qr
					c++
				else
					c = 0
					qr = r
				requestAnimationFrame(step)
		requestAnimationFrame(step)
	return

window.TOtriggers = []
origSetTimeout = window.setTimeout
window.setTimeout = (callback,timeout,mark=null) ->
	if mark
		window.TOtriggers[mark] = origSetTimeout(callback,timeout)
	else
		origSetTimeout(callback,timeout)