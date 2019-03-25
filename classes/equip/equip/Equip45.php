<?php
	//BASTONE CHIODATO
	class Equip45 extends Equip{
		private $equipId = 45;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function onHit(&$Target){
			$prob = 5;
			$rand = rand(1, 10);
			if($rand > $prob) return false;

			$chiodi = rand(2, 10);

			write('Ben ben $chiodi di '.$this->getTipoEquipNome().' trafiggono '.$Target->getNome().'!');

			$dmg = $chiodi * 5;

			$D = new Danno();
			$D->setDmg($dmg);
			$D->setDealer($this->utente);
			$D->setTarget($Target);
			$D->setTipo('PERFORANTE');
			$D->setPrecisione(9999);
			$D->send();
		}
	}