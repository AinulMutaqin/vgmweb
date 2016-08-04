<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $logTransaction->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $logTransaction->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Log Transaction'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="logTransaction form large-9 medium-8 columns content">
    <?= $this->Form->create($logTransaction) ?>
    <fieldset>
        <legend><?= __('Edit Log Transaction') ?></legend>
        <?php
            echo $this->Form->input('transaction_name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
