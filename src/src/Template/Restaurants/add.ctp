<style>    
#map {
    width: 90%;
    height: 400px;
}
</style>
<script type="text/javascript" src="../../src/webroot/js/sodas.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap" async defer></script>
<?= $this->Form->create($restaurant) ?>
<div class="row text-center">
    <div class="col-xs-12">
        <h2>Agregar nueva soda</h2>
        <br>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
                <?php
                    echo $this->Form->input('schedule', ['class'=>'form-control','placeholder'=>'Horario','label'=>false]);
                    echo "<br>";
                    echo $this->Form->input('card', ['class'=>'form-control','placeholder'=>'Aceptan tarjeta','label'=>false]);
                    echo "<br>";
                ?>
                <div align="center">
                <div id="map"></div></br>
                <div>
                <button type="button" class="btn btn-warning" onclick="actualizar_coordenadas();">Actualizar coordenadas</button>
                </div></br>
                </div></br>
                <?php
                    echo $this->Form->input('x', ['class'=>'form-control','placeholder'=>'Latitud','label'=>false]);
                    echo "<br>";
                    echo $this->Form->input('y', ['class'=>'form-control','placeholder'=>'Longitud','label'=>false]);
                    echo "<br>";
                    echo $this->Form->input('image_name', ['class'=>'form-control','placeholder'=>'Nombre de la imagen','label'=>false]);
                    echo "<br>";
                    echo $this->Form->input('association_id', ['options' => $associations, 'empty' => true, 'class'=>'form-control','empty'=>'Asociación','label'=>false]);
                ?>
        </div>
    </div>
</div>
<div class="row text-center">
    <div class="col-xs-12">
       <?= $this->Form->button(__('Agregar'),['class'=>'btn btn-primary']) ?>
        <br>
        <br>
    </div>
</div>
<?= $this->Form->end() ?>
