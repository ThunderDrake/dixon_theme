class App
	constructor: () ->
		@phoneMask = ['+', '7', ' ', '(', /\d/, /\d/, /\d/, ')', ' ', /\d/, /\d/, /\d/, '-', /\d/, /\d/, '-', /\d/, /\d/]
		@init()
	init: () ->
		@actions()
		@static()
	static: () ->
		A = @

		if typeof vanillaTextMask == 'object'
			$('input[type="tel"], input[name="phone"]').each (ind,node) ->
				vanillaTextMask.maskInput({
					inputElement: node,
					mask: A.phoneMask
				})

		@notifications()
		@initMobile()
	initMobile: () ->
		catalog_menu = $('.sidebar-holder .toggler')
		catalog_menu.on 'click', (event) ->
			event.preventDefault()
			event.stopPropagation()
			li = $(this).closest('li')
			sm = li.find('> .sub-menu')
			if li.hasClass('open')
				sm.css('display','block')
				sm.slideUp(200,() ->
					sm.removeAttr('style')
				)
				li.removeClass('open')
			else
				sm.css('display','none')
				sm.slideDown(200,() ->
					sm.removeAttr('style')
				)
				li.addClass('open')

		sidebar = $('.sidebar-holder')
		sidebar_toggle = $('.sidebar-toggle')
		sidebar_toggle.on 'click', () ->
			sidebar.toggleClass('open')

		mobile_toggler = $('#header [data-action="toggle-menu"]')
		mobile_menu = $('#header .top-line .menu-holder')
		mobile_toggler.on 'click', () ->
			mobile_menu.toggleClass('open')
			mobile_toggler.toggleClass('open')
	actions: () ->
		A = @
		$(document).on 'click', '[data-action="send"],[data-target="modal"]', (e) ->
			e.preventDefault()
			e.stopPropagation()
			callee = $(this)
			type = callee.data('action')
			A.triggerAction(type,callee)
	triggerAction: (type,callee) ->
		switch type
			when 'send'
				@sendForm(callee)
			else
				@openModal(type,callee)
	notifications: () ->
		A = @
		$(document).on 'added_to_cart', () ->
			A.createNotification('Товар добавлен в корзину')
		$(document).on 'removed_from_cart', () ->
			A.createNotification('Товар удален из корзину')
		$(document).on 'added_to_compare', () ->
			A.createNotification('Товар добавлен в сравнение')
		$(document).on 'removed_from_compare', () ->
			A.createNotification('Товар удален из сравнения')
		$(document).on 'wc_update_cart', () ->
			A.createNotification('Корзина обновлена')
	createNotification: (content) ->
		if not @notifications_block
			@notifications_block = $('<div>',{class:'notifications'})
			$('#main').append @notifications_block
		notify = $('<div>',{class:'notification'}).html(content)
		@notifications_block.append(notify)
		# setTimeout () ->
		# 	notify.fadeOut(300, () ->
		# 		notify.remove()
		# 	)
		# , 2000
	sppLink: (text='') ->
		if window.spp_link
			return '<a href="'+window.spp_link+'" target="_blank">'+text+'</a>'
		else
			return text
	sendForm: (callee) ->
		eform = callee.parents('.form')
		eform.find('.error').removeClass 'error'
		form = eform.eserialize()
		if form.status != true
			fe = $(form.error)
			setTimeout () ->
				fe.addClass 'error'
			, 10
			if window.TOtriggers
				clearTimeout(window.TOtriggers['rcerror'])

			setTimeout () ->
				fe.removeClass 'error'
			, 5000, 'rcerror'
		else
			form.data['formsubmit'] = true
			$.ajax(
				url: '/wp-json/form-send/'+form.data['type']
				processData: false
				contentType: false
				dataType: 'json'
				data: form.data
				method: 'POST'
				success: (response) ->
					config =
						title: 'Ваш запрос отправлен'
						content: ''
						buttons: []
						timeout: 400
						autoopen: true
					modal = new Modal(config)
					eform.find('input:not([type="hidden"]):not([type="checkbox"]):not([type="radio"]), textarea').val('')
				error: (response) ->
					config =
						title: 'Произошла ошибка'
						content: ''
						buttons: []
						timeout: 400
						autoopen: true
					modal = new Modal(config)
			)
	openModal: (type,callee) ->
		A = @

		container = $('<div>',{class:'form'})

		blocks = []
		
		blocks[1] = $('<div>',{class:'input'}).html('<input type="text" name="name" id="name" placeholder="Имя">')
		blocks[2] = $('<div>',{class:'input'}).html('<input type="tel" name="phone" id="phone" placeholder="Телефон*" required><div class="error-msg">Поле обязательно к заполнению</div>')

		title = 'Заказать звонок'

		switch type
			when 'request'
				title = 'Оформить заявку'
			when 'order'
				title = 'Заказать'
				product = callee.data('product')
				if product
					i = $('<input>',{'type':'hidden','name':'product','value':product})
					blocks.push(i)
			when 'buy'
				title = 'Купить'
				product = callee.data('product')
				if product
					i = $('<input>',{'type':'hidden','name':'product','value':product})
					blocks.push(i)

		spp = $('<div>',{class:'input spp-input'}).html('<input type="checkbox" id="spp" name="spp" required><label for="spp">Я согласен с '+A.sppLink('условиями обработки персональных данных')+'</label><div class="error-msg">Мы не можем принять ваше обращение без данного согласия</div>')
		blocks.push(spp)

		for block in blocks
			container
				.append(block)

		btn1 = $('<button>',{type:'submit',name:'formsubmit',value:'formsubmit'}).html('Отправить')

		config =
			title: title
			content: container
			buttons: [btn1]
			timeout: 400
			autoopen: true
		modal = new Modal(config)

		$('input[type="tel"]',container).each (ind,node) ->
			vanillaTextMask.maskInput({
				inputElement: node,
				mask: A.phoneMask
			})

		btn1.on 'click', () ->
			f = modal.modal_dialog.find('.form')
			f.find('.error').removeClass('error')
			form = f.eserialize()
			if form.status != true
				fe = $(form.error)
				setTimeout () ->
					fe.addClass 'error'
				, 10
				if window.TOtriggers
					clearTimeout(window.TOtriggers['rcerror'])

				setTimeout () ->
					fe.removeClass 'error'
				, 5000, 'rcerror'
			else
				if not form.data['type']
					form.data['type'] = type
				$.ajax(
					url: '/wp-json/form-send/'+form.data['type'],
					processData: false
					contentType: false
					dataType: 'json'
					data: form.data
					method: 'POST'
					success: (response) ->
						if response.status == 'success'
							modal.modal_header_title.html('Ваш запрос отправлен')
							modal.modal_content.remove()
							modal.modal_footer.remove()
						else
							@error(response)
					error: (response) ->
						err_config =
							title: 'Произошла ошибка'
							content: ''
							buttons: []
							timeout: 400
							autoopen: true
						err_modal = new Modal(err_config)
				)


$('document').ready () ->

	window.App = new App()