<?php
App::uses('AppController', 'Controller');
/**
 * Expenses Controller
 *
 * @property Expense $Expense
 */
class ExpensesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Expense->recursive = 0;
		$this->set('expenses', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Expense->id = $id;
		if (!$this->Expense->exists()) {
			throw new NotFoundException(__('Invalid expense'));
		}
		$this->set('expense', $this->Expense->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Expense->create();
			if ($this->Expense->save($this->request->data)) {
				$this->Session->setFlash(__('The expense has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The expense could not be saved. Please, try again.'));
			}
		}
		$users = $this->Expense->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Expense->id = $id;
		if (!$this->Expense->exists()) {
			throw new NotFoundException(__('Invalid expense'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Expense->save($this->request->data)) {
				$this->Session->setFlash(__('The expense has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The expense could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Expense->read(null, $id);
		}
		$users = $this->Expense->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws MethodNotAllowedException
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Expense->id = $id;
		if (!$this->Expense->exists()) {
			throw new NotFoundException(__('Invalid expense'));
		}
		if ($this->Expense->delete()) {
			$this->Session->setFlash(__('Expense deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Expense was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
