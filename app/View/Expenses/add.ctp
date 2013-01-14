<div class="expenses">
<?php echo $this->Form->create('Expense'); ?>
	<fieldset>
		<legend><?php echo __('Add Expense'); ?></legend>
	<?php
		echo $this->Form->input('description');
		echo $this->Form->input('value');
		echo $this->Form->input('date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>