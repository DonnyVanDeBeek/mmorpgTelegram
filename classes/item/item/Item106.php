<?php
	//POZIONE MAGGIORE DELLA FORZA
	class Item106 extends Item{
		private $itemId = 106;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			$Utente = &$this->OBJUtente;

			if($this->togliItem(1)){
				write($Utente->getNome().' beve una pozione maggiore della forza!'."\n");
				$Buff = new Buff();
				$Buff->setTarget($Utente);
				$Buff->setStat('FORZA');
				$Buff->setValue(50);
				$Buff->setTurni(5);
				$Buff->send();
			}else{
				write("Non hai pozioni maggiori della forza!\n");
			}
		}
	}