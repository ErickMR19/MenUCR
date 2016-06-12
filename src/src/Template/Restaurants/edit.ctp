<style>    
#map {
    width: 90%;
    height: 400px;
}
</style>
<script type="text/javascript" src="../../../src/webroot/js/sodas.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMap" async defer></script>
<div class="row text-center">
    <div class="col-xs-12">
        <h2>Editar soda</h2>
        <br>
    </div>
</div>
<div class="restaurants form large-9 medium-8 columns content">
    <?= $this->Form->create($restaurant) ?>
    <fieldset>
        <?php
            echo $this->Form->input('schedule', ['class'=>'form-control', 'label' => 'Horario']);
            echo "<br>";
            echo $this->Form->input('card', ['class'=>'form-control', 'label' => 'Aceptan tarjeta']);
            echo "<br>";
        ?>
        <div align="center">
        <div id="map"></div></br>
        <div>
        <button type="button" class="btn btn-warning" onclick="actualizar_coordenadas();">Actualizar coordenadas</button>
        </div></br>
        </div></br>
        <?php
            echo $this->Form->input('x', ['class'=>'form-control', 'label' => 'Latitud']);
            echo "<br>";
            echo $this->Form->input('y', ['class'=>'form-control', 'label' => 'Longitud']);
            echo "<br>";
            echo $this->Form->input('image_name', ['class'=>'form-control', 'label' => 'Imagen']);
            echo "<br>";
            echo $this->Form->input('association_id', ['class'=>'form-control', 'label' => 'Id de asociación','options' => $associations, 'empty' => true]);
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
