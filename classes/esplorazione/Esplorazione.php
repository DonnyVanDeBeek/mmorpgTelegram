<?php
	Class Esplorazione{
		private $prefix 	= 'BOT_RPG'; 
		private $tableName 	= 'TIPO_ESPLORAZIONE';		
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

		public function start(){
			write('<b>'.$this->getData('NOME').'</b>'."\n");
			write($this->getData('DESC')."\n");

			$Ut = $this->getUtente();

			$this->giveItems();

			$exp = $this->getData('EXP');
			if($exp > 0){
				write("+$exp exp!\n\n");
				$Ut->giveExp($exp);
			}

			$soldi = $this->getData('SOLDI');
			if($soldi != 0){
				if($soldi > 0){
					write("+$soldi "."£!\n\n");
					$Ut->giveSoldi($soldi);
				}
				else
					$ut->takeSoldi($soldi);
			}

			return true;
		}

		public function giveItems(){
			$id = $this->getId();
			$Ut = $this->getUtente();
			$sql = "SELECT TIPO_ITEM_ID, QUANTITA_MIN, QUANTITA_MAX FROM BOT_RPG_ESPLORAZIONE_ITEM WHERE TIPO_ESPLORAZIONE_ID = $id";
			$res = Database()->query($sql);
			if($res->num_rows == 0) return false;
			write('Hai ottenuto:'."\n");
			while($row = $res->fetch_object()){
				$itemId   = $row->TIPO_ITEM_ID;
				$quantitaMin = $row->QUANTITA_MIN;
				$quantitaMax = $row->QUANTITA_MAX;

				if($quantitaMin < 0)
					$quantitaMin = 0;

				if($quantitaMax < 0)
					$quantitaMax = 0;

				if($quantitaMin > $quantitaMax){
					$tmp = $quantitaMin;
					$quantitaMin = $quantitaMax;
					$quantitaMax = $tmp;
				}

				$quantita = $quantitaMin < $quantitaMax ? rand($quantitaMin, $quantitaMax) : $quantitaMax;

				$Ut->gainItem($itemId, $quantita);
				$itemName = Functions::getTipoItemNameById($itemId);
				$quantita = $quantita > 1 ? " x$quantita" : ''; 
				write("> $itemName".$quantita);			
			}

			write('');

			return true;
		}

		public function redirectToNpc($npcId){
			$npcEvento = $npcId;
			$className = 'Npc'.$npcEvento;
			$Npc = new $className();
			$this->getUtente()->setUtenteNpcId($npcEvento);
			
			$Npc->setUtente($this->getUtente());
			$Npc->setFlag(0);
			$Npc->talk();

			global $key;
			$key = $Npc->getKeyboard();
		}
	}