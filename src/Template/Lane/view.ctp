<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Lane'), ['action' => 'edit', $lane->terminalId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Lane'), ['action' => 'delete', $lane->terminalId], ['confirm' => __('Are you sure you want to delete # {0}?', $lane->terminalId)]) ?> </li>
        <li><?= $this->Html->link(__('List Lane'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lane'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="lane view large-9 medium-8 columns content">
    <h3><?= h($lane->terminalId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Lane') ?></th>
            <td><?= h($lane->lane) ?></td>
        </tr>
        <tr>
            <th><?= __('TerminalId') ?></th>
            <td><?= $this->Number->format($lane->terminalId) ?></td>
        </tr>
    </table>
</div>
