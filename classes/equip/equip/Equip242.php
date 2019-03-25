<?php
	//ARIETE
	class Equip242 extends Equip{
		private $equipId = 242;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function canBeActivated(){
			$Ut = $this->getUtente();

			$prova = 140;
			$forza = $Ut->getTotalStat('FORZA');

			if($forza >= $prova){
				return true;
			}
			else{
				write("Devi avere almeno $prova forza per equipaggiare ".$this->getTipoEquipNome());
				return false;
			}
		}
	}