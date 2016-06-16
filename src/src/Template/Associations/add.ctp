
    <?= $this->Form->create($association) ?>

    <div class="row text-center">
        <div class="col-xs-12">
            <h2>Agregar nueva asociación</h2>
            <br>
        </div>
    </div>
<br>

    <div class="form-group">

        <?php
            echo $this->Form->input('acronym',['class'=>'form-control','label'=>false, 'placeholder'=>'Sigla']);
        echo "<br>";
            echo $this->Form->input('name',['class'=>'form-control','label'=>false, 'placeholder'=>'Nombre']);
        echo "<br>";
            echo $this->Form->input('headquarter_id', ['options' => $headquarters, 'class'=>'form-control', 'label'=>false, 'empty'=>'Sede a la que pertenece']);
        echo "<br>";
        ?>
    </div>

    <div class="row text-center">
        <div class="col-xs-12">
            <?= $this->Form->button(__('Agregar'),['class'=>'btn btn-primary']) ?>
            <br>
            <br>
        </div>
    </div>

    <?= $this->Form->end() ?>

