<div class="expenses form">
<?php echo $this->Form->create('Expense'); ?>
	<fieldset>
		<legend><?php echo __('Add Expense'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('description');
		echo $this->Form->input('value');
		echo $this->Form->input('date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Expenses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
