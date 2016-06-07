<div class="headquarters view large-9 medium-8 columns content">
    <h3><?= h($headquarters->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($headquarters->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($headquarters->id) ?></td>
        </tr>
        <tr>
            <th><?= __('X') ?></th>
            <td><?= $this->Number->format($headquarters->x) ?></td>
        </tr>
        <tr>
            <th><?= __('Y') ?></th>
            <td><?= $this->Number->format($headquarters->y) ?></td>
        </tr>
    </table>
</div>
