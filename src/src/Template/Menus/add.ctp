<?= $this->Form->create($menu,['role'=>'form']) ?>

<div class="row text-center">
    <div class="col-xs-12">
        <h2>Agregar nuevo tipo de menú</h2>
        <br>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <?php
            echo "<br>";
            echo $this->Form->input('type',['class'=>'form-control','label'=>false,'placeholder'=>'Tipo de menú']);
            echo "<br>";
            echo $this->Form->input('restaurant_id', ['options' => $restaurants, 'class'=>'form-control','empty'=>'Restaurante Asociado','label'=>false]);
            echo "<br>";
            echo $this->Form->input('schedule',['class'=>'form-control','label'=>false,'placeholder'=>'Horario del Menú']);
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

<script>
    document.getElementById('menu_tipo_menus').classList.add('active');
</script>