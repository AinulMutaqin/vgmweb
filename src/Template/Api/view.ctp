<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Api'), ['action' => 'edit', $api->api_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Api'), ['action' => 'delete', $api->api_id], ['confirm' => __('Are you sure you want to delete # {0}?', $api->api_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Api'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Api'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Api'), ['controller' => 'Api', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Api'), ['controller' => 'Api', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="api view large-9 medium-8 columns content">
    <h3><?= h($api->api_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Url') ?></th>
            <td><?= h($api->url) ?></td>
        </tr>
        <tr>
            <th><?= __('Api Id') ?></th>
            <td><?= $this->Number->format($api->api_id) ?></td>
        </tr>
    </table>
    <div class="related">
        <h4><?= __('Related Api') ?></h4>
        <?php if (!empty($api->api)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th><?= __('Url') ?></th>
                <th><?= __('Api Id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php foreach ($api->api as $api): ?>
            <tr>
                <td><?= h($api->url) ?></td>
                <td><?= h($api->api_id) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['controller' => 'Api', 'action' => 'view', $api->api_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['controller' => 'Api', 'action' => 'edit', $api->api_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['controller' => 'Api', 'action' => 'delete', $api->api_id], ['confirm' => __('Are you sure you want to delete # {0}?', $api->api_id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php endif; ?>
    </div>
</div>
