<?php
App::uses('AppModel', 'Model');
/**
 * Group Model
 *
 * @property User $User
 * @property User $User
 */
class Group extends AppModel {

	/**
	 * Join group
	 */
 	public function joinGroup($user_id, $password){
 		App::import('Model', 'User');
		$user = new User();
		
		$this->read(null, $this->id);
		
		if($this->data['Group']['password'] == AuthComponent::password($password)){
			$usrdata = array(
				'User' => array(
					'id' => $user_id,
					'group_id' => $this->id
				)
			);	
			if($user->save($usrdata)){
				return true;	
			}
		}
		return false;
 	}

	public function getUserIds($group_id){
		$this->recursive = 1;
		$this->read(null, $group_id);
		
		$i = 0;
		while(array_key_exists($i, $this->data['User'])){
			$userids[] = $this->data['User'][$i]['id'];
			$i++;
		}
		return $userids;
	}

	/**
	 * remove member
	 */
	public function removeMember($user_id){
		App::import('Model', 'User');
		$user = new User();
		
		$usrdata = array(
			'User' => array(
				'id' => $user_id,
				'group_id' => null
			)
		);	
		if($user->save($usrdata)){
			return true;	
		}
		return false;		
	}

	/**
	 * use the given user as admin of the current group
	 */
	public function setGroupAdmin($user_id){
		App::import('Model', 'User');
		$user = new User();
		
		$usrdata = array(
			'User' => array(
				'id' => $user_id,
				'group_id' => $this->id
			)
		);	
		if($user->save($usrdata)){
			$groupdata = array(
				'Group' => array(
					'id' => $this->id,
					'user_id' => $user_id
				)
			);
			
			if($this->save($groupdata)){
				return true;
			}
		}
		return false;
	}


	/**
	 * function beforeSave
	 * used for password hashing
	 */
	public function beforeSave($options = array()) {
	if(isset($this->data['Group']['changePassword'])){
		if (isset($this->data['Group']['password'])) {
		    $this->data['Group']['password'] = AuthComponent::password($this->data['Group']['password']);
		}
	}
        return true;
    }


/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'group_name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'group_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'budget' => array(
			'numeric' => array(
				'rule' => array('numeric'),
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

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'group_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
