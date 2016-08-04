<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Trx User Terminal'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="trxUserTerminal index large-9 medium-8 columns content">
    <h3><?= __('Trx User Terminal') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('terminal_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trxUserTerminal as $trxUserTerminal): ?>
            <tr>
                <td><?= $this->Number->format($trxUserTerminal->user_id) ?></td>
                <td><?= $this->Number->format($trxUserTerminal->terminal_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $trxUserTerminal->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $trxUserTerminal->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $trxUserTerminal->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $trxUserTerminal->user_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
