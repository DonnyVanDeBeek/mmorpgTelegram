<?php
	class OverTime11 extends OverTime{
		private $TipoOverTimeId = 11;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function preTrigger(){
			$Tar = $this->Target;

			$cost = $Tar->provaDi('COSTITUZIONE');
			$conato = $this->getValue();

			if($cost > $conato){
				write($Tar->getNome().' resiste ai conati di vomito!');
			}else{
				write($Tar->getNome().' vomita!');
				$Tar->setImpaired(true);
			}

			$this->diminuisciTurni();
		}

	}