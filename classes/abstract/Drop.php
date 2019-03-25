<?php
	Class Drop{
		private $utente;
		private $mob;
		private $item_id;
		private $max;
		private $min;
		private $prob;

		private $db;

		protected $msg = array();

		public function __construct($ut, $mo){
			$this->db = Database();
			$this->utente = $ut;
			$this->mob = $mo;
		}

		public function getMsg($name){
			return $this->msg[$name];
		}

		public function send(){
			$msg = '';
			$j = 0;
			$q = "
				SELECT *
				FROM BOT_RPG_DROP
				WHERE DROP_TIPO_MOB_ID = ".$this->mob->getTipoMobId()."
					AND DROP_SOTTOLUOGO_ID = ".$this->utente->getUtenteSottoluogoId()."
					AND DROP_SOTTOLUOGO_ID = ".$this->mob->getMobSottoluogoId()."
					OR 
					DROP_SOTTOLUOGO_ID = 999999
					AND
					DROP_TIPO_MOB_ID = ".$this->mob->getTipoMobId();
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$count = 0;
				$quan = rand($row->DROP_ITEM_MINQUANTITA, $row->DROP_ITEM_MAXQUANTITA);
				for($i = 0; $i < $quan; $i++){
					if(rand(0, 1000000) < $row->DROP_PROBABILITA){
						$this->utente->gainItem($row->DROP_TIPO_ITEM_ID);
						$count++;
					}
				}

				if($count != 0){
					$msg .= 'x'.$count.' '.$this->getNomeItemById($row->DROP_TIPO_ITEM_ID)."\n";

					$j++;
				}

			}

			if($msg == '')
				$msg = '<b>'.$this->mob->getNome() . ' non ha droppato nulla!</b>'."\n";
			else
				$msg = '<b>'.$this->mob->getNome().' ha droppato:</b>'."\n" . $msg;

			write($msg);

			return true;
		}

		public function getNomeItemById($id){
			$q = "SELECT TIPO_ITEM_NOME FROM BOT_RPG_TIPO_ITEM WHERE TIPO_ITEM_ID = ". $id;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->TIPO_ITEM_NOME;
		}

	}
