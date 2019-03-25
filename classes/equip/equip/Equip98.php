<?php
	//TAGLIAGOLE
	class Equip98 extends Equip{
		private $equipId = 98;

		public function __construct(&$ut, $id){
			$this->utente = $ut;
			parent::__construct($id);
		}

		public function buff(Danno &$Danno){
			$Utente = $this->utente;

			if(rand(1, 10) > 6) return 0;

			write($this->getTipoEquipNome().' lacera '.$Danno->getTarget()->getNome().'!'."\n");

			$OT = new OverTime();
			$OT->setTipoOverTime('SANGUINAMENTO');
			$OT->setValue((int)$Utente->getTotalStat('FORZA')/6);
			$OT->setNumTurni(3);
			$OT->setTarget($Danno->getTarget());
			$Danno->addOverTimes($OT);
		}
	}