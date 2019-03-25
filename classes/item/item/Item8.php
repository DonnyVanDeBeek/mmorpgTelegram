<?php
	class Item8 extends Item{
		private $itemId = 8;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			$Utente = &$this->OBJUtente;

			if($this->getItemQuantita() <= 0){
				$this->msg['TRIGGER'] = 'Non hai questo item!';
				return false;
			}

			$this->setItemQuantita($this->getItemQuantita() - 1);

			$sql = "SELECT STAT_NOME FROM BOT_RPG_STAT WHERE UPPER(STAT_NOME) != 'HP' ORDER BY RAND() LIMIT ".rand(2,5);
			$res = Database()->query($sql);
			$stats = array();
			while($row = $res->fetch_object()){
				$stats[] = strtoupper($row->STAT_NOME);
			}

			$Buff = new Buff();
			$Buff->setUtente($Utente);
			$Buff->setDurata(300);

			$buffs = '';

			$n = count($stats);
			for($i = 0; $i < $n; $i++){
				$Buff->setStat($stats[$i]);
				$Buff->setValue(rand(-100, 100));
				$Buff->send();

				$buffs .= $Buff->getMsg();
			}

			$msg = '';
			$msg .= $Utente->getNome() . ' beve una pozione piccola del caos!'."\n";
			$msg .= $buffs;

			//$this->msg['TRIGGER'] = $msg;
			write($msg);

			//return $msg;
		}
	}
