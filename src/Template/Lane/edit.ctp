<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $lane->terminalId],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lane->terminalId)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Lane'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="lane form large-9 medium-8 columns content">
    <?= $this->Form->create($lane) ?>
    <fieldset>
        <legend><?= __('Edit Lane') ?></legend>
        <?php
            echo $this->Form->input('lane');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
