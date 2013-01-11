<?php
App::uses('AppController', 'Controller');
/**
 * Groups Controller
 *
 * @property Group $Group
 */
class GroupsController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Group->recursive = 0;
		$this->set('groups', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Group->id = $id;
		
		if($this->Auth->user('group_id') != $id){
			throw new ForbiddenException(__('You can only see your own group!'));
		}
		
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		$this->set('group', $this->Group->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Group->create();
			if ($this->Group->save($this->request->data)) {
				debug($this->Auth->User('username'));
				
				
				if($this->Group->setGroupAdmin($this->Auth->User('id'))){
					$this->Session->setFlash(__('The group has been saved'));
				} //the creator is the group admin
				$this->redirect(array('controller'=>'users', 'action' => 'home'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		}
		$users = $this->Group->User->find('list');
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
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		
		if($this->Auth->user('id') != $this->Group->user_id){
			throw new ForbiddenException(__('Only the owner may edit a group!'));
		}
		
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Group->save($this->request->data)) {
				$this->Session->setFlash(__('The group has been saved'));
				$this->redirect(array('controller'=>'users', 'action' => 'home'));
			} else {
				$this->Session->setFlash(__('The group could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Group->read(null, $id);
		}
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
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		
		if($this->Auth->user('id') != $this->Group->user_id){
			throw new ForbiddenException(__('Only the owner may delete a group!'));
		}
		
		if ($this->Group->delete()) {
			$this->Session->setFlash(__('Group deleted'));
			$this->redirect(array('controller'=>'users', 'action' => 'home'));
		}
		$this->Session->setFlash(__('Group was not deleted'));
		$this->redirect(array('controller'=>'users', 'action' => 'home'));
	}
	
	public function selectGroup(){
		
		
		
		
	}

	
	public function joinGroup(){
		if ($this->request->is('post')) {
			$grp = $this->Group->find('first', array('conditions' => array('Group.group_name' => $this->request->data['Group']['group_name']))); //array of conditions))
			
			if(empty($grp)){
				throw new NotFoundException(__('Invalid group'));
			}
			
			$this->Group->id = $grp['Group']['id'];
			
			if($this->Group->joinGroup($this->Auth->User('id'), $this->request->data['Group']['password'])){
				$this->Session->setFlash(__('Successfully joined'));
				$this->redirect(array('controller'=>'users', 'action' => 'home'));
			}
			
			$this->Session->setFlash(__('Joining was not possible'));
			$this->redirect(array('controller'=>'users', 'action' => 'home'));
		}
	}

 
 	public function removeMember($id, $user_id){
 		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Group->id = $id;
		if (!$this->Group->exists()) {
			throw new NotFoundException(__('Invalid group'));
		}
		if($this->Auth->user('id') != $this->Group->user_id){
			throw new ForbiddenException(__('Only the owner may delete a group!'));
		}
		if($this->Group->removeMember($user_id)){
			$this->Session->setFlash(__('User removed'));
			$this->redirect(array('controller'=>'users', 'action' => 'home'));
		}
		$this->Session->setFlash(__('User was not removed'));
		$this->redirect(array('controller'=>'users', 'action' => 'home'));
 	}
}
