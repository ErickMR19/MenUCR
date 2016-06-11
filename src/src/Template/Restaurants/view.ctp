<div class="row text-center">
    <div class="col-xs-12">
        <h2>Está viendo la soda </h2><h2><?= h($restaurant->id) ?></h2>
        <br>
    </div>
</div>
<div class="restaurants view large-9 medium-8 columns content">
    <table class="table">
        <tr>
            <th><?= __('Horario') ?></th>
            <td><?= h($restaurant->schedule) ?></td>
        </tr>
        <tr>
            <th><?= __('Imagen') ?></th>
            <td><?= h($restaurant->image_name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id de la asosiación') ?></th>
            <td><?= $restaurant->has('association') ? $this->Html->link($restaurant->association->name, ['controller' => 'Associations', 'action' => 'view', $restaurant->association->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($restaurant->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Aceptan tarjeta') ?></th>
            <td><?= $this->Number->format($restaurant->card) ?></td>
        </tr>
        <tr>
            <th><?= __('Latitud') ?></th>
            <td><?= $this->Number->format($restaurant->x) ?></td>
        </tr>
        <tr>
            <th><?= __('Longitud') ?></th>
            <td><?= $this->Number->format($restaurant->y) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Categorías relacionadas') ?></h4>
        <?php if (!empty($restaurant->categories)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Price') ?></th>
                <th><?= __('Restaurant Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($restaurant->categories as $categories): ?>
            <tr>
                <td><?= h($categories->id) ?></td>
                <td><?= h($categories->name) ?></td>
                <td><?= h($categories->price) ?></td>
                <td><?= h($categories->restaurant_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Categories', 'action' => 'view', $categories->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Categories', 'action' => 'edit', $categories->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Categories', 'action' => 'delete', $categories->id], ['confirm' => __('Are you sure you want to delete # {0}?', $categories->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Menus relacionados') ?></h4>
        <?php if (!empty($restaurant->menus)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Name') ?></th>
                <th><?= __('Type') ?></th>
                <th><?= __('Restaurant Id') ?></th>
                <th><?= __('Schedule') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($restaurant->menus as $menus): ?>
            <tr>
                <td><?= h($menus->id) ?></td>
                <td><?= h($menus->name) ?></td>
                <td><?= h($menus->type) ?></td>
                <td><?= h($menus->restaurant_id) ?></td>
                <td><?= h($menus->schedule) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Menus', 'action' => 'view', $menus->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Menus', 'action' => 'edit', $menus->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Menus', 'action' => 'delete', $menus->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menus->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
