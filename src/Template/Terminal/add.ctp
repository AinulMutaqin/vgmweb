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
		<?= $this->Form->create($terminal) ?>
		<fieldset>
			<legend><?= __('Add Terminal') ?></legend>
			<?php
				echo $this->Form->input('terminal');
				echo $this->Form->input('terminal_name');
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit')) ?>
		<?= $this->Form->end() ?>
	</div>
</div>