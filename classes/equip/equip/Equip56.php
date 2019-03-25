<?php
	//CASTONE VERMIGLIO
	class Equip56 extends Equip{
		private $equipId = 56;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function effect(){
			$Utente = $this->utente;

			write($this->getTipoEquipNome().' attiva il suo effetto curativo!'."\n");

			$heal = 5 + ($Utente->getTotalStat('HP') * 0.03) + ($Utente->getTotalStat('COSTITUZIONE') * 0.03);
			$Utente->heal($heal);
		}
	}