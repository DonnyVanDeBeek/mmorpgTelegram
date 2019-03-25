<?php
	//PELLICCIA DI LUPO SELVATICO
	class Equip76 extends Equip{
		private $equipId = 76;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function debuff(Danno &$Danno){
			if($Danno->getTipo('SANGUINAMENTO')){
				$Danno->setDmg($Danno->getDmg() * 0.5);
			}
		}
	}