<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $headquarters->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $headquarters->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Headquarters'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="headquarters form large-9 medium-8 columns content">
    <?= $this->Form->create($headquarters) ?>
    <fieldset>
        <legend><?= __('Edit Headquarters') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('x');
            echo $this->Form->input('y');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
