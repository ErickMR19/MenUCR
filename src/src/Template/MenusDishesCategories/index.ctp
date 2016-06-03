<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Menus Dishes Category'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Dishes'), ['controller' => 'Dishes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Dish'), ['controller' => 'Dishes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="menusDishesCategories index large-9 medium-8 columns content">
    <h3><?= __('Menus Dishes Categories') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('menu_id') ?></th>
                <th><?= $this->Paginator->sort('dishe_id') ?></th>
                <th><?= $this->Paginator->sort('category_id') ?></th>
                <th><?= $this->Paginator->sort('date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menusDishesCategories as $menusDishesCategory): ?>
            <tr>
                <td><?= $this->Number->format($menusDishesCategory->id) ?></td>
                <td><?= $menusDishesCategory->has('menu') ? $this->Html->link($menusDishesCategory->menu->name, ['controller' => 'Menus', 'action' => 'view', $menusDishesCategory->menu->id]) : '' ?></td>
                <td><?= $menusDishesCategory->has('dish') ? $this->Html->link($menusDishesCategory->dish->name, ['controller' => 'Dishes', 'action' => 'view', $menusDishesCategory->dish->id]) : '' ?></td>
                <td><?= $menusDishesCategory->has('category') ? $this->Html->link($menusDishesCategory->category->name, ['controller' => 'Categories', 'action' => 'view', $menusDishesCategory->category->id]) : '' ?></td>
                <td><?= h($menusDishesCategory->date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $menusDishesCategory->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menusDishesCategory->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $menusDishesCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menusDishesCategory->id)]) ?>
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
