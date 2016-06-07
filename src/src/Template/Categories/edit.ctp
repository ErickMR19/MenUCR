

    <?= $this->Form->create($category,['role'=>'form']) ?>

    <div class="row text-center">
        <div class="col-xs-12">
            <h2><?= h($category->name) ?></h2>
        </div>
    </div>

    <div class="form-group">
        <?php
        echo $this->Form->input('name', ['class'=>'form-control', 'label'=>'Nombre']);
        echo "<br>";
        echo $this->Form->input('price', ['class'=>'form-control', 'label'=>'Precio']);
        echo "<br>";
        echo $this->Form->input('restaurant_id', ['options' => $restaurants, 'class'=>'form-control', 'label'=>'Restaurante']);
        echo "<br>";
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

