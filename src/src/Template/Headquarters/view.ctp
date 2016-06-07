<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Headquarters'), ['action' => 'edit', $headquarters->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Headquarters'), ['action' => 'delete', $headquarters->id], ['confirm' => __('Are you sure you want to delete # {0}?', $headquarters->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Headquarters'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Headquarters'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="headquarters view large-9 medium-8 columns content">
    <h3><?= h($headquarters->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($headquarters->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($headquarters->id) ?></td>
        </tr>
        <tr>
            <th><?= __('X') ?></th>
            <td><?= $this->Number->format($headquarters->x) ?></td>
        </tr>
        <tr>
            <th><?= __('Y') ?></th>
            <td><?= $this->Number->format($headquarters->y) ?></td>
        </tr>
    </table>
</div>
