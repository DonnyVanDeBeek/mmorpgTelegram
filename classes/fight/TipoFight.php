<?php
	class TipoFight{
		private $prefix 	= 'BOT_RPG'; 
		private $tableName 	= 'TIPO_FIGTH';		
		private $primaryKey = 'ID';
		
		protected $data;

		protected $Mobs = array();
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
		
		public function setData($info, $value){
			$this->data[$this->tableName.'_'.strtoupper($info)] = $value;
		}

}