<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
	private $connnection;
	
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->Auth->allow(['add', 'logout']);
	}
	
	public function login() {
		if($this->request->is('post')) {
			
			$user = $this->Auth->identify();
			
			if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
			$this->Flash->error(__('Invalid username or password, try again'));
			
		}
	}
	
	public function logout() {
		//version example Blog Tutorial - Authentication and Authorization
		$this->Flash->success('You are now logged out.');
		return $this->redirect($this->Auth->logout());
	}
	
	//event update users (refresh) secara keseluruhan
	public function updateUsersAll() {
		//pastikan data user yg di import sudah ada di table tempuser secara keseluruhan
		$query = " CALL sp_update_users_all() ";
		$this->connection->execute($query);
	}
	
	//event update users (refresh) berdasarkan terminal
	public function updateUsers($pTerminal) {
		//pastikan data user yg di import sudah ada di table tempuser sesuai terminal yang dipilih
		//$query = " CALL sp_update_users('$terminal') "; //mentok ganti cara lain
		//$result = $this->connection->execute($query);
		
		$query = ""; //var string query
		//var yang diperkirakan berubah
		$username = "";
		$lastname = "";
		$password = "";
		
		//isi terlebih dulu userid utk keperluan cek satu per satu di table user
		$query = " SELECT userid, username, lastname, password FROM users WHERE terminal = '$pTerminal' ";
		var_dump($query); exit;
		$dataUsers = $this->connection->execute($query)->fetchAll('assoc');
		//var_dump($dataUsers); exit;
		
		if($dataUsers != null) {
				foreach($dataUsers as $idx => $varData) {
				$dataPerUsers[$idx]['userid'] = $varData['userid'];
				$dataPerUsers[$idx]['username'] = $varData['username'];
				$dataPerUsers[$idx]['lastname'] = $varData['lastname'];
				$dataPerUsers[$idx]['password'] = $varData['password'];
				
				$query = "";
				//cek dengan table master user temp
				$query = " SELECT USER_1STNAME, USER_LASTNAME, PASSWORD 
						FROM tempuser WHERE USER_ID = $dataPerUsers[$idx]['userid'] ";
				$dataUsersTemp = $this->connection->execute($query)->fetchAll('assoc');
				
				foreach ($dataUsersTemp as $idx => $varDataTemp) {
					$usernameTemp = $varDataTemp['USER_1STNAME'];
					$lastnameTemp = $varDataTemp['USER_LASTNAME'];
					$passwordTemp = $varDataTemp['PASSWORD'];
					
					if($dataPerUsers[$idx]['username'] != $usernameTemp) {
						$username = $usernameTemp;
						$lastname = $lastnameTemp;
						$password = $passwordTemp;
					}
				}
				
				//ubah berdasarkan userid yang terjadi perubahan di salah satu field tersebut
				$query = "";
				$query = " UPDATE users ";
				$query .= " SET username = '" . $username . "' ";
				$query .= ", lastname = '". $lastname ."' ";
				$query .= ", password = '". $password ."' ";
				$query .= " WHERE ";
				$query .= " userid = " . $dataPerUsers[$idx]['userid'];
				$this->connection->execute($query);
			}
		}
	}
	
	/**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
		$users = $this->paginate($this->Users);
		
		$this->loadModel('Terminal'); //panggil list terminal
		$listTerminal = $this->Terminal->find('all');
		
		$this->set(compact(['users', 'listTerminal']));
        $this->set('_serialize', ['users']);
		
		/* $this->paginate = [
			'conditions' => [
				'Users.userid' => $this->Auth->user('userid'),
			]
		];
		$this->set('users', $this->paginate($this->Users));
		$this->set('_serialize', ['users']); */
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
			$user->userid = $this->Auth->user('userid');
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        //$this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->data);
			$user->userid = $this->Auth->user('userid');
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
	
}
