<?php
	class OverTime4 extends OverTime{
		private $TipoOverTimeId = 4;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function trigger(){
			$Target = $this->Target;

			write('Il veleno scorre dentro '.$Target->getNome().' '.GREEN_HEART."\n");

			$dmg = $this->getValue();
			$dmg *= rand(0.3, 1.5);
			$dmg = (int)$dmg;

			$Danno = new Danno();
			$Danno->setDealer(null);
			$Danno->setDmg($dmg);
			$Danno->setTipo('VELENO');
			$Danno->setPrecisione(999);
			$Target->subisciDanno($Danno);

			$this->diminuisciTurni();
		}
	}