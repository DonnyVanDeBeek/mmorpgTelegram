<?php
	class Item6 extends Item{
		private $itemId = 6;

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

			$Buff = new Buff();
			$Buff->setUtente($Utente);
			$Buff->setStat('FORZA');
			$Buff->setValue(10);
			$Buff->setDurata(300);
			$Buff->send();

			$msg = '';
			$msg .= $Utente->getNome() . ' beve una pozione piccola della forza!'."\n";
			$msg .= $Buff->getMsg();

			//$this->msg['TRIGGER'] = $msg;
			write($msg);

			//return $msg;
		}
	}
