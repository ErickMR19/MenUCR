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



    <?= $this->Form->create($dish) ?>

        <div class="row text-center">
            <div class="col-xs-12">
                <h2>Editar platillo</h2>
            </div>
        </div>
<div class="form-group">
    <?php
    echo $this->Form->input('name',['class'=>'form-control']);
    echo $this->Form->input('description', ['class'=>'form-control', 'type'=>'textarea']);
    ?>
</div>


<div class="row text-center">
    <div class="col-xs-12">
        <?= $this->Form->button(__('Modificar'),['class'=>'btn btn-primary']) ?>
        <br>
        <br>
    </div>
</div>
    <?= $this->Form->end() ?>

