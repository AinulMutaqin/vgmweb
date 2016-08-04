<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Trx Truck Terminal'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="trxTruckTerminal index large-9 medium-8 columns content">
    <h3><?= __('Trx Truck Terminal') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('truck_id') ?></th>
                <th><?= $this->Paginator->sort('terminal_id') ?></th>
                <th><?= $this->Paginator->sort('user_id') ?></th>
                <th><?= $this->Paginator->sort('gross_weight') ?></th>
                <th><?= $this->Paginator->sort('container_id') ?></th>
                <th><?= $this->Paginator->sort('voy_in') ?></th>
                <th><?= $this->Paginator->sort('voy_out') ?></th>
                <th><?= $this->Paginator->sort('trx_date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($trxTruckTerminal as $trxTruckTerminal): ?>
            <tr>
                <td><?= $this->Number->format($trxTruckTerminal->truck_id) ?></td>
                <td><?= $this->Number->format($trxTruckTerminal->terminal_id) ?></td>
                <td><?= $this->Number->format($trxTruckTerminal->user_id) ?></td>
                <td><?= $this->Number->format($trxTruckTerminal->gross_weight) ?></td>
                <td><?= $this->Number->format($trxTruckTerminal->container_id) ?></td>
                <td><?= $this->Number->format($trxTruckTerminal->voy_in) ?></td>
                <td><?= $this->Number->format($trxTruckTerminal->voy_out) ?></td>
                <td><?= h($trxTruckTerminal->trx_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $trxTruckTerminal->truck_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $trxTruckTerminal->truck_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $trxTruckTerminal->truck_id], ['confirm' => __('Are you sure you want to delete # {0}?', $trxTruckTerminal->truck_id)]) ?>
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
