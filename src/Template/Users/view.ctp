<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->userid]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->userid], ['confirm' => __('Are you sure you want to delete # {0}?', $user->userid)]) ?> </li>
        <li><?= $this->Html->link(__('List User'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Trx Truck Terminal'), ['controller' => 'TrxTruckTerminal', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trx Truck Terminal'), ['controller' => 'TrxTruckTerminal', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Trx User Terminal'), ['controller' => 'TrxUserTerminal', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Trx User Terminal'), ['controller' => 'TrxUserTerminal', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="user view large-9 medium-8 columns content">
    <h3><?= h($user->userid) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Username') ?></th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th><?= __('Password') ?></th>
            <td><?= h($user->password) ?></td>
        </tr>
        <tr>
            <th><?= __('Userid') ?></th>
            <td><?= $this->Number->format($user->userid) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Trx Truck Terminal') ?></h4>
        <?php if (!empty($user->trx_truck_terminal)): ?>
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
            <?php foreach ($user->trx_truck_terminal as $trxTruckTerminal): ?>
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
        <?php if (!empty($user->trx_user_terminal)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('User Id') ?></th>
                <th><?= __('Terminal Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($user->trx_user_terminal as $trxUserTerminal): ?>
            <tr>
                <td><?= h($trxUserTerminal->user_id) ?></td>
                <td><?= h($trxUserTerminal->terminal_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'TrxUserTerminal', 'action' => 'view', $trxUserTerminal->]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'TrxUserTerminal', 'action' => 'edit', $trxUserTerminal->]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'TrxUserTerminal', 'action' => 'delete', $trxUserTerminal->], ['confirm' => __('Are you sure you want to delete # {0}?', $trxUserTerminal->)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
