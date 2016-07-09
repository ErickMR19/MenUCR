
<div class="row text-center">
    <div class="col-xs-12">
        <h2><?= h($association->name) ?></h2>
    </div>
</div>
<br><br>


    <table class="table">
        <tr>
            <th><?= __('Sigla') ?></th>
            <td><?= h($association->acronym) ?></td>
        </tr>
        <tr>
            <th><?= __('Nombre') ?></th>
            <td><?= h($association->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Sede') ?></th>
            <td><?= $association->has('headquarters') ? $this->Html->link($association->headquarters->name, ['controller' => 'Headquarters', 'action' => 'view', $association->headquarters->id]) : '' ?></td>
        </tr>

    </table>
  
<script>
    document.getElementById('menu_associations').classList.add('active');
</script>
