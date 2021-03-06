var params = {map:null};
var infowindow;
var markers = {};

function initialize() {
	var myLatlng = new google.maps.LatLng(-26.321011, -48.8524804);
	var myOptions = {
		zoom: 5,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scrollwheel: true,
		panControl: false,
			panControlOptions: {
			position: google.maps.ControlPosition.TOP_RIGHT
		},
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.LARGE,
			position: google.maps.ControlPosition.RIGHT_CENTER
		},
		mapTypeControl: false,
		featureType: "water", stylers: [ { hue: "#00ffff" }, { visibility: "on" } ]
	}
	var map = new google.maps.Map(document.getElementById("frame_mapa"), myOptions);
	params.map = map;
	var url = $('#frame_mapa').data('url');
	//mostraPins();
	var urlJson = baseUrl + 'representantes/json';
	if($('#estado').val() != '' || $('#cidade').val() != '') {
		urlJson = urlJson+'?estado='+$('#estado').val()+'&cidade='+$('#cidade').val();
	}

	var cont = 0;
	var markers = [];
	var imgcluster =  baseUrl.replace('app_dev.php', '')+'/site/images/agrupador_vermelho.png';
	var styles = [[{
		url: imgcluster,
		height: 53,
		width: 52,
		textColor: '#ffffff',
		textSize: 12
	}]];
	$.get(urlJson, function(data) {
		$.each(data, function(index, item) {
			//console.log(item);
			var image = baseUrl.replace('app_dev.php', '')+'/site/images/pin.png';
			if(cont == 0) {
				map.setCenter(new google.maps.LatLng(item.lat, item.lng));
				cont++;
			}
			var titulo = item.name;
			//var marcador = new google.maps.LatLng(-26.305088, -48.846093);
			var marcador = new google.maps.LatLng(item.lat, item.lng);
			var id_marker = item.id;
			var marker = new google.maps.Marker({
					position: marcador,
					map: params.map,
					title:titulo,
					icon: image
			});
			marker.set("id", id_marker);
			marker.setMap(params.map);
			markers.push(marker);

			google.maps.event.addListener(marker, 'click', function() {
				//console.log(marker);
				$('#dados_map #unidade_map').html(item.nome);
				$('#dados_map #endereco').html(item.endereco);
				$('#dados_map #bairro').html(item.bairro);
				$('#dados_map #cep').html(item.cep);
				$('#dados_map #cidaderep').html(item.cidade);
                $('#dados_map #estadorep').html(item.estado);
				$('#dados_map #telefone').html(item.telefone);
				$('#dados_map #email').html(item.email);

				var myOptions = {
					content: $('#dados_map').html()
					,pixelOffset: new google.maps.Size(-10, 0)
					,closeBoxMargin: "-35px 2px 2px 2px"
					,closeBoxURL: baseUrl.replace('app_dev.php', '')+'/site/images/close-menu.png'
					,isHidden: false
				};
				$('.infoBox').hide();
				var ib = new InfoBox(myOptions);
				ib.open(params.map, this);
			});
			markers['item_'+item.id] = marker;
			//console.log(markers);

		});
		var markerCluster = new MarkerClusterer(map, markers, {
			maxZoom: 12,
          	gridSize: 40,
          	styles: styles[0]
		});
	}, "json");
}
google.maps.event.addDomListener(window, 'load', initialize);


function carrega(lat,lng) {
	var myLatlng = new google.maps.LatLng(lat, lng);
	var isDraggable = $(document).width() > 480 ? true : false;
	var myOptions = {
		zoom: 5,
		center: myLatlng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		scrollwheel: true,
		panControl: false,
			panControlOptions: {
			position: google.maps.ControlPosition.TOP_RIGHT
		},
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.LARGE,
			position: google.maps.ControlPosition.RIGHT_CENTER
		},
		mapTypeControl: false,
		featureType: "water", stylers: [ { hue: "#00ffff" }, { visibility: "on" } ]
	}
	var map = new google.maps.Map(document.getElementById("frame_mapa"), myOptions);
	params.map = map;
}


$(document).ready(function(){
	$('.fechar_dados').click(function(){
		$('.infoBox').hide();
	});

	$('.lk_onde').click(function() {
		var id = $(this).attr('data-id');
		google.maps.event.trigger(markers['item_'+id], 'click');
		$('html, body').animate({
			scrollTop: 0
		   }, 1000);
		return false;
	});

});

function mostraPins() {
	$('.lk_onde').click();
	return false;
}

$(window).load(function(){
 //mostraPins();
});
