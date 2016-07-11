

    <?= $this->Form->create($category,['role'=>'form']) ?>

    <div class="row text-center">
        <div class="col-xs-12">
            <h2>Agregar nuevo tipo de platillo</h2>
            <br>
        </div>
    </div>

    <div class="form-group">
        <?php
        echo $this->Form->input('name',['class'=>'form-control','label'=>false, 'placeholder'=>'Nombre del Tipo de Platillo']);
        echo "<br>";
        echo $this->Form->input('price',['class'=>'form-control','label'=>false, 'placeholder'=>'Precio del Platillo']);
        echo "<br>";

        if($this->request->session()->read('Auth.User.role') === 'admin')
        {
            echo $this->Form->input('restaurant_id', ['options' => $restaurants, 'class'=>'form-control','empty'=>'Restaurante Asociado','label'=>false]);
            echo "<br>";
        }
        
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

<script>
    document.getElementById('menu_categorias').classList.add('active');
</script>