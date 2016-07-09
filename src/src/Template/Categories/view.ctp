
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
            <td><?= $category->has('restaurant') ? $this->Html->link($category->restaurant->name, ['controller' => 'Restaurants', 'action' => 'view', $category->restaurant->id]) : '' ?></td>
        </tr>

        <tr>
            <th><?= __('Precio') ?></th>
            <td><?= $this->Number->format($category->price) ?></td>
        </tr>
    </table>


<script>
    document.getElementById('menu_categorias').classList.add('active');
</script>