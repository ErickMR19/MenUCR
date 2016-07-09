<div class="row text-center">
    <div class="col-xs-12">
        <h2>Sedes</h2>
        <br>
    </div>
</div>
<div class="headquarters index large-9 medium-8 columns content">
    <div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name',['label'=>'Nombre']) ?></th>
                <th><?= $this->Paginator->sort('x',['label'=>'Latitud']) ?></th>
                <th><?= $this->Paginator->sort('y',['label'=>'Longitud']) ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($headquarters as $headquarters): ?>
            <tr>
                <td><?= h($headquarters->name) ?></td>
                <td><?= $this->Number->format($headquarters->x) ?></td>
                <td><?= $this->Number->format($headquarters->y) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $headquarters->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $headquarters->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $headquarters->id], ['confirm' => __('Estas seguro de que quieres borrarlo # {0}?', $headquarters->id)]) ?>
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
    document.getElementById('menu_sedes').classList.add('active');
</script>