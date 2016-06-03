<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Category'), ['action' => 'edit', $category->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Category'), ['action' => 'delete', $category->id], ['confirm' => __('Are you sure you want to delete # {0}?', $category->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Categories'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Category'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Restaurants'), ['controller' => 'Restaurants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Restaurant'), ['controller' => 'Restaurants', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Menus Dishes Categories'), ['controller' => 'MenusDishesCategories', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Menus Dishes Category'), ['controller' => 'MenusDishesCategories', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="categories view large-9 medium-8 columns content">
    <h3><?= h($category->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($category->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Restaurant') ?></th>
            <td><?= $category->has('restaurant') ? $this->Html->link($category->restaurant->id, ['controller' => 'Restaurants', 'action' => 'view', $category->restaurant->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($category->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Price') ?></th>
            <td><?= $this->Number->format($category->price) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Menus Dishes Categories') ?></h4>
        <?php if (!empty($category->menus_dishes_categories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Menu Id') ?></th>
                <th><?= __('Dishe Id') ?></th>
                <th><?= __('Category Id') ?></th>
                <th><?= __('Date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($category->menus_dishes_categories as $menusDishesCategories): ?>
            <tr>
                <td><?= h($menusDishesCategories->id) ?></td>
                <td><?= h($menusDishesCategories->menu_id) ?></td>
                <td><?= h($menusDishesCategories->dishe_id) ?></td>
                <td><?= h($menusDishesCategories->category_id) ?></td>
                <td><?= h($menusDishesCategories->date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'MenusDishesCategories', 'action' => 'view', $menusDishesCategories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'MenusDishesCategories', 'action' => 'edit', $menusDishesCategories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'MenusDishesCategories', 'action' => 'delete', $menusDishesCategories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menusDishesCategories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
