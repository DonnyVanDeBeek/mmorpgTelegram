<?php
	//SCUDO IGNIFUGO
	class Equip145 extends Equip{
		private $equipId = 145;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function debuff(Danno &$Danno){
			$tipo = $Danno->getTipo();
			if($tipo == 'FUOCO'){
				$dmg = $Danno->getDmg() * 0.1;
				$Danno->setDmg($dmg);
			}
		}
	}