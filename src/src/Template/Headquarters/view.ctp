<style>    
#map {
    width: 90%;
    height: 400px;
}
</style>
<div class="row text-center">
    <div class="col-xs-12">
        <h2>Está viendo la sede: <?= h($headquarters->name) ?></h2>
        <br>
    </div>
</div>
<div class="headquarters view large-9 medium-8 columns content">
    <table class="table">
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($headquarters->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Latitud') ?></th>
            <td><?= $this->Number->format($headquarters->x) ?></td>
        </tr>
        <tr>
            <th><?= __('Longitud') ?></th>
            <td><?= $this->Number->format($headquarters->y) ?></td>
        </tr>
    </table>
</div>
<div align="center">
<div id="map"></div></br>
</div></br>
<div id="div_latitud" hidden>
<?php
    echo $headquarters->x;
?>
</div>
<div id="div_longitud" hidden>
<?php
    echo $headquarters->y;
?>
</div>
<script>
    var div_latitud = document.getElementById("div_latitud");
    var latitud = div_latitud.textContent;
    var div_longitud = document.getElementById("div_longitud");
    var longitud = div_longitud.textContent;
    function initMap() {
    var myLatLng = {lat: parseFloat(latitud), lng: parseFloat(longitud)};
    var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 16,
    center: myLatLng
    });
    var marker = new google.maps.Marker({
    position: myLatLng,
    map: map
    });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap" async defer></script>
<script>
    document.getElementById('menu_sedes').classList.add('active');
</script>