<?php
App::uses('Expense', 'Model');

/**
 * Expense Test Case
 *
 */
class ExpenseTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.expense',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Expense = ClassRegistry::init('Expense');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Expense);

		parent::tearDown();
	}

}
