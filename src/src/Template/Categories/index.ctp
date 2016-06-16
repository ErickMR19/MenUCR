
<div class="row text-center">
    <div class="col-xs-12">
        <h2>Tipos de platillos</h2>

    </div>
</div>
<br>

<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('Nombre') ?></th>
            <th><?= $this->Paginator->sort('Precio') ?></th>
            <th><?= $this->Paginator->sort('Restaurante Asociado') ?></th>
            <th class="actions"><?= __('Acciones') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $category): ?>
            <tr>
                <td><?= $this->Number->format($category->id) ?></td>
                <td><?= h($category->name) ?></td>
                <td><?= $this->Number->format($category->price) ?></td>
                <td><?= $category->has('restaurant') ? $this->Html->link($category->restaurant->id, ['controller' => 'Restaurants', 'action' => 'view', $category->restaurant->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $category->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $category->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $category->id], ['confirm' => __('Estas seguro que quieres borrar esta categoria # {0}?', $category->id)]) ?>
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

<br>

<script>
    document.getElementById('menu_categorias').classList.add('active');
</script>