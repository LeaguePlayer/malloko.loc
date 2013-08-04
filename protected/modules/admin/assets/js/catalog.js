var myMap, myPlacemark, coords;

console.log(myPlacemark == undefined);
ymaps.ready(init);

function init () {

	//Определяем начальные параметры карты
	myMap = new ymaps.Map('YMapsID', {
        center: [57.182636, 65.558421], 
        zoom: 10, 
		behaviors: ['default', 'scrollZoom']
    });


/*	//Определяем элемент управления поиск по карте	
	var SearchControl = new ymaps.control.SearchControl({noPlacemark:true});
	console.log(SearchControl);	*/

	//Добавляем элементы управления на карту
	 myMap.controls
		//.add(SearchControl)                
	    .add('zoomControl')                
	    //.add('typeSelector')                 
	    .add('mapTools');

	//Отслеживаем событие щелчка по карте
	myMap.events.add('click', function (e) {        
		coords = e.get('coordPosition');
		setCoords(coords);
		$('form .coords').val(coords);
	});

	if($('form .coords').val().length > 0){
		myMap.setZoom(16);
		myMap.setCenter($('form .coords').val().split(','));
		setCoords($('form .coords').val().split(','));
	}
		
/*	coords = [65.558421,57.182636];

	//Определяем метку и добавляем ее на карту				
	myPlacemark = new ymaps.Placemark([65.558421,57.182636],{}, {preset: "twirl#redIcon", draggable: true});	

	myMap.geoObjects.add(myPlacemark);			

	//Отслеживаем событие перемещения метки
	myPlacemark.events.add("dragend", function (e) {			
	coords = this.geometry.getCoordinates();
	savecoordinats();
	}, myPlacemark);

	//Отслеживаем событие щелчка по карте
	myMap.events.add('click', function (e) {        
	coords = e.get('coordPosition');
	savecoordinats();
	});	

	//Отслеживаем событие выбора результата поиска
	SearchControl.events.add("resultselect", function (e) {
		coords = SearchControl.getResultsArray()[0].geometry.getCoordinates();
		savecoordinats();
	});

	//Ослеживаем событие изменения области просмотра карты - масштаб и центр карты
	myMap.events.add('boundschange', function (event) {
	if (event.get('newZoom') != event.get('oldZoom')) {		
	    savecoordinats();
	}
	  if (event.get('newCenter') != event.get('oldCenter')) {		
	    savecoordinats();
	}

	});*/
		
}

$('form .address').blur(function(){
	var address = $(this).val();

	if(address.length > 0){
		var myGeocoder = ymaps.geocode("Тюмень, " + address);

		myGeocoder.then(
			function (res) {
				var coords = res.geoObjects.get(0).geometry.getCoordinates();
				//console.log(res.geoObjects.get(0).geometry.getCoordinates());
				myMap.setZoom(16);
				myMap.setCenter(coords);
		        setCoords(coords);

		        $('form .coords').val(coords);
		    },
		    function (err) {
		        alert('Ошибка');
		});
	}
});

function setCoords(coords){
	if(myPlacemark == undefined){
		getPlaceMark(coords);
	}else{
		myPlacemark.getOverlay().getData().geometry.setCoordinates(coords);
	}
}

function getPlaceMark(coords){
	if(myPlacemark == undefined){
		myPlacemark = new ymaps.Placemark(coords,{}, {preset: "twirl#redIcon", draggable: true});

		//Отслеживаем событие перемещения метки
		myPlacemark.events.add("dragend", function (e) {			
			coords = this.geometry.getCoordinates();
			$('form .coords').val(coords);
		}, myPlacemark);

		myMap.geoObjects.add(myPlacemark);
	}		

	return myPlacemark;
}

//Функция для передачи полученных значений в форму
function savecoordinats (){	
var new_coords = [coords[0].toFixed(4), coords[1].toFixed(4)];	
myPlacemark.getOverlay().getData().geometry.setCoordinates(new_coords);
//document.getElementById("latlongmet").value = new_coords;
//document.getElementById("mapzoom").value = myMap.getZoom();
var center = myMap.getCenter();
var new_center = [center[0].toFixed(4), center[1].toFixed(4)];	
//document.getElementById("latlongcenter").value = new_center;	
}