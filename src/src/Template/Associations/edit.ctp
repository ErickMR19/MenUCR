

    <?= $this->Form->create($association) ?>

    <div class="row text-center">
        <div class="col-xs-12">
            <h2>Editar Asociación</h2>
        </div>
    </div>
    <br>

    <div class="form-group">
        <?php
            echo $this->Form->input('acronym',['class'=>'form-control', 'label'=>'Sigla']);
            echo $this->Form->input('name',['class'=>'form-control', 'label'=>'Nombre']);
          
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
    document.getElementById('menu_associations').classList.add('active');
</script>

