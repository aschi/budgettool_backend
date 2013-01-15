<?php
App::uses('AppModel', 'Model');
/**
 * Expense Model
 *
 * @property User $User
 */
class Expense extends AppModel {
	
	
	/**
	 * 
	 */
	public function getAllByGroupId($group_id){
		App::import('Model', 'Group');
		$group = new Group();
		$group->getUserIds($group_id);
				
		$exp = $this->find('all', array(
		    'conditions' => array('Expense.user_id' => $userids), //array of conditions
		    'recursive' => 1, //int
		   	'order' => array('Expense.date ASC'), //string or array defining order
		)); //array of conditions)
		//$group->data['User'][0]
		
		return $exp;
	}
	
	public function getAllByGroupIdAndMonth($group_id, $month){
		App::import('Model', 'Group');
		$group = new Group();
		$userids = $group->getUserIds($group_id);

		$exp = $this->find('all', array(
		    'conditions' => array('Expense.user_id' => $userids, 'MONTH(Expense.date)'=>$month), //array of conditions
		    'recursive' => 1, //int
		   	'order' => array('Expense.date ASC'), //string or array defining order
		)); //array of conditions)
		
		return $exp;
	}
	
	public function getAllByUserId($user_id){
		App::import('Model', 'User');
		$user = new User();
		
		$user->read(null, $user_id);
		return getAllByGroupId($user->data['Group']['id']);
	}

	public function getAllByUserIdAndMonth($user_id, $month){
		App::import('Model', 'User');
		$user = new User();
		
		$user->read(null, $user_id);
		return getAllByGroupIdAndMonth($user->data['Group']['id'], $month);
	}

	public function getTotalByGroupId($group_id){
		App::import('Model', 'Group');
		$group = new Group();
		$group->getUserIds($group_id);
				
		$total = $this->find('all', array(
		    'conditions' => array('Expense.user_id' => $userids), //array of conditions
		    'fields' => array('sum(Expense.value) AS total'),
		)); //array of conditions)
		//$group->data['User'][0]
		
		return $total[0][0]['total'];
	}

	public function getTotalByUserId($user_id){
		App::import('Model', 'User');
		$user = new User();
		
		$user->read(null, $user_id);
		return getTotalByGroupId($user->data['Group']['id']);
	}

	public function getTotalByGroupIdAndMonth($group_id, $month){
		App::import('Model', 'Group');
		$group = new Group();
		$userids = $group->getUserIds($group_id);

		$total = $this->find('all', array(
		    'conditions' => array('Expense.user_id' => $userids, 'MONTH(Expense.date)'=>$month), //array of conditions
		    'fields' => array('sum(Expense.value) AS total'),
		)); //array of conditions)
		
		return $total[0][0]['total'];
	}

	public function getTotalByUserIdAndMonth($user_id, $month){
		App::import('Model', 'User');
		$user = new User();
		
		$user->read(null, $user_id);
		return getTotalByGroupIdAndMonth($user->data['Group']['id'], $month);
	}

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'description';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'description' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'value' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
