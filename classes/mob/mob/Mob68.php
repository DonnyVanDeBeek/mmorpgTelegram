<?php
	Class Mob68 extends Mob{
		//MANIFESTAZIONE ECTOPLASMICA
		public function __construct($id){
			parent::__construct($id);
		}

		public function subisciDannoFisico(Danno &$Danno){
			$Danno->setDmg($Danno->getDmg() * 0.75);
			parent::subisciDannoFisico($Danno);
		}

		public function subisciDannoFuoco(Danno &$Danno){
			$Danno->setDmg($Danno->getDmg() * 0.75);
			parent::subisciDannoFuoco($Danno);
		}

		public function subisciDannoElettrico(Danno &$Danno){
			$Danno->setDmg($Danno->getDmg() * 2);
			parent::subisciDannoElettrico($Danno);
		}

		public function subisciDannoMagico(Danno &$Danno){
			$dmg = $Danno->getDmg();
			$this->setHp($this->getHp() - $dmg);

			write($this->getNome() . ' subisce '.(int)$dmg.' danni magici! '.SYMBOLS_BROKEN_HEART."\n");
			return $dmg;
		}
	}