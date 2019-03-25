<?php
	Class Item10 extends Item{
		private $itemId = 10;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			$Utente = &$this->OBJUtente;

			if($this->getItemQuantita() > 0){
			write($Utente->getNome().' cosparge il suo equip di mistura incendiaria'."\n");
				$OT = new OverTime();
				$OT->setTipoOverTime('MISTURA INCENDIARIA');
				$OT->setValue(20);
				$OT->setNumTurni(rand(2, 5));
				$OT->setTarget($Utente);
				$OT->send();
				$this->setItemQuantita($this->getItemQuantita() - 1);
			}else{
				write('Non hai della mistura incendiaria!'."\n");
			}
		}
	}
