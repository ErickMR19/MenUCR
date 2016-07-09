<style>    
#map {
    width: 90%;
    height: 400px;
}
</style>
<div class="row text-center">
    <div class="col-xs-12">
        <h2>Está viendo la soda: <?= h($restaurant->name) ?></h2>
        <br>
    </div>
</div>
<div class="restaurants view large-9 medium-8 columns content">
    <table class="table">
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($restaurant->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Horario') ?></th>
            <td><?= h($restaurant->schedule) ?></td>
        </tr>
        <tr>
            <th><?= __('Correo electrónico') ?></th>
            <td><?= h($restaurant->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Imagen') ?></th>
        </tr>
    </table>
    <div align="center"><?= $this->Html->image('restaurants_pictures/'.$restaurant->image_name, array('class' => 'img-responsive', 'width' => '50%', 'alt'=>'Esta soda no tiene imagen aún'));  ?></div>
    <table class="table">
        <tr>
            <th><?= __('Asosiación a cargo') ?></th>
            <td><?= $restaurant->has('association') ? $this->Html->link($restaurant->association->name, ['controller' => 'Associations', 'action' => 'view', $restaurant->association->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Aceptan tarjeta') ?></th>
            <td>
                <?php 
                if ($this->Number->format($restaurant->card)==1) {
                    echo "sí";
                } else {
                    echo "no";
                }
                ?>
            </td>
        </tr>
    </table>
    <div align="center">
    <div id="map"></div></br>
    </div></br>
</div>
<div id="div_latitud" hidden>
<?php
    echo $restaurant->x;
?>
</div>
<div id="div_longitud" hidden>
<?php
    echo $restaurant->y;
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
<script>
    document.getElementById('menu_sodas').classList.add('active');
</script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap" async defer></script>