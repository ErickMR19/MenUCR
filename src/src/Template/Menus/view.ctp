<div class="row text-center">
    <div class="col-xs-12">
        <h2><?= h($menu->name) ?></h2>
    </div>
</div>

<br><br>
    <table class="table">
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($menu->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Tipo') ?></th>
            <td><?= h($menu->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Restaurante') ?></th>
            <td><?= $menu->has('restaurant') ? $this->Html->link($menu->restaurant->id, ['controller' => 'Restaurants', 'action' => 'view', $menu->restaurant->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Horario') ?></th>
            <td><?= h($menu->schedule) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($menu->id) ?></td>
        </tr>
    </table>

<div class="row text-center">
    <div class="col-xs-12">
        <h2>Menús</h2>
    </div>
</div>
<br><br>
<div class="table-responsive">
    <div class="related">


        <?php if (!empty($menu->menus_dishes_categories)): ?>
            <table class="table">
                <tr>
                    <th><?= __('Id') ?></th>
                    <th><?= __('Menu Id') ?></th>
                    <th><?= __('Dishe Id') ?></th>
                    <th><?= __('Category Id') ?></th>
                    <th><?= __('Date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
                <?php foreach ($menu->menus_dishes_categories as $menusDishesCategories): ?>
                    <tr>
                        <td><?= h($menusDishesCategories->id) ?></td>
                        <td><?= h($menusDishesCategories->menu_id) ?></td>
                        <td><?= h($menusDishesCategories->dishe_id) ?></td>
                        <td><?= h($menusDishesCategories->category_id) ?></td>
                        <td><?= h($menusDishesCategories->date) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'MenusDishesCategories', 'action' => 'view', $menusDishesCategories->id]) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'MenusDishesCategories', 'action' => 'edit', $menusDishesCategories->id]) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'MenusDishesCategories', 'action' => 'delete', $menusDishesCategories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menusDishesCategories->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    </div>
</div>

<script>
    document.getElementById('menu_tipo_menus').classList.add('active');
</script>
