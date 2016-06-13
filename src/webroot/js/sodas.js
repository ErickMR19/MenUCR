var myLatLng = {lat: 9.936099, lng: -84.049561};
var marker = 0;
var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
    zoom: 16,
    center: myLatLng
    });
    marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    draggable:true
});
}
function actualizar_coordenadas(){
	document.getElementById('x').value = marker.position.lat();
    document.getElementById('y').value = marker.position.lng();
}
function actualizar_mapa(lati, lon) {
    myLatLng = {lat: lati, lng: lon};
    map = new google.maps.Map(document.getElementById('map'), {
    zoom: 16,
    center: myLatLng
    });
    marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    draggable:true
});
}
