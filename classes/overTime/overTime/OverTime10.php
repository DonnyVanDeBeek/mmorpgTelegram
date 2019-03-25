<?php
	class OverTime10 extends OverTime{
		private $TipoOverTimeId = 10;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function trigger(){
			$this->diminuisciTurni();
		}

		public function debuff(Danno &$Danno){
			write($Danno->getTarget()->getNome().' è immateriale e non può essere danneggiato!');
			$dmg = 0;
			$emptyArray = array();
			$Danno->setDmg($dmg);
			$Danno->setOverTimes($emptyArray);
			$Danno->setBuff($emptyArray);
			$Danno->setEquips($emptyArray);
		}
	}