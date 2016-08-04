<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $trxUserTerminal->user_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $trxUserTerminal->user_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Trx User Terminal'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="trxUserTerminal form large-9 medium-8 columns content">
    <?= $this->Form->create($trxUserTerminal) ?>
    <fieldset>
        <legend><?= __('Edit Trx User Terminal') ?></legend>
        <?php
            echo $this->Form->input('terminal_id');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
