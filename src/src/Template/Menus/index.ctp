<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Restaurants'), ['controller' => 'Restaurants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Restaurant'), ['controller' => 'Restaurants', 'action' => 'add']) ?></li>
       

    </ul>
</nav>
<div class="menus index large-9 medium-8 columns content">
    <h3><?= __('Menus') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('Nombre del Menú') ?></th>
                <th><?= $this->Paginator->sort('Tipo de Menú') ?></th>
                <th><?= $this->Paginator->sort('Soda a la que pertenece') ?></th>
                <th><?= $this->Paginator->sort('Horario') ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menus as $menu): ?>
            <tr>
                <td><?= $this->Number->format($menu->id) ?></td>
                <td><?= h($menu->name) ?></td>
                <td><?= h($menu->type) ?></td>
                <td><?= $menu->has('restaurant') ? $this->Html->link($menu->restaurant->id, ['controller' => 'Restaurants', 'action' => 'view', $menu->restaurant->id]) : '' ?></td>
                <td><?= h($menu->schedule) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $menu->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $menu->id]) ?>
                    <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
