<div class="restaurants index large-9 medium-8 columns content">
    <h3><?= __('Restaurants') ?></h3>
    <div class="table-responsive">
    <table class="table">
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
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $restaurant->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $restaurant->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $restaurant->id], ['confirm' => __('Are you sure you want to delete # {0}?', $restaurant->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
