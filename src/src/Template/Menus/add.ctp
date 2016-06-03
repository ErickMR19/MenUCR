<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Menus'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Restaurants'), ['controller' => 'Restaurants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Restaurant'), ['controller' => 'Restaurants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Menus Dishes Categories'), ['controller' => 'MenusDishesCategories', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Menus Dishes Category'), ['controller' => 'MenusDishesCategories', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="menus form large-9 medium-8 columns content">
    <?= $this->Form->create($menu) ?>
    <fieldset>
        <legend><?= __('Add Menu') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('type');
            echo $this->Form->input('restaurant_id', ['options' => $restaurants]);
            echo $this->Form->input('schedule');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
