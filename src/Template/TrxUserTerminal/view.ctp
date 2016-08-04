<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Trx User Terminal'), ['action' => 'edit', $trxUserTerminal->user_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Trx User Terminal'), ['action' => 'delete', $trxUserTerminal->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $trxUserTerminal->user_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Trx User Terminal'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trx User Terminal'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="trxUserTerminal view large-9 medium-8 columns content">
    <h3><?= h($trxUserTerminal->user_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('User Id') ?></th>
            <td><?= $this->Number->format($trxUserTerminal->user_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Terminal Id') ?></th>
            <td><?= $this->Number->format($trxUserTerminal->terminal_id) ?></td>
        </tr>
    </table>
</div>
