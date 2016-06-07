<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Headquarters'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="headquarters index large-9 medium-8 columns content">
    <h3><?= __('Headquarters') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('name') ?></th>
                <th><?= $this->Paginator->sort('x') ?></th>
                <th><?= $this->Paginator->sort('y') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($headquarters as $headquarters): ?>
            <tr>
                <td><?= $this->Number->format($headquarters->id) ?></td>
                <td><?= h($headquarters->name) ?></td>
                <td><?= $this->Number->format($headquarters->x) ?></td>
                <td><?= $this->Number->format($headquarters->y) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $headquarters->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $headquarters->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $headquarters->id], ['confirm' => __('Are you sure you want to delete # {0}?', $headquarters->id)]) ?>
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
