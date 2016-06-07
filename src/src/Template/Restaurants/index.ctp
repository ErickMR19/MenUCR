<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Restaurant'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Associations'), ['controller' => 'Associations', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Association'), ['controller' => 'Associations', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="restaurants index large-9 medium-8 columns content">
    <h3><?= __('Restaurants') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('schedule') ?></th>
                <th><?= $this->Paginator->sort('card') ?></th>
                <th><?= $this->Paginator->sort('x') ?></th>
                <th><?= $this->Paginator->sort('y') ?></th>
                <th><?= $this->Paginator->sort('image_name') ?></th>
                <th><?= $this->Paginator->sort('association_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($restaurants as $restaurant): ?>
            <tr>
                <td><?= $this->Number->format($restaurant->id) ?></td>
                <td><?= h($restaurant->schedule) ?></td>
                <td><?= $this->Number->format($restaurant->card) ?></td>
                <td><?= $this->Number->format($restaurant->x) ?></td>
                <td><?= $this->Number->format($restaurant->y) ?></td>
                <td><?= h($restaurant->image_name) ?></td>
                <td><?= $restaurant->has('association') ? $this->Html->link($restaurant->association->name, ['controller' => 'Associations', 'action' => 'view', $restaurant->association->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $restaurant->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $restaurant->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $restaurant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $restaurant->id)]) ?>
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
