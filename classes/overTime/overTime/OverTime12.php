<?php
	class OverTime12 extends OverTime{
		private $TipoOverTimeId = 12;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function preTrigger(){
			$Tar = $this->Target;

			if($Tar->provaDi('COSTITUZIONE') > rand(0, $this->getValue())){
				write($Tar->getNome().', grazie alla sua tempra, riesce a liberarsi dal congelamento!'."\n");
				$this->setTurni(0);
				return false;
			}

			write($Tar->getNome().' è congelato!');

			$Tar->canMove(false);
			$Tar->canCast(false);

			$this->diminuisciTurni();
		}
	}