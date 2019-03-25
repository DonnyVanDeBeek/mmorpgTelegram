<?php
	Class Item12 extends Item{
		private $itemId = 12;

		public function __construct(&$OBJ){
			parent::__construct($OBJ, $this->itemId);
		}

		public function trigger(){
			$Utente = &$this->OBJUtente;

			if($this->getItemQuantita() > 0){
				write($Utente->getNome().' si cura con delle bende'."\n");
				$Utente->removeOvertime(3);
				$this->setItemQuantita($this->getItemQuantita() - 1);
			}else{
				write('Non hai delle bende!'."\n");
			}
		}
	}
