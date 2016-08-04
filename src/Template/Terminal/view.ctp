<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Terminal'), ['action' => 'edit', $terminal->terminalId]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Terminal'), ['action' => 'delete', $terminal->terminalId], ['confirm' => __('Are you sure you want to delete # {0}?', $terminal->terminalId)]) ?> </li>
        <li><?= $this->Html->link(__('List Terminal'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Terminal'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Trx Truck Terminal'), ['controller' => 'TrxTruckTerminal', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trx Truck Terminal'), ['controller' => 'TrxTruckTerminal', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Trx User Terminal'), ['controller' => 'TrxUserTerminal', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trx User Terminal'), ['controller' => 'TrxUserTerminal', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="terminal view large-9 medium-8 columns content">
    <h3><?= h($terminal->terminalId) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Terminal') ?></th>
            <td><?= h($terminal->terminal) ?></td>
        </tr>
        <tr>
            <th><?= __('TerminalId') ?></th>
            <td><?= $this->Number->format($terminal->terminalId) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Trx Truck Terminal') ?></h4>
        <?php if (!empty($terminal->trx_truck_terminal)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Truck Id') ?></th>
                <th><?= __('Terminal Id') ?></th>
                <th><?= __('User Id') ?></th>
                <th><?= __('Gross Weight') ?></th>
                <th><?= __('Container Id') ?></th>
                <th><?= __('Voy In') ?></th>
                <th><?= __('Voy Out') ?></th>
                <th><?= __('Trx Date') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($terminal->trx_truck_terminal as $trxTruckTerminal): ?>
            <tr>
                <td><?= h($trxTruckTerminal->truck_id) ?></td>
                <td><?= h($trxTruckTerminal->terminal_id) ?></td>
                <td><?= h($trxTruckTerminal->user_id) ?></td>
                <td><?= h($trxTruckTerminal->gross_weight) ?></td>
                <td><?= h($trxTruckTerminal->container_id) ?></td>
                <td><?= h($trxTruckTerminal->voy_in) ?></td>
                <td><?= h($trxTruckTerminal->voy_out) ?></td>
                <td><?= h($trxTruckTerminal->trx_date) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TrxTruckTerminal', 'action' => 'view', $trxTruckTerminal->truck_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TrxTruckTerminal', 'action' => 'edit', $trxTruckTerminal->truck_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TrxTruckTerminal', 'action' => 'delete', $trxTruckTerminal->truck_id], ['confirm' => __('Are you sure you want to delete # {0}?', $trxTruckTerminal->truck_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
    <div class="related">
        <h4><?= __('Related Trx User Terminal') ?></h4>
        <?php if (!empty($terminal->trx_user_terminal)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('User Id') ?></th>
                <th><?= __('Terminal Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($terminal->trx_user_terminal as $trxUserTerminal): ?>
            <tr>
                <td><?= h($trxUserTerminal->user_id) ?></td>
                <td><?= h($trxUserTerminal->terminal_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TrxUserTerminal', 'action' => 'view', $trxUserTerminal->user_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TrxUserTerminal', 'action' => 'edit', $trxUserTerminal->user_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TrxUserTerminal', 'action' => 'delete', $trxUserTerminal->user_id], ['confirm' => __('Are you sure you want to delete # {0}?', $trxUserTerminal->user_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
