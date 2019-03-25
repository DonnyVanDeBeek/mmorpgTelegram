<?php
	//STOCCO FULMINEO
	class Equip143 extends Equip{
		private $equipId = 143;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function onHit(&$Target){
			$dmg = rand(10, 30);

			$D = new Danno();
			$D->setDealer(null);
			$D->setTarget($Target);
			$D->setDmg($dmg);
			$D->setTipo('ELETTRICO');
			$D->setPrecisione(99999);
			$D->send();
		}
	}