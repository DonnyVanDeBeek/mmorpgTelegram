<?php
	class OverTime18 extends OverTime{
		private $TipoOverTimeId = 18;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function preTrigger(){
			if($this->getNumTurni() == 1){
				$MaledizioneDiEkaton = 16;
				$this->Target->giveOverTime($MaledizioneDiEkaton, 0, 10);
			}

			$this->diminuisciTurni();
		}

	}