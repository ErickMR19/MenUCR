<style>    
#map {
    width: 90%;
    height: 400px;
}
</style>
<div class="row text-center">
    <div class="col-xs-12">
        <h2>Está editando la soda: <?= h($restaurant->name) ?></h2>
        <br>
    </div>
</div>
<div class="restaurants form large-9 medium-8 columns content">
    <?= $this->Form->create($restaurant, ['enctype' => 'multipart/form-data']) ?>
    <fieldset>
        <?php
            echo $this->Form->input('id', ['class'=>'form-control','label' => 'Nombre', 'type'=>'hidden']);
            echo $this->Form->input('name', ['class'=>'form-control','label' => 'Nombre']);
            echo "<br>";
            echo $this->Form->input('schedule', ['class'=>'form-control', 'label' => 'Horario']);
            echo "<br>";
            echo $this->Form->input('email', ['class'=>'form-control','label'=>'Correo electrónico']);
            echo "<br>";
       ?>
        <div>
          <h4>¿Acepta la soda el pago con tarjetas?</h4>
            <label class="radio-inline">
              <input type="radio" id="radio_si" name="optradio" onclick="document.getElementById('card').value=1;">Sí
            </label>
            <label class="radio-inline">
              <input type="radio" id="radio_no" name="optradio" onclick="document.getElementById('card').value=0;">No
            </label>
        </div>
        <?php
            echo $this->Form->input('card', ['class'=>'form-control', 'label' => 'Aceptan tarjeta', 'type' => 'hidden']);
            echo "<br>";
        ?>
        <div class="dropdown">
          <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Escoja la sede para la soda
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
          <?php if (!empty($sedes)): ?>
                <?php foreach ($sedes as $_sedes): ?>
                <li><a onclick="actualizar_mapa(<?php echo $_sedes->x?> , <?php echo $_sedes->y ?>);"><?= h($_sedes->name) ?></a></li>
                <?php endforeach; ?>
          <?php endif; ?>
          </ul>
        </div>
        <?php echo "<br>"; ?>        
        <div align="center">
        <div id="map"></div></br>
        </div></br>
        <?php
            echo $this->Form->input('x', ['class'=>'form-control', 'label' => 'Latitud']);
            echo "<br>";
            echo $this->Form->input('y', ['class'=>'form-control', 'label' => 'Longitud']);
            echo "<br>";
        ?>
        <h4>Imagen actual de esta soda</h4>
        <div align="center" id="img_soda">
            <?= $this->Html->image('restaurants_pictures/'.$restaurant->image_name, array('class' => 'img-responsive', 'width' => '50%' , 'alt'=>'Esta soda no tiene imagen aún'));  ?>
        </div>
        <h4>Cambia la imagen de esta soda</h4>
        <?php
            echo $this->Form->input('imagen_seleccionada', ['class'=>'form-control', 'type' => 'file', 'label'=>false]);
            echo $this->Form->input('image_name', ['type' => 'hidden']);
            echo "<br>";
            echo $this->Form->input('association_id', ['class'=>'form-control', 'label' => 'Asociación a cargo','options' => $associations, 'empty' => true]);
            echo "<br>";
        ?>
    </fieldset>
<div class="row text-center">
    <div class="col-xs-12">
       <?= $this->Form->button(__('Editar'),['class'=>'btn btn-primary']) ?>
        <br>
        <br>
    </div>
</div>
    <?= $this->Form->end() ?>
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
<div id="tarjeta" hidden>
<?php
    if ($restaurant->card > 0){
        echo 1;
    } else {
        echo 0;
    }
?>
</div>
<script>
    var div_latitud = document.getElementById("div_latitud");
    var latitud = div_latitud.textContent;
    var div_longitud = document.getElementById("div_longitud");
    var longitud = div_longitud.textContent;
    
    var myLatLng; var map; var marker=0;
    
    function initMap() {
    myLatLng = {lat: parseFloat(latitud), lng: parseFloat(longitud)};
    map = new google.maps.Map(document.getElementById('map'), {
    zoom: 16,
    center: myLatLng
    });
    marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    draggable:true
    });
    google.maps.event.addListener(marker, 'dragend', function (ev) {
        document.getElementById('x').value = marker.getPosition().lat();
        document.getElementById('y').value = marker.getPosition().lng();
    });
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
    google.maps.event.addListener(marker, 'dragend', function (ev) {
        document.getElementById('x').value = marker.position.lat();
        document.getElementById('y').value = marker.position.lng();
    });
    actualizar_coordenadas();
    }
    
    function actualizar_coordenadas(){
	document.getElementById('x').value = marker.position.lat();
    document.getElementById('y').value = marker.position.lng();
    }
    
    var tarjeta = document.getElementById("tarjeta").textContent;
    if (tarjeta > 0){
        document.getElementById('radio_si').checked = true;
        document.getElementById('card').value = 1;
    } else {
        document.getElementById('radio_no').checked = true;
        document.getElementById('card').value = 0;
    }
</script>
<script>
    document.getElementById('menu_sodas').classList.add('active');
</script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap" async defer></script>