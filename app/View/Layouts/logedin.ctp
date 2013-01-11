<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('budgettool');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<div class="bg">
				<?echo $this->element('login_box');?>
				<h1><?php echo __('Group Budgeting Tool'); ?></h1>
				<div id="navigation">
					<ul>
						<li><?=$this->Html->link(__('Home'), array('controller'=>'users', 'action' => 'home'));?></li>
						<li><?=$this->Html->link(__('Add Expense'), array('controller'=>'expenses', 'action' => 'add'));?></li>
						<li><?=$this->Html->link(__('Edit Profile'), array('controller'=>'users', 'action' => 'edit'));?></li>
						<li><?=$this->Html->link(__('Edit Group Profile'), array('action' => 'add'));?></li>
						<li><?=$this->Html->link(__('List Expenses'), array('controller'=>'expenses', 'action' => 'index'));?></li>
						<li><?=$this->Html->link(__('Logout'), array('controller'=>'users','action' => 'logout'));?></li>
					</ul>
				</div>
			</div>

		</div>

		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>