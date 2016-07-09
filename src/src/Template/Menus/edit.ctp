

    <?= $this->Form->create($menu) ?>

        <div class="row text-center">
            <div class="col-xs-12">
                <h2>Editar tipo de menú </h2>
            </div>
        </div>
<div class="form-group">
    <?php
    echo $this->Form->input('type', ['label'=>'Tipo', 'class'=>'form-control']);
    echo $this->Form->input('schedule', ['label'=>'Horario', 'class'=>'form-control']);
    ?>
</div>


    <div class="row text-center">
        <div class="col-xs-12">
            <?= $this->Form->button(__('Modificar'),['class'=>'btn btn-primary']) ?>
            <br>
            <br>
        </div>
    </div>
    <?= $this->Form->end() ?>
<script>
    document.getElementById('menu_tipo_menus').classList.add('active');
</script>
