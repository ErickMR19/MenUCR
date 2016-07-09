<!-- src/Template/Users/add.ctp -->


<?= $this->Form->create($user) ?>

<div class="row text-center">
    <div class="col-xs-12">
        <h2>Añadir nuevo usuario</h2>
        <br>
    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
        <?= $this->Form->input('username', [
            'label'=>false,
            'placeholder'=>'Correo Electrónico',
            'type' => 'email',
            'class'=>'form-control'
        ]) ?>
        <br />
        <?= $this->Form->input('password', [
            'label'=>false,
            'placeholder'=>'contraseña',
            'class'=>'form-control'
        ]) ?>
        <br />
        <?= $this->Form->input('name', [
            'label'=>false,
            'placeholder'=>'Nombre',
            'class'=>'form-control'
        ]) ?>
        <br />
        <?= $this->Form->input('last_name_1', [
            'label'=>false,
            'placeholder'=>'Primer Apellido',
            'class'=>'form-control'
        ]) ?>
        <br />
        <?= $this->Form->input('last_name_2', [
            'label'=>false,
            'placeholder'=>'Segundo Apellido',
            'class'=>'form-control'
        ]) ?>
        <br />
        <?= $this->Form->input('role', [
            'label'=>false, 
            'onchange' => 'requireAssociation(this.value)',
            'empty' => 'Seleccione el rol del usuario',
            'class'=>'form-control'
        ]) ?>
        <br />
        <?= $this->Form->input('association_id', [
            'label'=>false, 
            'empty' => 'Seleccione alguna de las asociaciones',
            'class'=>'form-control'
        ]) ?>
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
    var requireAssociation = function(role)
    {        
        if (role == 'manager' || role == "")
        {
            document.getElementById('association-id').setAttribute("required", "required");
            document.getElementById('association-id').style.display = "initial";
        }
        else
        {            
            document.getElementById('association-id').removeAttribute("required");
            document.getElementById('association-id').style.display = "none";
        }
    };
    document.querySelector('#association-id option[value=""]').disabled = true;
    document.querySelector('#role option[value=""]').disabled = true;
    requireAssociation(document.getElementById('role').value);
</script>
<script>
    document.getElementById('menu_users').classList.add('active');
</script>