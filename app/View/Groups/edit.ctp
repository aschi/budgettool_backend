<div class="groups">
<?php echo $this->Form->create('Group'); ?>
	<fieldset>
		<legend><?php echo __('Edit Group'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('group_name');
		echo $this->Form->input('new_password', array('type'=>'password'));
		echo $this->Form->input('budget');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>