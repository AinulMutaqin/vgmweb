<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Trx Truck Terminal'), ['action' => 'edit', $trxTruckTerminal->truck_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Trx Truck Terminal'), ['action' => 'delete', $trxTruckTerminal->truck_id], ['confirm' => __('Are you sure you want to delete # {0}?', $trxTruckTerminal->truck_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Trx Truck Terminal'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trx Truck Terminal'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="trxTruckTerminal view large-9 medium-8 columns content">
    <h3><?= h($trxTruckTerminal->truck_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Truck Id') ?></th>
            <td><?= $this->Number->format($trxTruckTerminal->truck_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Terminal Id') ?></th>
            <td><?= $this->Number->format($trxTruckTerminal->terminal_id) ?></td>
        </tr>
        <tr>
            <th><?= __('User Id') ?></th>
            <td><?= $this->Number->format($trxTruckTerminal->user_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Gross Weight') ?></th>
            <td><?= $this->Number->format($trxTruckTerminal->gross_weight) ?></td>
        </tr>
        <tr>
            <th><?= __('Container Id') ?></th>
            <td><?= $this->Number->format($trxTruckTerminal->container_id) ?></td>
        </tr>
        <tr>
            <th><?= __('Voy In') ?></th>
            <td><?= $this->Number->format($trxTruckTerminal->voy_in) ?></td>
        </tr>
        <tr>
            <th><?= __('Voy Out') ?></th>
            <td><?= $this->Number->format($trxTruckTerminal->voy_out) ?></td>
        </tr>
        <tr>
            <th><?= __('Trx Date') ?></th>
            <td><?= h($trxTruckTerminal->trx_date) ?></td>
        </tr>
    </table>
</div>
