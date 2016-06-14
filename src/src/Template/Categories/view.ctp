
    <div class="row text-center">
        <div class="col-xs-12">
            <h2><?= h($category->name) ?></h2>
        </div>
    </div>
<br><br>
    <table class="table">
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($category->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Restaurante') ?></th>
            <td><?= $category->has('restaurant') ? $this->Html->link($category->restaurant->id, ['controller' => 'Restaurants', 'action' => 'view', $category->restaurant->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($category->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Precio') ?></th>
            <td><?= $this->Number->format($category->price) ?></td>
        </tr>
    </table>


    <div class="related">

        <div class="row text-center">
            <div class="col-xs-12">
                <h2>Menús</h2>
            </div>
        </div>
        <br><br>
        <?php if (!empty($category->menus_dishes_categories)): ?>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th><?= __('Id') ?></th>
                        <th><?= __('Menu Id') ?></th>
                        <th><?= __('Dishe Id') ?></th>
                        <th><?= __('Category Id') ?></th>
                        <th><?= __('Date') ?></th>
                        <th class="actions"><?= __('Actions') ?></th>
                    </tr>
                    <?php foreach ($category->menus_dishes_categories as $menusDishesCategories): ?>
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
            </div>


        <?php endif; ?>
    </div>

