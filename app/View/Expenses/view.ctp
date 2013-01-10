<div class="expenses view">
<h2><?php  echo __('Expense'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($expense['Expense']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($expense['User']['username'], array('controller' => 'users', 'action' => 'view', $expense['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($expense['Expense']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Value'); ?></dt>
		<dd>
			<?php echo h($expense['Expense']['value']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($expense['Expense']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($expense['Expense']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Expense'), array('action' => 'edit', $expense['Expense']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Expense'), array('action' => 'delete', $expense['Expense']['id']), null, __('Are you sure you want to delete # %s?', $expense['Expense']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Expenses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Expense'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
