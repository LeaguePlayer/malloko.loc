$ () ->
	grid = $('#structure-grid')
	checkboxes = $('input:checkbox', grid)
	moveButtons = $('.actions .btn')

	checkboxes.click (e) ->
		self = $(@)
		if self.prop 'checked'
			checkboxes.not(self).prop 'checked', false
		if checkboxes.filter(':checked').size() > 0
			moveButtons.removeClass 'disabled'
		else
			moveButtons.addClass 'disabled'


	moveButtons.on 'click', (e) ->
		self = $(@)
		row = checkboxes.filter(':checked').closest '.row'
		if row.size() <= 0 || self.hasClass 'disabled'
			return false
		$.ajax
			url: self.attr 'href'
			dataType: 'json'
			type: 'POST'
			data:
				id: row.data 'id'
			success: (data) ->
				if data.success
					item = row.closest 'li'
					if data.action == 'down'
						item.next('li').after item.detach()
					else
						item.prev('li').before item.detach()
		false