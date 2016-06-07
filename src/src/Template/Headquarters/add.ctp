
<div class="headquarters form large-9 medium-8 columns content">
    <?= $this->Form->create($headquarters) ?>
    <fieldset>
        <h2>Agregar sedes</h2>
        <?php
            echo $this->Form->input('name', ['label' => 'Nombre' , 'class' => 'form-control']);
            echo $this->Form->input('x' , ['label' => 'X' , 'class' => 'form-control', 'placeholder' => 'longitud']);
            echo $this->Form->input('y',  ['label' => 'Y' , 'class' => 'form-control', 'placeholder' => 'latitud']);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit'), ['class'=>'btn btn-primary']) ?>
    <?= $this->Form->end() ?>
</div>
