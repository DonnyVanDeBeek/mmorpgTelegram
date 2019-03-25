<?php
	class OverTime19 extends OverTime{
		private $TipoOverTimeId = 19;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function debuff(Danno &$Danno){
			$tipo = $Danno->getTipo();
			if($tipo == "BRUCIATURA" || $tipo == "FUOCO")
				$Danno->setDmg(0);
		}

		public function buff(Danno &$Danno){
			$Dealer = null;
			$D = new Danno();
			$D->setTipo('FUOCO');
			$D->canBeDodged(false);
			$D->setDealer($Dealer);
			$D->setTarget($Danno->getTarget());
			$D->setDmg($Danno->getDmg() * 0.1);
			$Danno->addCollateralDamage($D);
			//$D->send();
		}

		public function preTrigger(){
			$this->diminuisciTurni();
		}

	}