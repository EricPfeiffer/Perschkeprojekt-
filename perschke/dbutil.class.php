<?php 
	require_once('rb.php');


	class DBUtil  {
		
		//Merken, ob DB-Verbindung besteht
		private static $isInit = false;

	
		//*****************
		//*** ALLGEMEIN ***
		//*****************
		
		
		//DB-Verbindung aufbauen
	  public static function initDB(){
			if(!DBUtil::$isInit){
				R::setup( 'mysql:host=localhost;dbname=perschkeprojekt','root', '' );  
				DBUtil::$isInit = true;
			}
		}
		
		//DB-Verbindung schließen
		public static function closeDB(){
				R::close();
				DBUtil::$isInit = false;
		}



		//*************
		//*** Login ***
		//*************
		
		
		public static function checkLogin($name, $pwd){
			if(!DBUtil::$isInit){
				DBUtil::initDB();
			}
			return R::findOne('anmeldung', 'name=:name and pwd=:pwd', [':name'=>$name, ':pwd'=>$pwd]);
		}
		
		public static function register($name, $pwd){
			if(!DBUtil::$isInit){
				DBUtil::initDB();
			}
			$ld = R::dispense('anmeldung');
			$ld->name = $name;
			$ld->pwd = $pwd;
			return R::store($ld);
		}

		
		public static function getAllLogins(){
			if(!DBUtil::$isInit){
				DBUtil::initDB();
			}
			return R::findAll('anmeldung');
		}		

		public static function getLogin($name){
			if(!DBUtil::$isInit){
				DBUtil::initDB();
			}
			return R::findOne('anmeldung', 'name=:name', [':name'=>$name]);
		}		

		public static function deleteLogin($name){
			if(!DBUtil::$isInit){
				DBUtil::initDB();
			}
			$ld =  R::findOne('anmeldung', 'name=:name', [':name'=>$name]);
			if($ld != null) {
				R::trash($ld);
			}
		}		
		public static function addlist($tasklistname,  $task_open, $creator, $task_close){
			$db = new mysqli('localhost','root','','perschkeprojekt');
			
			 $insert = $db->prepare("INSERT INTO tasklist (name, task_open, creator, task_close) VALUES (?,?,?,?)");
             $insert->bind_param('ssss',$tasklistname,$task_open,$creator,$task_close);
             $insert->execute();
			
		}

	
	public static function getTasklists(){
			if(!DBUtil::$isInit){
				DBUtil::initDB();
			}
			
			
			session_start();
			if( isset($_SESSION['name'])){
   
			$user = $_SESSION['name'];
			
			
			return R::find('tasklist', 'creator LIKE ?', [$user]);
			}
			else{return 'Fehler';};
		}		
		
	public static function searchTasklistId($tasklistname,$creator){
			if(!DBUtil::$isInit){
				DBUtil::initDB();
			}
			
			return R::getCell( 'SELECT id FROM tasklist WHERE name LIKE ? AND creator LIKE ? limit 1',
        [$tasklistname,$creator]);
		
    
		}		
	public static function getTask($tasklistid){
			if(!DBUtil::$isInit){
				DBUtil::initDB();
			}
			
			return R::find('task', 'tasklistid LIKE ?', [$tasklistid]);
		}	
public static function deleteTask($id){
			if(!DBUtil::$isInit){
				DBUtil::initDB();
			}
			$ld =  R::findOne('task', 'id LIKE ?', [$id]);
			if($ld != null) {
				R::trash($ld);
			}
		}		
	public static function getTaskEdit($taskid){
			if(!DBUtil::$isInit){
				DBUtil::initDB();
			}
			
			return R::findOne('task', 'id LIKE ?', [$taskid]);
		}	
		
		
		public static function editTask($taskid,$title,$beschreibung,$prio,$enddate,$status){
			if(!DBUtil::$isInit){
				DBUtil::initDB();
			}
					
			$ld = R::findOne('task', 'id LIKE ?', [$taskid]);
			$ld->titel = $title;
			$ld->beschreibung = $beschreibung;
			$ld->prio = $prio;
			$ld->enddate = $enddate;
			$ld->status = $status;
			return R::store($ld);
		}
	
		public static function deleteTasklist($id){
			if(!DBUtil::$isInit){
				DBUtil::initDB();
			}
			$ld =  R::findOne('tasklist', 'id LIKE ?', [$id]);
			if($ld != null) {
				R::trash($ld);
			}
				}
		public static function deleteTasklistEntry($id){
			if(!DBUtil::$isInit){
				DBUtil::initDB();
			}
			$ls =  R::findOne('task', 'tasklistid LIKE ?', [$id]);
			while($ls>0){
		$lb =  R::findOne('task', 'tasklistid LIKE ?', [$id]);
	
			if($lb != null) {
				R::trash($lb);
				
		}	$ls =  R::findOne('task', 'tasklistid LIKE ?', [$id]);		
	}
	}
			public static function getAllTasks(){
			if(!DBUtil::$isInit){
			DBUtil::initDB();}
				
					session_start();
			
   
			$user = $_SESSION['name'];
			
			
			return R::findAll('task', 'creator LIKE ?', [$user]);
		}		
		
		public static function highPrio(){
			if(!DBUtil::$isInit){
			DBUtil::initDB();}
				
					session_start();
			
   
			$user = $_SESSION['name'];
		
			
		$rows = R::getAll( 'SELECT * FROM task WHERE creator = :creator ORDER BY enddate ASC, prio DESC',
        [':creator' => $user] );
		
		$test= R::convertToBeans( 'task', $rows );
		
		return $test;
   
		}		
		public static function searchTasklistName($tasklistid){
			if(!DBUtil::$isInit){
				DBUtil::initDB();
			}
			
			return R::getCell( 'SELECT name FROM tasklist WHERE id LIKE ?',[$tasklistid]);
		
    
		}		

	}
 ?>