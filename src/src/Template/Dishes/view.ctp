<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Dish'), ['action' => 'edit', $dish->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Dish'), ['action' => 'delete', $dish->id], ['confirm' => __('Are you sure you want to delete # {0}?', $dish->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Dishes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Dish'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="dishes view large-9 medium-8 columns content">
    <h3><?= h($dish->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($dish->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($dish->description) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($dish->id) ?></td>
        </tr>
    </table>
</div>
