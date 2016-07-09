<div class="row text-center">
    <div class="col-xs-12">
        <h2><?= h($menu->name) ?></h2>
    </div>
</div>

<br><br>
    <table class="table">
        <tr>
            <th><?= __('Tipo') ?></th>
            <td><?= h($menu->type) ?></td>
        </tr>
        <tr>
            <th><?= __('Restaurante') ?></th>
            <td><?= $menu->has('restaurant') ? $this->Html->link($menu->restaurant->name, ['controller' => 'Restaurants', 'action' => 'view', $menu->restaurant->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Horario') ?></th>
            <td><?= h($menu->schedule) ?></td>
        </tr>

    </table>




<script>
    document.getElementById('menu_tipo_menus').classList.add('active');
</script>
