function Area(data){
	var self = this;

	this.id = data.id;
	this.name = data.name;
}

function AreaViewModel() {
	var self = this;
    // Editable data
    self.areas = ko.observableArray();

    //initialize
    $.getJSON("/admin/area/getAreas", function(allData) {
    	console.log(allData);
        var mappedTasks = $.map(allData, function(item) { return new Area(item) });
        self.areas(mappedTasks);
    });

    // Operations
    self.addArea = function() {self.areas.push(new Area({id: "", name: ""}));}
    self.remove = function(area) { self.areas.destroy(area); };
    self.save = function(){
    	self.areas.remove(function(item) {return item.name.length == 0; });

	    var data = ko.toJSON({ Areas: self.areas });
	    console.log(data);

        $('#save').addClass('disabled');
        $('.alert-success').hide();

    	$.post("/admin/area", data, function(returnedData) {
    		$('#save').removeClass('disabled');
            $('.alert-success').fadeIn(1000);
		});
    }
}

// Activates knockout.js
ko.applyBindings(new AreaViewModel());