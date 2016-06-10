
<div class="row text-center">
    <div class="col-xs-12">
        <h2>Tipos de menús</h2>

    </div>
</div>

<div class="row">
    <div class="col-xs-12">
        <div class="table-responsive">

            <table class="table">
                <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('Nombre') ?></th>
                    <th><?= $this->Paginator->sort('Tipo de Menú') ?></th>
                    <th><?= $this->Paginator->sort('Soda a la que pertenece') ?></th>
                    <th><?= $this->Paginator->sort('Horario') ?></th>
                    <th class="actions"><?= __('Acciones') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($menus as $menu): ?>
                    <tr>
                        <td><?= $this->Number->format($menu->id) ?></td>
                        <td><?= h($menu->name) ?></td>
                        <td><?= h($menu->type) ?></td>
                        <td><?= $menu->has('restaurant') ? $this->Html->link($menu->restaurant->id, ['controller' => 'Restaurants', 'action' => 'view', $menu->restaurant->id]) : '' ?></td>
                        <td><?= h($menu->schedule) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('Ver'), ['action' => 'view', $menu->id]) ?>
                            <?= $this->Html->link(__('Editar'), ['action' => 'edit', $menu->id]) ?>
                            <?= $this->Form->postLink(__('Eliminar'), ['action' => 'delete', $menu->id], ['confirm' => __('Estas seguro de que quieres borrarlo # {0}?', $menu->id)]) ?>
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


</div>

<br>