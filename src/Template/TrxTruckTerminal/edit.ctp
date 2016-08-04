<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $trxTruckTerminal->truck_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $trxTruckTerminal->truck_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Trx Truck Terminal'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="trxTruckTerminal form large-9 medium-8 columns content">
    <?= $this->Form->create($trxTruckTerminal) ?>
    <fieldset>
        <legend><?= __('Edit Trx Truck Terminal') ?></legend>
        <?php
            echo $this->Form->input('terminal_id');
            echo $this->Form->input('user_id');
            echo $this->Form->input('gross_weight');
            echo $this->Form->input('container_id');
            echo $this->Form->input('voy_in');
            echo $this->Form->input('voy_out');
            echo $this->Form->input('trx_date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
