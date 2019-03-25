<?php
	class OverTime16 extends OverTime{
		private $TipoOverTimeId = 16;

		public function __construct(&$Target, $overTimeId){
			parent::__construct($overTimeId, $Target->getEntitaId());
			$this->Target = $Target;
		}

		public function debuff(Danno &$Danno){
			write($this->Target->getNome().' subisce la maledizione di Ekaton!');
			$Danno->modifier(3.5);
		}

		public function trigger(){
			$this->diminuisciTurni();
		}

	}