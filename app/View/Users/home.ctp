<h1><?=__('Home');?></h1>
<p><?=__('Welcome to the group budgeting system...');?></p>
<p><?=__('Your groups monthly budget: ').$budget.__('CHF');?></p>

<h2><?=__('Expenses');?></h2>

<?debug($total);?>
<table>
	<tr>
		<th><?=__('Date');?></th>
		<th><?=__('User');?></th>
		<th><?=__('Description');?></th>
		<th><?=__('Value');?></th>	
		<th><?=__('Actions');?></th>
	</tr>
	<?
		foreach($expenses as $expense){
			?>
			<tr>
				<td><?=$expense['Expense']['date'];?></td>
				<td><?=$expense['User']['username'];?></td>
				<td><?=$expense['Expense']['description'];?></td>
				<td><?=$expense['Expense']['value'];?></td>
				<td class="actions"><?php echo $this->Form->postLink(__('Delete'), array('controller' => 'expenses', 'action' => 'delete', $expense['Expense']['id']), null, __('Are you sure you want to delete # %s?', $expense['Expense']['id'])); ?></td>
			</tr>
			<?
		}
	?>
	
	<?php echo $this->Form->create('Expense', array('url' => array('controller' => 'expenses', 'action' => 'add'))); ?>
	<tr>
		<td><?=$this->Form->input('date', array('div'=>false, 'label'=>false));?></td>
		<td><?=$user['User']['username'];?></td>
		<td><?=$this->Form->input('description', array('div'=>false, 'label'=>false));?></td>
		<td><?=$this->Form->input('value', array('div'=>false, 'label'=>false));?></td>
		
		<td class="actions"><?=$this->Form->submit('Add', array('div' => false));?></td>
	</tr>
	<?php echo $this->Form->end(); ?>	
</table>