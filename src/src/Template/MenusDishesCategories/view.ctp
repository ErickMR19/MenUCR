
<div class="row text-center">
    <div class="col-xs-12">
        <h2>Menú #<?= h($menusDishesCategory->id) ?></h2>
    </div>
</div>

    <table class="table">
        <tr>
            <th><?= __('Menú') ?></th>
            <td><?= $menusDishesCategory->has('menu') ? $this->Html->link($menusDishesCategory->menu->name, ['controller' => 'Menus', 'action' => 'view', $menusDishesCategory->menu->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Platillo') ?></th>
            <td><?= $menusDishesCategory->has('dish') ? $this->Html->link($menusDishesCategory->dish->name, ['controller' => 'Dishes', 'action' => 'view', $menusDishesCategory->dish->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Categoría') ?></th>
            <td><?= $menusDishesCategory->has('category') ? $this->Html->link($menusDishesCategory->category->name, ['controller' => 'Categories', 'action' => 'view', $menusDishesCategory->category->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($menusDishesCategory->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Fecha') ?></th>
            <td><?= h($menusDishesCategory->date) ?></td>
        </tr>
    </table>

