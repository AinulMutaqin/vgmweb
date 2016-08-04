<?php
namespace App\Controller\Api;

use App\Controller\Api\ApiController;
use Cake\Event\Event;
use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;

class VgmController extends ApiController {
	private $connnection;
	private $username;
	private $lastname;
	private $password;
	private $terminal;
	private $userid;
	
	public function beforeFilter(Event $event) {
		parent::beforeFilter($event);
		$this->connection = ConnectionManager::get('default');
	}
	
	public function index()
    {
        $data = array(
            "user" => 0,
            "password" => 1,
            "terminal" => 2,
			"userId" => 3,
			"gateLane" => 4,
			"apiHessian" => 5,
            "apiTca" => 6
        );

        $this->set('data', $data);
        $this->set('_serialize', ['data']);
    }
	
	function login() {
		$user = @$_GET['userid'];
		$password = @$_GET['password'];
		$terminal = @$_GET['terminal'];
		
		$lane = array();
		$this->request->input('json_decode');
		$resultRequest = $this->validateRequest($user, $password, $terminal);
		
		if($resultRequest != null) {
			$data = $this->responseData($user, $password, $terminal);
			
			if($data != null) {
			$reslane = $this->getGateLane($terminal);
			
			foreach($reslane as $idx => $varData) {
				$varData[$idx]['lane'] = $varData['lane'];
				array_push($lane, $varData[$idx]['lane']);
			}
			
			$resapi = $this->getApi($terminal);
			
			foreach($resapi as $idx => $varData) {
				$valData[$idx]['url'] = $varData['url'];
				$valData[$idx]['type'] = $varData['type'];
				
				if($valData[$idx]['type'] == 'tca') {
					$apiTca = $valData[$idx]['url'];
				} else if($valData[$idx]['type'] == 'hessian') {
					$apiOpus = $valData[$idx]['url'];
				}
			}
			
			$apiOpusProd="http://opuspjg.indonesiaport.co.id/HESSIAN/HESSIAN_AUTOGATE";
			$apiTcaProd="http://10.10.31.36/opus_vgmapps_prod/index.php";
			$authorization="1";
			
			$this->set('username', $this->username = $data[0]['username']);
			$this->set('lastname', $this->lastname = $data[0]['lastname']);
			$this->set('terminal', $this->terminal = $data[0]['terminal']);
			$this->set('userid', $this->userid = $data[0]['userid']);
			$this->set('lane', $lane);
			$this->set('apiOpus', $apiOpus);
			$this->set('apiTca', $apiTca);
			$this->set('apiOpusProd', $apiOpusProd);
			$this->set('apiTcaProd', $apiTcaProd);
			$this->set('authorization', $authorization);
			
			$this->set('_serialize', ['username', 'lastname', 'terminal', 'userId', 'apiOpus','apiTca', 'apiOpusProd','apiTcaProd','authorization','lane']);
			Log::write('debug','hasil response data \n username: '.$this->userid . 'lastname: '.$this->username);
			
			} else {
				$this->responseNegative();
			}
			
		} else {
			$this->responseNegative();
		}
	}
	
	function validateRequest($user, $password, $terminal) {
        $query = "select USER_ID, PASSWORD, TERMINAL 
				from tempuser where USER_ID = '$user' and PASSWORD = '$password' and TERMINAL = '$terminal'";
        $data = $this->connection->execute($query)->fetchAll('assoc');
        return $data;
    }
	
	function responseData($user, $password, $terminal) {
		$query = "select distinct
				  u.username,
				  u.lastname,
				  u.password,
				  t.terminal,
				  u.userid,
				  a.url
				from users u,
				trx_user_terminal tr,
				terminal t,
				trx_api_terminal ap,
				api a
				where 
				tr.userid = u.userid
				and ap.idTerminal = t.terminal
				and a.api_id = ap.idApi
				and u.userid = $user
				and u.password = '$password'
				and t.terminal = '$terminal'";
		$data = $this->connection->execute($query)->fetchAll('assoc');
		return $data;
	}
	
	function getGateLane($terminal) {
		$query = "select lane from lane where terminalId = '$terminal'";
		$data = $this->connection->execute($query)->fetchAll('assoc');
		return $data;
	}
	
	function getApi($terminal) {
		$query = "select b.url, b.type from trx_api_terminal a
			inner join api b on b.api_id = a.idApi
			where a.idTerminal = '$terminal'";
		$data = $this->connection->execute($query)->fetchAll('assoc');
		return $data;
	}
	
	function responseNegative() {
        $this->set('pesan', 'Data tidak ditemukan.');
        $this->set('_serialize', ['pesan']);
    }
	
	function writelogServer() {
		/*request format json 
		{"datetime":"01-07-2016","messageLog":"Hardcode First July","terminal":"PLG","userId":"324636","truckId":"IN01"}*/
		$log = @$_REQUEST['log'];
		
		$logMap = json_decode($log, true);
		
		$datetime = $logMap['datetime'];
		$messageLog = $logMap['messageLog'];
		$terminal = $logMap['terminal'];
		$user = $logMap['userId'];
		$truckId = $logMap['truckId'];
					
		Log::write("debug", "Result Datetime: ".$datetime. "Log: ".$messageLog.
					"Terminal: ".$terminal."User: ".$user."Truck: ".$truckId);
		
		$query = "insert into log_transaction (transaction_name) values ('$log')";
		
		if ($this->connection->execute($query)) {
			$message = "Success. Data has been inserted.";
		} else {
			$message = "Failed. Please check service later.";
		}
		
		$this->set('message', $message);
		$this->set('_serialize', ['message']);
	}
}
?>