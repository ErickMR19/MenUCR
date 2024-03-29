<div class="row text-center">
    <div class="col-xs-12">
        <h2>Sodas</h2>
        <br>
    </div>
</div>
<div class="restaurants index large-9 medium-8 columns content">
    <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name',['label'=>'Nombre']) ?></th>
                <th><?= $this->Paginator->sort('schedule',['label'=>'Horario']) ?></th>
                <th><?= $this->Paginator->sort('email',['label'=>'Correo']) ?></th>
                <th><?= $this->Paginator->sort('card',['label'=>'Aceptan Tarjetas']) ?></th>
                <th><?= $this->Paginator->sort('association_id',['label'=>'Asociación a cargo']) ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($restaurants as $restaurant): ?>
            <tr>
                <td><?= h($restaurant->name) ?></td>
                <td><?= h($restaurant->schedule) ?></td>
                <td><?= h($restaurant->email) ?></td>
                <td><?php if ($this->Number->format($restaurant->card) == 0) { echo "No"; } else { echo "Sí"; } ?></td>
                <td><?= $restaurant->has('association') ? $this->Html->link($restaurant->association->name, ['controller' => 'Associations', 'action' => 'view', $restaurant->association->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $restaurant->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $restaurant->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $restaurant->id], ['confirm' => __('Estas seguro de que quieres borrarlo # {0}?', $restaurant->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('siguiente') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
<script>
    document.getElementById('menu_sodas').classList.add('active');
</script>