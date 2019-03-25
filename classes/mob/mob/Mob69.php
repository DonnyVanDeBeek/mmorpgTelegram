<?php
	Class Mob69 extends Mob{
		//SPETTRO INCATENATO
		public function __construct($id){
			parent::__construct($id);
		}

		public function subisciDannoFuoco(Danno &$Danno){
			$Danno->setDmg($Danno->getDmg() * 0.25);
			parent::subisciDannoFuoco($Danno);
		}

		public function subisciDannoPerforante(Danno &$Danno){
			$Danno->setDmg($Danno->getDmg() * 0.5);
			parent::subisciDannoPerforante($Danno);
		}

		public function subisciDannoElettrico(Danno &$Danno){
			$Danno->setDmg($Danno->getDmg() * 0.5);
			parent::subisciDannoElettrico($Danno);
		}
	}