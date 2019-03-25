<?php
	Class Item1 extends Item{
		private $itemId = 1;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			$hasCipolla = false;
			$isIncantata = false;

			$Utente = &$this->OBJUtente;

			$h = 20;
			if($this->getItemQuantita() > 0){
				$hasCipolla = true;
				$this->setItemQuantita($this->getItemQuantita() - 1);
				if($this->isIncantata()){
					$h += 80;
					$isIncantata = true;
				}
			}

			//COSTRUISCI MESSAGGIO
			$msg = '';
			if($hasCipolla){
				$msg .= $Utente->getNome() . ' mangia una cipolla.' . "\n";
				if($isIncantata) $msg .= 'Era una cipolla incantata!' . "\n";
				$msg .= $Utente->getMsg('HEAL');
			}else{
				$msg .= 'Non hai cipolle! Uccidi qualche orco!' . "\n";
			}

			//$this->msg['TRIGGER'] = $msg;
			write($msg);
			if($hasCipolla)
				$Utente->heal(rand(0,$h));


			//return $msg;
		}

		public function isIncantata(){
			if(rand(0,10) > 8)
				return true;
			else return false;
		}

	}
