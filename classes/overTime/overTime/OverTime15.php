<?php
	class OverTime15 extends OverTime{
		private $TipoOverTimeId = 15;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function preTrigger(){
			$Tar = $this->Target;

			write($Tar->getNome().' è stordito!');

			$Tar->canMove(false);
			$Tar->canCast(false);

			$this->diminuisciTurni();
		}

	}