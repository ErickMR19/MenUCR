<?= $this->Form->create() ?>

<div class="row text-center">
    <div class="col-xs-12">
        <h2>Cambiar contraseña</h2>
        <br>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">    
        <div class="form-group">
            <?= $this->Form->input('old_password',['type' => 'password' , 'label'=>false, 'placeholder'=>'Contraseña antigua', 'class'=>'form-control'])?>
        </div>    
        <div class="form-group">
            <?= $this->Form->input('password',['type'=>'password' ,'label'=>false, 'placeholder'=>'Nueva contraseña', 'class'=>'form-control']) ?>
        </div>
        <div class="form-group">
            <?= $this->Form->input('passwordr',['type' => 'password' , 'label'=>false, 'placeholder'=>'Repita la nueva contraseña', 'class'=>'form-control'])?>
        </div>
    </div>
</div>

    
<div class="row text-center">
    <div class="col-xs-12">
        <?= $this->Form->button(__('Guardar'),['class'=>'btn btn-primary']) ?>
        <br>
        <br>
    </div>
</div>
<?= $this->Form->end() ?>
<script>
    document.getElementById('menu_users').classList.add('active');
</script>