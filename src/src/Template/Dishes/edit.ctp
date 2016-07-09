    <?= $this->Form->create($dish) ?>

        <div class="row text-center">
            <div class="col-xs-12">
                <h2>Editar platillo</h2>
            </div>
        </div>
<div class="form-group">
    <?php
    echo $this->Form->input('name',['class'=>'form-control']);
    echo $this->Form->input('description', ['class'=>'form-control', 'type'=>'textarea']);
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
    document.getElementById('menu_platos').classList.add('active');
</script>