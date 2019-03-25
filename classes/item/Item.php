F<?php
	Class Item extends TipoItem{
		protected $itemQuantita;
		protected $utenteId;
		protected $tipoItemId;

		protected $OBJUtente;

		private $tableName = 'BOT_RPG_ITEM';

		private $db;

		public function __construct($OBJ, $tipoItemId){
			parent::__construct($tipoItemId);

			//global $con;
			//$this->db = $con->getDB();
			$this->db = Database();

			$this->OBJUtente = $OBJ;

			$q = "SELECT * FROM ".$this->tableName." WHERE UTENTE_ID = ".$this->OBJUtente->getUtenteId()." AND TIPO_ITEM_ID = ".$tipoItemId;
			$res = Database()->query($q);
			if($res->num_rows > 0){
				$row = $res->fetch_object();
				$this->itemQuantita = $row->ITEM_QUANTITA;
			}else{
				$this->itemQuantita = 0;
			}

			$this->tipoItemId   = $tipoItemId;
			$this->utenteId		= $this->OBJUtente->getUtenteId();

		}

		public function getItemQuantita(){
			return $this->itemQuantita;
		}

		public function setItemQuantita($a){
			$this->itemQuantita = $a;
			$q = "UPDATE ".$this->tableName." SET ITEM_QUANTITA = ".$a." WHERE UTENTE_ID = ".$this->utenteId." AND TIPO_ITEM_ID = ".$this->tipoItemId;
			$this->db->query($q);
		}

		public function trigger(){
			//$this->msg['TRIGGER'] = 'Questo item non è utilizzabile.';
			//write($this->getTipoItemDesc()."\n\n");
			write('Questo item non è utilizzabile.');
		}

		public function show(){
			write('<b>'.$this->getTipoItemNome().'</b>'."\n");
			write($this->getTipoItemDesc()."\n\n");
			write('x'.Functions::drawNumberToEmoji($this->getItemQuantita()));
		}

		public function printNoItemErr(){
			write('Non hai questo item'."\n");
			return false;
		}

		public function throw(Danno &$Danno){

		}

		public function togliItem($quantita = 1){
			if($this->getItemQuantita() - $quantita < 0){
				return false;
			}
			$this->setItemQuantita($this->getItemQuantita() - $quantita);
			return true;
		}

		public function incastona(&$Equip){
			write('Questo item non può essere incastonato');
			return false;
		}

		public function getUtente(){
			return $this->OBJUtente;
		}

		public function giveRandomFromPool($Pool, $min = 0, $max = 1){
			$Cibarie = $Pool;
			$n = count($Cibarie);

			$Ut = $this->getUtente();

			$Ut->initNotifyGiveItem();
			for($i = 0; $i < $n; $i++){
				$quantita = rand($min, $max);
				if($quantita > 0){
					$Ut->giveItem($Cibarie[$i], $quantita);
					$Ut->notifyGiveItem($Cibarie[$i], $quantita);
				}
			}
		}

		public function buffDanno(Danno &$Danno){
			if(!$this->togliItem())
				return false;
		}

		public function scagliaDardo(){
			
		}
	}
