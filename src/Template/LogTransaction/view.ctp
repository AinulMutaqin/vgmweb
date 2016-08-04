<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Log Transaction'), ['action' => 'edit', $logTransaction->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Log Transaction'), ['action' => 'delete', $logTransaction->id], ['confirm' => __('Are you sure you want to delete # {0}?', $logTransaction->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Log Transaction'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Log Transaction'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="logTransaction view large-9 medium-8 columns content">
    <h3><?= h($logTransaction->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($logTransaction->id) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Transaction Name') ?></h4>
        <?= $this->Text->autoParagraph(h($logTransaction->transaction_name)); ?>
    </div>
</div>
