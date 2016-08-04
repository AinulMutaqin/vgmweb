<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $terminal->terminalId],
                ['confirm' => __('Are you sure you want to delete # {0}?', $terminal->terminalId)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Terminal'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Trx Truck Terminal'), ['controller' => 'TrxTruckTerminal', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Trx Truck Terminal'), ['controller' => 'TrxTruckTerminal', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Trx User Terminal'), ['controller' => 'TrxUserTerminal', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Trx User Terminal'), ['controller' => 'TrxUserTerminal', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="terminal form large-9 medium-8 columns content">
    <?= $this->Form->create($terminal) ?>
    <fieldset>
        <legend><?= __('Edit Terminal') ?></legend>
        <?php
            echo $this->Form->input('terminal');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
