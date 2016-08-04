<div class="row">
	<div class="col-sm-3 col-md-2 sidebar">
	  <ul class="nav nav-sidebar">
		<li><?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>		
		<li><?= $this->Html->link(__('Log Transaction'), ['controller' => 'LogTransaction', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('Api'), ['controller' => 'Api', 'action' => 'index']) ?></li>
		<li class="active"><?= $this->Html->link(__('Terminal'), ['controller' => 'Terminal', 'action' => 'index']) ?></li>
	  </ul>
	</div>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	  <h2 class="sub-header">Terminal</h2>
	  
	  <div class="table-responsive">
		<table class="table table-striped">
		  <thead>
			<tr>
				<th><?= $this->Paginator->sort('no'); ?></th>
                <th><?= $this->Paginator->sort('terminal') ?></th>
				<th><?= $this->Paginator->sort('terminal name') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
		  </thead>
		  <tbody>
			<?php $no = 0; foreach ($terminal as $terminal): $no++; ?>
            <tr>
                <td><?= $this->Number->format($terminal->terminalId) ?></td>
                <td><?= h($terminal->terminal) ?></td>
				<td><?= h($terminal->terminal_name) ?></td>
                <td class="actions">
					<?= $this->Html->link('', ['action' => 'add', $terminal->id], ['title' => __('Add'), 'class' => 'btn btn-default glyphicon glyphicon-plus-sign']) ?>
                    <?= $this->Html->link('', ['action' => 'edit', $terminal->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
					<?= $this->Form->postLink('', ['action' => 'delete', $terminal->id], ['confirm' => __('Are you sure you want to delete # {0}?', $terminal->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
                </td>
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