
$grid = $('#structure-grid')

$('a.expand-button', $grid).on 'click', (e) ->
	_this = $(@)
	childrenlist = _this.closest('li').children('ul')
	if _this.hasClass 'open'
		childrenlist.hide()
		_this.removeClass('open').find('i').attr 'class', 'icon-plus'
	else
		childrenlist.show()
		_this.addClass('open').find('i').attr 'class', 'icon-minus'
	false


checkboxes = $('input:checkbox', $grid)
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
				switch data.action
					when 'down' then item.next('li').after item.detach()
					when 'up' then item.prev('li').before item.detach()
					when 'toNext'
						nextRow = $('.row', item.next('li')).first()
						ul = nextRow.next('ul').show()
						if ul.size() <= 0
							ul = $('<ul />')
							nextRow.after ul
						ul.prepend item.detach()
						$('.cell.name', item).prepend('<span class="offset"></span>')
						$('.expand-button', nextRow).first().addClass('open').find('i').attr('class', 'icon-minus')
					when 'toParent'
						ul = item.closest('ul')
						prevRow = ul.prev('.row')
						ul.closest('li').before item.detach()
						$('.cell.name', item).each (index) ->
							$('.offset', $(@)).first().remove()
						if $('li', ul).size() <= 0
							ul.remove()
							$('.expand-button', prevRow).first().remove()


	false