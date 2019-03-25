<?php
	class OverTime6 extends OverTime{
		private $TipoOverTimeId = 6;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function buff(Danno &$Danno){
			if($Danno->getDealer() !== NULL)
				write('Le armi di '.$Danno->getDealer()->getNome().' sono cosparse di mistura incendiaria'."\n");

			$Damage = new Danno();
			$Damage->setTarget($Danno->getTarget());
			$Damage->setDealer($Danno->getDealer());
			$Damage->setDmg($this->getValue());
			$Damage->setTipo('BRUCIATURA');
			$Damage->setPrecisione(999);

			if(rand(0,10) < 3){
				write('Mistura incendiara applica una bruciatura!'."\n");
				$OT = new OverTime();
				$OT->setTipoOverTime('BRUCIATURA');
				$OT->setValue(5);
				$OT->setNumTurni(rand(1,4));
				$OT->setTarget($Danno->getTarget());
				$Damage->addOverTimes($OT);
			}

			$Damage->send();

			$this->diminuisciTurni();
		}
	}