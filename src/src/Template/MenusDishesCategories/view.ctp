<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Menus Dishes Category'), ['action' => 'edit', $menusDishesCategory->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Menus Dishes Category'), ['action' => 'delete', $menusDishesCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menusDishesCategory->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Menus Dishes Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menus Dishes Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Dishes'), ['controller' => 'Dishes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dish'), ['controller' => 'Dishes', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="menusDishesCategories view large-9 medium-8 columns content">
    <h3><?= h($menusDishesCategory->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Menu') ?></th>
            <td><?= $menusDishesCategory->has('menu') ? $this->Html->link($menusDishesCategory->menu->name, ['controller' => 'Menus', 'action' => 'view', $menusDishesCategory->menu->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Dish') ?></th>
            <td><?= $menusDishesCategory->has('dish') ? $this->Html->link($menusDishesCategory->dish->name, ['controller' => 'Dishes', 'action' => 'view', $menusDishesCategory->dish->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Category') ?></th>
            <td><?= $menusDishesCategory->has('category') ? $this->Html->link($menusDishesCategory->category->name, ['controller' => 'Categories', 'action' => 'view', $menusDishesCategory->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($menusDishesCategory->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Date') ?></th>
            <td><?= h($menusDishesCategory->date) ?></td>
        </tr>
    </table>
</div>
