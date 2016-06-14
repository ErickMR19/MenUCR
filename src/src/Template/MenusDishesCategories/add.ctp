

    <?= $this->Form->create($menusDishesCategory) ?>

    <div class="row text-center">
        <div class="col-xs-12">
            <h2>Agregar nuevo menú</h2>
            <br>
        </div>
    </div>

    <div class="form-group">
        <?php
        echo $this->Form->input('menu_id', ['options' => $menus, 'class'=>'form-control', 'label'=>false, 'empty'=>'Tipo de menú']);
        echo "<br>";
        echo $this->Form->input('dishe_id', ['options' => $dishes, 'class'=>'form-control', 'empty'=>'Platillo', 'label'=>false]);
        echo "<br>";
        echo $this->Form->input('category_id', ['options' => $categories, 'class'=>'form-control', 'label'=>false,'empty'=>'Tipo de menú']);
        echo "<br>";
        echo $this->Form->input('date', ['class'=>'form-control', 'label'=>'Fecha']);
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

    <br>

