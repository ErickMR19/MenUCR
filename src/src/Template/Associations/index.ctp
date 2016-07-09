
<div class="row text-center">
    <div class="col-xs-12">
        <h2>Asociaciones</h2>

    </div>
</div>
<br>

<div class="table-responsive">
    <table class='table'>
        <thead>
        <tr>

            <th><?= $this->Paginator->sort('acronym',['label'=>'Sigla']) ?></th>
            <th><?= $this->Paginator->sort('name',['label'=>'Nombre']) ?></th>
            <th><?= $this->Paginator->sort('headquarter_id',['label'=>'Sede']) ?></th>
            <th class="actions"><?= __('Acciones') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($associations as $association): ?>
            <tr>

                <td><?= h($association->acronym) ?></td>
                <td><?= h($association->name) ?></td>
                <td><?= $association->has('headquarters') ? $this->Html->link($association->headquarters->name, ['controller' => 'Headquarters', 'action' => 'view', $association->headquarters->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $association->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $association->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $association->id], ['confirm' => __('Seguro que quiere borrar esta asociación # {0}?', $association->id)]) ?>
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
<script>
    document.getElementById('menu_associations').classList.add('active');
</script>

