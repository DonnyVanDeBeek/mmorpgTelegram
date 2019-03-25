<?php
	//CIONDOLO DI AMBRA
	class Equip26 extends Equip{
		private $equipId = 26;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function debuff(Danno &$Danno){
			if(rand(1, 10) > 5){
				$dmg = $Danno->getDmg();
				$dmg = (int)$dmg - ($dmg * 0.5);
				$Danno->setDmg($dmg);
				write('Ciondolo Di Ambra riduce del 50% il danno!');
			}
		}
	}