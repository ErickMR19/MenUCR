<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $dish->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $dish->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Dishes'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="dishes form large-9 medium-8 columns content">
    <?= $this->Form->create($dish) ?>
    <fieldset>
        <legend><?= __('Edit Dish') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
