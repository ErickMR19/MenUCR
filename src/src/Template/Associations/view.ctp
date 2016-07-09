
<div class="row text-center">
    <div class="col-xs-12">
        <h2><?= h($association->name) ?></h2>
    </div>
</div>
<br><br>


    <table class="table">
        <tr>
            <th><?= __('Sigla') ?></th>
            <td><?= h($association->acronym) ?></td>
        </tr>
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($association->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Sede') ?></th>
            <td><?= $association->has('headquarters') ? $this->Html->link($association->headquarters->name, ['controller' => 'Headquarters', 'action' => 'view', $association->headquarters->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($association->id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Sodas relacionadas') ?></h4>
        <?php if (!empty($association->restaurants)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Horario') ?></th>
                <th><?= __('Tarjeta') ?></th>
                <th><?= __('X') ?></th>
                <th><?= __('Y') ?></th>
                <th><?= __('Nombre de la imágen') ?></th>
                <th><?= __('Id de la asociación') ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($association->restaurants as $restaurants): ?>
            <tr>
                <td><?= h($restaurants->id) ?></td>
                <td><?= h($restaurants->schedule) ?></td>
                <td><?= h($restaurants->card) ?></td>
                <td><?= h($restaurants->x) ?></td>
                <td><?= h($restaurants->y) ?></td>
                <td><?= h($restaurants->image_name) ?></td>
                <td><?= h($restaurants->association_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Restaurants', 'action' => 'view', $restaurants->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Restaurants', 'action' => 'edit', $restaurants->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['controller' => 'Restaurants', 'action' => 'delete', $restaurants->id], ['confirm' => __('¿Seguro de que quiere borrar esta soda# {0}?', $restaurants->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Usuarios relacionados') ?></h4>
        <?php if (!empty($association->users)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Nombre de usuario') ?></th>
                <th><?= __('Estado') ?></th>
                <th><?= __('Nombre') ?></th>
                <th><?= __('Primer apellido') ?></th>
                <th><?= __('Segundo apellido') ?></th>
                <th><?= __('Id de la asociación') ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
            <?php foreach ($association->users as $users): ?>
            <tr>
                <td><?= h($users->id) ?></td>
                <td><?= h($users->username) ?></td>
                <td><?= h($users->state) ?></td>
                <td><?= h($users->name) ?></td>
                <td><?= h($users->last_name_1) ?></td>
                <td><?= h($users->last_name_2) ?></td>
                <td><?= h($users->association_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['controller' => 'Users', 'action' => 'view', $users->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['controller' => 'Users', 'action' => 'edit', $users->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('¿Seguro de que quiere borrar este usuario # {0}?', $users->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
<script>
    document.getElementById('menu_associations').classList.add('active');
</script>
