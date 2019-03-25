<?php
	class OverTime5 extends OverTime{
		private $TipoOverTimeId = 5;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function trigger(){
			$Target = $this->Target;

			write('La cura agisce su '.$Target->getNome().' '.DOUBLE_HEART."\n");

			$Target->heal($this->getValue());

			$this->diminuisciTurni();
		}
	}