

<?= $this->Form->create($dish,['role'=>'form']) ?>
    <div class="row text-center">
        <div class="col-xs-12">
            <h2>Agregar nuevo platillo</h2>
            <br>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="form-group">
                <?php
                echo $this->Form->input('name',['class'=>'form-control', 'placeholder'=>'Nombre del Platillo', 'label'=> false]);
                echo "<br>";
                echo $this->Form->input('description',['type'=>'textarea','class'=>'form-control', 'placeholder'=>'Agregue los ingredientes del platillo', 'label'=>false]);
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
    document.getElementById('menu_platos').classList.add('active');
</script>