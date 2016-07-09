<style>    
#map {
    width: 90%;
    height: 400px;
}
</style>
<?= $this->Html->script('sodas'); ?>
<div class="row text-center">
    <div class="col-xs-12">
        <h2>Está editando la sede: <?= h($headquarters->name) ?></h2>
        <br>
    </div>
</div>
<div class="headquarters form large-9 medium-8 columns content">
    <?= $this->Form->create($headquarters) ?>
    <fieldset>
        <?php
            echo $this->Form->input('name', ['class'=>'form-control', 'label' => 'Nombre']);
            echo "<br>";
        ?>
        <div align="center">
        <div id="map"></div></br>
        </div></br>
        <?php
            echo $this->Form->input('x', ['class'=>'form-control', 'label' => 'Latitud']);
            echo "<br>";
            echo $this->Form->input('y', ['class'=>'form-control', 'label' => 'Longitud']);
            echo "<br>";
        ?>
    </fieldset>
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false&callback=initMapEdit" async defer></script>
<div class="row text-center">
    <div class="col-xs-12">
       <?= $this->Form->button(__('Editar'),['class'=>'btn btn-primary' , 'onclick' => "alert(document.getElementByName('x').value);"]) ?>
        <br>
        <br>
    </div>
</div>
    <?= $this->Form->end() ?>
</div>
<script>
    document.getElementById('menu_sedes').classList.add('active');
</script>