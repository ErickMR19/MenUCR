<div class="row text-center">
    <div class="col-xs-12">
        <h2><?= h('Información del Usuario') ?></h2>
    </div>
</div>

<br><br>
    <table class="table">
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Apellidos') ?></th>
            <td><?= h($user->last_name_1 . ' ' . $user->last_name_2) ?></td>
        </tr>
        <tr>
            <th><?= __('Rol') ?></th>
            <td><?= h($user->role) ?></td>
        </tr>
        <?php if ($user->has('association')): ?>
        <tr>
            <th><?= __('Asociación') ?></th>
            <td><?= $this->Html->link($user->association->name, ['controller' => 'Associations', 'action' => 'view', $user->association->id]) ?></td>
        </tr>
        <?php endif; ?>
    </table>


<script>
    document.getElementById('menu_tipo_menus').classList.add('active');
</script>
