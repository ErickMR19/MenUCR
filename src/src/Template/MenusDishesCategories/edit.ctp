<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $menusDishesCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $menusDishesCategory->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Menus Dishes Categories'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['controller' => 'Menus', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menu'), ['controller' => 'Menus', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Dishes'), ['controller' => 'Dishes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Dish'), ['controller' => 'Dishes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Categories'), ['controller' => 'Categories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Category'), ['controller' => 'Categories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="menusDishesCategories form large-9 medium-8 columns content">
    <?= $this->Form->create($menusDishesCategory) ?>
    <fieldset>
        <legend><?= __('Edit Menus Dishes Category') ?></legend>
        <?php
            echo $this->Form->input('menu_id', ['options' => $menus]);
            echo $this->Form->input('dishe_id', ['options' => $dishes]);
            echo $this->Form->input('category_id', ['options' => $categories]);
            echo $this->Form->input('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
