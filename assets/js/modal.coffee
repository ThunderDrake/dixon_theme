((name, context, definition) ->
	context[name] = definition()
)('Modal', this, () ->
	class Modal
		constructor: (payload={}) ->
			M = @
			@config =
				title: ''
				cclass: ''
				dclass: ''
				content: ''
				buttons: []
				setClose: []
				timeout: 500
				autoopen: true
				callback: false
			for key of payload
				@config[key] = payload[key]
			rbuttons = []
			for button in @config.buttons
				inx = @config.setClose.indexOf(button)
				el = $(button)
				@config.setClose[inx] = el
				rbuttons.push el
			@config.buttons = rbuttons
			### ###
			@bg = $('<div>',{class:'modal-background hidden'})
			@config.setClose.push @bg
			@modal_container = $('<div>',{class:'modal-container hidden '+@config.cclass})
			@modal_dialog = $('<div>',{class:'modal-dialog '+@config.dclass})
			@modal_header = $('<div>',{class:'modal-header'})
			@modal_content = $('<div>',{class:'modal-content'})
			@modal_footer = $('<div>',{class:'modal-footer'})

			@modal_header_close_button = $('<button>',{class:'modal-header-close'})
			@config.setClose.push @modal_header_close_button

			@modal_header.append(@modal_header_close_button)
			@modal_header_title = $('<h3>',{class:'modal-header-title'}).html(@config.title)
			@modal_header.append(@modal_header_title)

			@modal_content.append(@config.content)

			for button in @config.buttons
				@modal_footer.append(button)

			@modal_dialog
				.append(@modal_header)
				.append(@modal_content)
				.append(@modal_footer)

			@modal_container
				.append(@modal_dialog)

			$('body')
				.append(@bg)
				.append(@modal_container)

			$(@config.setClose).each (ind,el) ->
				el.on 'click', () -> M.close()

			if @config.autoopen == true
				@open()

			if @config.callback != false and typeof @config.callback == 'function'
				@config.callback.call(@)

			return @
		open: () ->
			M = @
			setTimeout () ->
				M.bg.removeClass('hidden')
			, 50
			setTimeout () ->
				M.modal_container.removeClass('hidden')
			, 250
			# $(window).trigger('modal-open')

			return @
		close: () ->
			M = @
			@modal_header_close_button.off 'click'
			setTimeout () ->
				M.modal_container.addClass('hidden')
			, 50
			setTimeout () ->
				M.bg.addClass('hidden')
			, 250
			setTimeout () ->
				M.bg.remove()
				M.bg = null
				M.modal_container.remove()
				M.modal_container = null
				M.modal_dialog.remove()
				M.modal_dialog = null
				M.modal_header.remove()
				M.modal_header = null
				M.modal_content.remove()
				M.modal_content = null
				M.modal_footer.remove()
				M.modal_footer = null
			, @config.timeout+110
			# $(window).trigger('modal-close')

			return @

	return Modal
)