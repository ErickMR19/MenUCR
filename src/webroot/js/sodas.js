var myLatLng = {lat: 9.936099, lng: -84.049561};
var marker = 0;
var map;
function initMap() {
    "use strict";
    /*global
        google
    */
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: myLatLng
    });
    marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        draggable: true
    });
    
    google.maps.event.addListener(marker, 'dragend', function (ev) {
        document.getElementById('x').value = marker.getPosition().lat();
        document.getElementById('y').value = marker.getPosition().lng();
    });

}

function initMapEdit() {
    "use strict";
    /*global
        google
    */
    myLatLng = {lat: parseFloat(document.getElementById('x').value), lng: parseFloat(document.getElementById('y').value)};
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: myLatLng
    });
    marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        draggable: true
    });

    google.maps.event.addListener(marker, 'dragend', function (ev) {
        document.getElementById('x').value = marker.getPosition().lat();
        document.getElementById('y').value = marker.getPosition().lng();
    });
    actualizar_coordenadas();
}


function actualizar_coordenadas() {
    "use strict";
    document.getElementById('x').value = marker.position.lat();
    document.getElementById('y').value = marker.position.lng();
}

function actualizar_mapa(lati, lon) {
    "use strict";
    myLatLng = {lat: lati, lng: lon};
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 16,
        center: myLatLng
    });
    marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        draggable: true
    });
   
    google.maps.event.addListener(marker, 'dragend', function (ev) {
        document.getElementById('x').value = marker.position.lat();
        document.getElementById('y').value = marker.position.lng();
    });
    actualizar_coordenadas();
}