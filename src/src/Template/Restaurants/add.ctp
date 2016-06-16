<style>    
#map {
    width: 90%;
    height: 400px;
}
</style>
<?= $this->Html->script('sodas'); ?>
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
                ?>
                <div>
                  <h4>¿Aceptará la soda el pago con tarjetas?</h4>
                    <label class="radio-inline">
                      <input type="radio" name="optradio" onclick="document.getElementById('card').value=1;">Sí
                    </label>
                    <label class="radio-inline">
                      <input type="radio" name="optradio" onclick="document.getElementById('card').value=0;">No
                    </label>
                </div>
                <?php   
                    echo $this->Form->input('card', ['class'=>'form-control','placeholder'=>'Aceptan tarjeta','label'=>false, 'type'=>'hidden']);
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
                    echo $this->Form->input('association_id', ['options' => $associations, 'empty' => true, 'class'=>'form-control', 'empty'=>'Asociación','label'=>false]);
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
