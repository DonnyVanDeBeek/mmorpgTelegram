<?php
	Class Mob63 extends Mob{
		//RAKT
		public function __construct($id){
			parent::__construct($id);
		}

		public function subisciDannoContundente(Danno &$Danno){
			$Danno->setDmg($Danno->getDmg() * 0.75);
			parent::subisciDannoContundente($Danno);
		}

		public function subisciDannoSanguinamento(Danno &$Danno){
			$Danno->setDmg($Danno->getDmg() * 0.75);
			parent::subisciDannoSanguinamento($Danno);
		}

		public function subisciDannoPerforante(Danno &$Danno){
			$Danno->setDmg($Danno->getDmg() * 1.15);
			parent::subisciDannoPerforante($Danno);
		}


	}