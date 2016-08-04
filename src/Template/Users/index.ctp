<div class="row">
	<div class="col-sm-3 col-md-2 sidebar">
	  <ul class="nav nav-sidebar">
		<li class="active"><?= $this->Html->link(__('Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>		
		<li><?= $this->Html->link(__('Log Transaction'), ['controller' => 'LogTransaction', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('Api'), ['controller' => 'Api', 'action' => 'index']) ?></li>
		<li><?= $this->Html->link(__('Terminal'), ['controller' => 'Terminal', 'action' => 'index']) ?></li>
	  </ul>
	</div>
	<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	
		<div class="alert alert-success" role="alert"> 
			<strong>Success! </strong> New data users has been inserted.
		</div>
		
		<h2 class="sub-header">Users</h2>
		
		<?= $this->Html->link(__('Update Users All'), ['action' => 'updateUsers'], ['class' => 'btn btn-info']) ?>
		
		<div class="btn-group">
			<button id="dropdown-toggle" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Update User <span class="caret"></span>
				
				<ul class="dropdown-menu">
				<?php foreach ($listTerminal as $value):?>
					<li class="">
						<!-- <a href="#"><?php echo $terminal = $value->terminal_name; ?></a> -->
						<?= $this->Html->link(__($value->terminal_name), ['action' => 'updateUsers', 'value' => $value->terminal_code]) ?>
						<script>
							$(function() {
								$('.dropdown-menu li').click(function()
								{
									$('#my_topic').val($(this).html());
									$('#my_form').submit();
								});
							});
						</script>
					</li>
				<?php endforeach; ?>
				</ul>
				
			</button>
		</div>
		
		<!-- Start code dropdown button -->
		
		<!-- End code dropdown button -->
		
		<div class="table-responsive">
			<table class="table table-striped">
			  <thead>
				<tr>
					<th><?= $this->Paginator->sort('no'); ?></th>
					<th><?= $this->Paginator->sort('userid')?></th>
					<th><?= $this->Paginator->sort('username') ?></th>
					<th><?= $this->Paginator->sort('lastname') ?></th>
					<th><?= $this->Paginator->sort('password') ?></th>
					<th><?= $this->Paginator->sort('terminal') ?></th>
					<th class="actions"><?= $this->Paginator->sort('actions') ?></th>
				</tr>
			  </thead>
			  <tbody>
				<?php $no = 0; foreach ($users as $users): $no++; ?>
				<tr>
					<td><?= $no ?></td>
					<td><?= h($users->userid) ?></td>
					<td><?= h($users->username) ?></td>
					<td><?= h($users->lastname) ?></td>
					<td><?= h($users->password) ?></td>
					<td><?= h($users->terminal) ?></td>
					<td class="actions">
						<?= $this->Html->link('', ['action' => 'add', $users->id], ['title' => __('Add'), 'class' => 'btn btn-default glyphicon glyphicon-plus-sign']) ?>
						<?= $this->Html->link('', ['action' => 'edit', $users->id], ['title' => __('Edit'), 'class' => 'btn btn-default glyphicon glyphicon-pencil']) ?>
						<?= $this->Form->postLink('', ['action' => 'delete', $users->id], ['confirm' => __('Are you sure you want to delete # {0}?', $users->id), 'title' => __('Delete'), 'class' => 'btn btn-default glyphicon glyphicon-trash']) ?>
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
