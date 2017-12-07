<?php
	Class Drop extends Database{
		private $utente;
		private $mob;
		private $item_id;
		private $max;
		private $min;
		private $prob;

		public function __construct($ut, $mo){
			$this->getDB();
			$this->utente = $ut;
			$this->mob = $mo;
		}

		public function send(){
			$msg = '';
			$q = "
				SELECT *
				FROM BOT_RPG_DROP
				WHERE DROP_TIPO_MOB_ID = ".$this->mob->getTipoMobId()."
					AND DROP_SOTTOLUOGO_ID = ".$this->utente->getUtenteSottoluogoId()."
					AND DROP_SOTTOLUOGO_ID = ".$this->mob->getMobSottoluogoId();
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
				}

			}

			if(is_null($msg))
				$msg = $this->mob->getNome() . ' non ha droppato nulla!';
			else
				$msg = '<b>Uccidendo '.$this->mob->getNome().' hai ottenuto:</b>'."\n" . $msg;

			return $msg;
		}

		public function getNomeItemById($id){
			$q = "SELECT TIPO_ITEM_NOME FROM BOT_RPG_TIPO_ITEM WHERE TIPO_ITEM_ID = ". $id;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->TIPO_ITEM_NOME;
		}

	}
