<?php
	class OverTime8 extends OverTime{
		private $TipoOverTimeId = 8;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function buff(Danno &$Danno){
			if($Danno->getDealer() !== NULL)
				write('I poteri demoniaci di '.$Danno->getDealer()->getNome()." amplificano il danno!\n");

			$Danno->setDmg($Danno->getDmg()*2);

			$this->diminuisciTurni();
		}
	}