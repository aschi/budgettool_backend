<div class="groups form">
	<fieldset>
	<legend><?php echo __('Select Group'); ?></legend>
	<p><?=__('In order to use the flat-sharing budgettool you need to select a group. You can either join a group or create a new one.');?></p>
	</fieldset>
</div>

<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Create Group'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Join Group'), array('action' => 'joinGroup')); ?></li>
	</ul>
</div>
