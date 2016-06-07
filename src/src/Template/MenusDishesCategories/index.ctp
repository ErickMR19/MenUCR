


<div class="row text-center">
    <div class="col-xs-12">
        <h2>Menús</h2>

    </div>
</div>
<br>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('Menú') ?></th>
            <th><?= $this->Paginator->sort('Platillo') ?></th>
            <th><?= $this->Paginator->sort('Categoría') ?></th>
            <th><?= $this->Paginator->sort('Fecha') ?></th>
            <th class="actions"><?= __('Acciones') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($menusDishesCategories as $menusDishesCategory): ?>
            <tr>
                <td><?= $this->Number->format($menusDishesCategory->id) ?></td>
                <td><?= $menusDishesCategory->has('menu') ? $this->Html->link($menusDishesCategory->menu->name, ['controller' => 'Menus', 'action' => 'view', $menusDishesCategory->menu->id]) : '' ?></td>
                <td><?= $menusDishesCategory->has('dish') ? $this->Html->link($menusDishesCategory->dish->name, ['controller' => 'Dishes', 'action' => 'view', $menusDishesCategory->dish->id]) : '' ?></td>
                <td><?= $menusDishesCategory->has('category') ? $this->Html->link($menusDishesCategory->category->name, ['controller' => 'Categories', 'action' => 'view', $menusDishesCategory->category->id]) : '' ?></td>
                <td><?= h($menusDishesCategory->date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Ver'), ['action' => 'view', $menusDishesCategory->id]) ?>
                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $menusDishesCategory->id]) ?>
                    <?= $this->Form->postLink(__('Borrar'), ['action' => 'delete', $menusDishesCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menusDishesCategory->id)]) ?>
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
