<?php
	class OverTime3 extends OverTime{
		private $TipoOverTimeId = 3;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function trigger(){
			$Target = $this->Target;

			write($Target->getNome().' ha una ferita aperta! '.ARROW_HEART."\n");

			$dmg = $this->getValue();

			$Danno = new Danno();
			$Danno->setDealer(null);
			$Danno->setDmg($dmg);
			$Danno->setTipo('SANGUINAMENTO');
			$Danno->setPrecisione(999);
			$Target->subisciDanno($Danno);

			$this->diminuisciTurni();
		}
	}