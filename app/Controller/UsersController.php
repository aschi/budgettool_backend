<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
	
	public function beforeFilter(){
		//allow registration
		$this->Auth->allow('add');
	}
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
		$this->set('_serialize', array('users'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
		$this->set('_serialize', array('user'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			$this->User->group_id = null;
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$usr = array('id'=>$this->User->id, 'password'=>$this->request->data['User']['password'], 'username'=> $this->request->data['User']['username']);
				$this->Auth->login($usr);
        		$this->redirect('/users/home');				
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->layout = 'logedin';
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if(!empty($this->request->data['User']['new_password'])){
				$this->User->set('password', $this->request->data['User']['new_password']);
			}
			
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
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
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

	public function home(){
		$this->layout = 'logedin'; 
		
		$this->User->id = $this->Auth->User('id');
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->User->read(null, $this->Auth->User('id'));
		
		if($this->User->data['Group']['id'] == null){
			$this->redirect(array('controller'=>'groups', 'action'=>'selectGroup'));
		}else{
			$this->loadModel('Expense');
			$this->set('expenses', $this->Expense->getAllByGroupIdAndMonth($this->User->data['Group']['id'], date('n')));
			$this->set('budget', $this->User->data['Group']['budget']);
			$this->set('group', $this->User->data['Group']);
			$this->set('total', $this->Expense->getTotalByGroupIdAndMonth($this->User->data['Group']['id'], date('n')));
			
		}
		
	}

/**
 * login method
 */	
	public function login() {
	    if ($this->request->is('post')) {
		$this->Session->setFlash('Test');			
		if ($this->Auth->login()) {
		    $this->redirect($this->Auth->redirect());
		} else {
		    $this->Session->setFlash(__('Invalid username or password, try again'));
		}
	    }
	}

/**
 * 
 */
	public function logout() {
		$this -> Session -> setFlash('Goodbye!');
		$this -> redirect($this -> Auth -> logout());
	}

}
