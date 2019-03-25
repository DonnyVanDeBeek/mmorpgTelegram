<?php
	Class Gilda{
		private $prefix 	= 'BOT_RPG'; 
		private $tableName 	= 'GILDA';		
		private $primaryKey = 'ID';
		
		protected $data;

		protected $utente;

		public function __construct($id){
			$db = Database();
			
			$prefix 	= $this->prefix;
			$tableName 	= $this->tableName;
			$primaryKey = $this->primaryKey;
			
			$sql = "SELECT * FROM ".$prefix.'_'.$tableName." WHERE ".$tableName.'_'.$primaryKey." = ".$id;
            $res = $db->query($sql);
            $row = $res->fetch_object();
			
			$sql = "SHOW COLUMNS FROM ".$prefix.'_'.$tableName;
        	$res = $db->query($sql);
			
			while($row1 = $res->fetch_object()){
        		$this->data[$row1->Field] = $row->{$row1->Field};
        	}
		}
		
        public function getData($info){
            $info = $this->tableName.'_'.strtoupper($info);
            return $this->data[$info];
        }

        public function get($info){
            $info = $this->tableName.'_'.strtoupper($info);
            return $this->data[$info];
        }
		
		public function setDataBase($info, $value){
			$this->data[$this->tableName.'_'.strtoupper($info)] = $value;
		}

		public function setUtente(&$a){
			$this->utente = $a;
		}

		public function getUtente(){
			return $this->utente;
		}

		public function getId(){
			return $this->getData('ID');
		}


		public function setData($info, $value){
			$this->setDataBase($info, $value);
			$tableName 	= $this->tableName;
			$primaryKey	= $this->primaryKey;
			$sql = "UPDATE ".$tableName." SET ".$tableName.'_'.strtoupper($info)." = ".$value." WHERE ".$tableName.'_'.$primaryKey." = ".$this->getData($primaryKey);
			Database()->query($sql);
		}

		public function mainMenu(){
			write('Questa gilda è in costruzione');
		}

		public function getGradoNome($gradoId){
			$gildaId = $this->getData('ID');
			$sql = "SELECT GRADO_NOME FROM BOT_RPG_GILDA_GRADO WHERE GRADO_ID = $gradoId AND GILDA_ID = $gildaId";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			return $row->GRADO_NOME;
		}

	}