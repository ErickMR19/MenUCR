<style>    
#map {
    width: 90%;
    height: 400px;
}
</style>
<script type="text/javascript" src="../../src/webroot/js/sodas.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap" async defer></script>
<?= $this->Form->create($headquarters) ?>
<div class="row text-center">
    <div class="col-xs-12">
        <h2>Agregar nueva sede</h2>
        <br>
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
        <?php
            echo $this->Form->input('name', ['label' => false , 'placeholder'=>'Nombre','class' => 'form-control']);
            echo "<br>";
        ?>
        <div align="center">
        <div id="map"></div></br>
        <div>
        <button type="button" class="btn btn-warning" onclick="actualizar_coordenadas();">Actualizar coordenadas</button>
        </div></br>
        </div></br>
        <?php
            echo $this->Form->input('x' , ['label' => false , 'class' => 'form-control', 'placeholder' => 'longitud']);
            echo "<br>";
            echo $this->Form->input('y',  ['label' => false , 'class' => 'form-control', 'placeholder' => 'latitud']);
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