<div class="loginBox">
<?php
echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'login')));
?>
	<table cellpadding="0" cellspacing="0" border="0">
		<tr>
			<td><label><?=__('Username')?>:</label></td>
			<td><label><?=__('Password')?>:</label></td>
			<td></td>
		</tr>
		<tr>
			<td>
				<?=$this->Form->input('User.username', array('div'=>false, 'label'=>false));?>
			</td>
			<td>
				<?=$this->Form->input('User.password', array('div'=>false, 'label'=>false));?>
			</td>
			<td>
				<?=$this->Form->submit('Login', array('div' => false));?>
			</td>
		</tr>
	</table>
<?= $this->Form->end();?>
</div>
	