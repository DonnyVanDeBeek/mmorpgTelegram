<?php
	class OverTime9 extends OverTime{
		private $TipoOverTimeId = 9;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function debuff(Danno &$Danno){
			if($Danno->getTipo() == 'SANGUINAMENTO'){
				write($Danno->getTarget()->getNome().' è immune al sanguinamento!'."\n");
				$Danno->setDmg(0);
			}
		}
	}