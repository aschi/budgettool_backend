<div class="groups form">
<?php echo $this->Form->create('Group'); ?>
	<fieldset>
		<legend><?php echo __('Create Group'); ?></legend>
	<?php
		echo $this->Form->input('group_name');
		echo $this->Form->input('password');
		echo $this->Form->input('budget', array('label'=>'Monthly budget'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Back'), array('action' => 'selectGroup')); ?></li>
	</ul>
</div>
