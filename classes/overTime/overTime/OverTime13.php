<?php
	class OverTime13 extends OverTime{
		private $TipoOverTimeId = 13;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function preTrigger(){
			$Tar = $this->Target;

			$Tar->setMovable(false);
			$Tar->setImpaired(true);

			$val = $this->getValue();
			$heal = $Tar->getPercentualeStat('HP', $val);

			write($Tar->getNome().' riposa');

			$Tar->heal($heal);

			$this->diminuisciTurni();
		}

	}