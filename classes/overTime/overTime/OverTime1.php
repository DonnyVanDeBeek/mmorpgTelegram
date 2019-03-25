<?php
	class OverTime1 extends OverTime{
		private $TipoOverTimeId = 1;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function trigger(){
			$Target = $this->Target;

			write($Target->getNome().' ha una bruciatura! '.FIRE."\n");

			$dmg = $this->getValue();

			$Danno = new Danno();
			$Danno->setDealer(null);
			$Danno->setDmg($dmg);
			$Danno->setTipo('BRUCIATURA');
			$Danno->setElemento('FUOCO');
			$Danno->setPrecisione(999999);
			$Target->subisciDanno($Danno);

			$this->diminuisciTurni();
		}
	}