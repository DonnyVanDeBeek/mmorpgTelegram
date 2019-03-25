<?php
	//SQUARTACANI
	class Equip146 extends Equip{
		private $equipId = 146;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function onHit(&$Target){
			$cost = 50;
			if($Target->provaDi('COSTITUZIONE') < rand(0, $cost)){
				$Ut = $this->utente;
				write('La squartacani di '.$Ut->getNome().' causa ferite a '.$Target->getNome()."\n");

				$dmg = $Ut->getPercentualeStat('FORZA', 20) + $Ut->calculateLevel();

				$sanguinamento = new OverTime();
				$sanguinamento->setTarget($Target);
				$sanguinamento->setNumTurni(3);
				$sanguinamento->setValue($dmg);
				$sanguinamento->setTipoOverTime('SANGUINAMENTO');
				$sanguinamento->send();
				return true;
			}else{
				return false;
			}
		}
	}