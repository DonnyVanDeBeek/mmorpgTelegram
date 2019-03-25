<?php
	//SPADA DI ANTIMATERIA
	class Equip106 extends Equip{
		private $equipId = 106;

		public function __construct(&$ut, $id){
			$this->utente = $ut;
			parent::__construct($id);
		}

		public function onHit(&$Target){
			write($this->getTipoEquipNome().' entra a contatto con '.$Target->getNome().' provocando una tremenda esplosione! '.ATOM."\n");
			$Danno = new Danno();
			$Danno->setTarget($Target);
			$Danno->setDealer($this->utente);
			$Danno->setDmg(rand(50,75));
			$Danno->setTipo('ESPLOSIONE');
			$Danno->canBeDodged(false);
			$Danno->send();
		}
	}