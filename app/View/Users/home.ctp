<h1><?=__('Home');?></h1>

<?
debug($expenses);

?>

<p><?=__('Welcome to the group budgeting system...');?></p>
<p><?=__('Your groups monthly budget: ').$budget.__('CHF');?></p>

<h2><?=__('Expenses');?></h2>
<table>
	<tr>
		<th><?=__('Date');?></th>
		<th><?=__('User');?></th>
		<th><?=__('Description');?></th>
		<th><?=__('Value');?></th>	
	</tr>
	<?
		foreach($expenses as $expense){
			debug($expense);
			?>
			<tr>
				<td><?=$expense['Expense']['date'];?></td>
				<td><?=$expense['User']['username'];?></td>
				<td><?=$expense['Expense']['description'];?></td>
				<td><?=$expense['Expense']['value'];?></td>
			</tr>
			<?
		}
	?>
</table>