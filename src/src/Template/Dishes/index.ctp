

    <div class="row text-center">
        <div class="col-xs-12">
            <h2>Platillos</h2>
            <br>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>

                <th><?= $this->Paginator->sort('name',['label'=>'Nombre']) ?></th>
                <th><?= $this->Paginator->sort('description',['label'=>'Descripción']) ?></th>
                <th><?= $this->Paginator->sort('restaurant_id',['label'=>'Restaurante asociado']) ?></th>
                <th class="actions"><?= __('Acciones') ?></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($dishes as $dish): ?>
                <tr>
                    <td><?= h($dish->name) ?></td>
                    <td><?= h($dish->description) ?></td>
                    <td><?= $dish->has('restaurant') ? $this->Html->link($dish->restaurant->name, ['controller' => 'Restaurants', 'action' => 'view', $dish->restaurant->id]) : '' ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Ver'), ['action' => 'view', $dish->id]) ?>
                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $dish->id]) ?>
                        <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $dish->id], ['confirm' => __('Estas seguro de que quieres borrar este platillo # {0}?', $dish->id)]) ?>
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
    document.getElementById('menu_platos').classList.add('active');
</script>