<?php

if(!$_POST){
	echo "ERROR, Post is empty";
}else{
$adressbook = new adressbook();
	if($_POST['f'] == 'updateContacts')
{		$returnedData = $adressbook->getAllContacts();
		print_r($returnedData);
	}
	elseif ($_POST['f'] == 'delAll') {
		$adressbook->delAll();
	}
	elseif($_POST['f'] == 'addNewContact'){
		$msg = $adressbook->addNewContact($_POST);
		print_r($msg);
	}else{
		echo "function doesn't exist";
	}

}
class adressbook{

	private $dbConnection;

	function __construct(){			
		$this->dbConnection = new PDO("mysql:host=localhost;dbname=test", "root", "");
		$this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	private function sqlExecQuery($query, $amountRetriving){
		if($amountRetriving == 'm'){
			try {
			    // prepare sql and bind parameters
			    $stmt = $this->dbConnection->prepare($query);
				$stmt->execute();

			    $data = $stmt->fetchAll(); 
			    return $data;	

			} catch(PDOException $e) {
			   echo "<br>Error: " . $e->getMessage();
			} 
		}elseif($amountRetriving == 's'){
			try {
			    // prepare sql and bind parameters
			    $stmt = $this->dbConnection->prepare($query);
				$stmt->execute();

			    $data = $stmt->fetch(); 
		    return $data;	

			} catch(PDOException $e) {
			   //echo "<br>Error: " . $e->getMessage();
			} 	
		}else{
			echo "Error";
		}
			$this->query = null;
			$this->connPDO = null;	
	}

	public function getAllContacts(){
		return json_encode($this->sqlExecQuery('SELECT * FROM `contacts`;', 'm'));
	}

	public function addNewContact($postData){
		$ifExistsInDb = ($this->sqlExecQuery("SELECT * FROM `contacts` WHERE name= '".$postData['name']."' OR number= '".$postData['number']."' LIMIT 1;", 's'));
		//var_dump($d);
		if($ifExistsInDb != false){
			return json_encode(["msg"=>"Nope, this data does already exist", "s"=>"0"]);
		}else{
			$this->sqlExecQuery("INSERT INTO contacts (`name`, `number`) VALUES ('".$postData['name']."', '".$postData['number']."');", 's');	
			return json_encode(["msg"=>"Added to the Database", "s"=>"1"]);
		}
		
	}
	public function delAll(){
		$this->sqlExecQuery("DELETE FROM contacts;", "s");
	}

}

?>