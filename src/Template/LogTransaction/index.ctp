<div class="row">
	<div class="col-sm-3 col-md-2 sidebar">
	  <ul class="nav nav-sidebar">
		<li><?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>		
		<li class="active"><?= $this->Html->link(__('Log Transaction'), ['controller' => 'LogTransaction', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('Api'), ['controller' => 'Api', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('Terminal'), ['controller' => 'Terminal', 'action' => 'index']) ?></li>
	  </ul>
	</div>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	  <h2 class="sub-header">Log Transaction</h2>
	  
	  <div class="table-responsive">
		<table class="table table-striped">
		  <thead>
			<tr>
				<th><?= $this->Paginator->sort('no'); ?></th>
				<th><?= $this->Paginator->sort('transaction_name'); ?></th>
				<th><?= $this->Paginator->sort('datetime'); ?></th>
				<th><?= $this->Paginator->sort('message log'); ?></th>
				<th><?= $this->Paginator->sort('terminal'); ?></th>
				<th><?= $this->Paginator->sort('userid'); ?></th>
				<th><?= $this->Paginator->sort('truckid'); ?></th>
			</tr>
		  </thead>
		  <tbody>
			<?php $no = 0; foreach ($logTransaction as $logTransaction): $no++; ?>
            <tr>
                <td><?= $no ?></td>
				<td><?= h($logTransaction->transaction_name) ?></td>
				<td><?= __('Datetime') ?></td>
				<td><?= __('Message Log') ?></td>
				<td><?= __('Terminal') ?></td>
				<td><?= __('User Id') ?></td>
				<td><?= __('Truck Id') ?></td>
            </tr>
            <?php endforeach; ?>
		  </tbody>
		</table>
	  </div>
	
		<div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
	
	</div>
</div>
