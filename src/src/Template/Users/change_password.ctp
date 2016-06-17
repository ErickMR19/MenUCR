<?= $this->Form->create() ?>
<fieldset>
    <legend><?= __('Change password') ?></legend>
    <?= $this->Form->input('old_password',['type' => 'password' , 'label'=>'Old password'])?>
    <?= $this->Form->input('password',['type'=>'password' ,'label'=>'Password']) ?>
    <?= $this->Form->input('passwordr',['type' => 'password' , 'label'=>'Repeat password'])?>
</fieldset>
<?= $this->Form->button(__('Save')) ?>
<?= $this->Form->end() ?>
<script>
    document.getElementById('menu_users').classList.add('active');
</script>