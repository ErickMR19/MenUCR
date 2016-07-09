
<div class="row text-center">
    <div class="col-xs-12">
        <h2><?= h($dish->name) ?></h2>
    </div>
</div>
<br><br>

    <table class="table">
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($dish->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Descripción') ?></th>
            <td><?= h($dish->description) ?></td>
        </tr>

    </table>

<script>
    document.getElementById('menu_platos').classList.add('active');
</script>