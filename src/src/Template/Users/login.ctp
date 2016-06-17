
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
<div class="row text-center">
    <div class="col-xs-12">
        <h2>Ingrese su correo electrónico y contraseña</h2>
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
            'class'=>'form-control']) ?>
        <br />
        <?= $this->Form->input('password', [
            'label'=>false,
            'placeholder'=>'contraseña',
            'class'=>'form-control'
        ]) ?>
        </div>
    </div>
</div>

<div class="row text-center">
    <div class="col-xs-12">
        <?= $this->Form->button(__('Iniciar Sesión'),['class'=>'btn btn-primary']) ?>
        <br>
        <br>
    </div>
</div>

<?= $this->Form->end() ?>
</div>