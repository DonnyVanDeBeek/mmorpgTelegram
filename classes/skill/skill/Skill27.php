<?php
	class Skill27 extends Skill{
		//EVOCAZIONE: TOTEM DELLA VITA
		private $id = 27;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();

			write($Caster->getNome().' ha evocato un Totem Della Vita!'."\n");

			$mob = array(
				'ID'  => 32,
				'LVL' => $Caster->getLevel(),
				'HP'  => 1,
				'X'   => $Caster->getX(),
				'Y'   => $Caster->getY(),
				'TARGET_ID' => $Caster->getId(),
				'TARGET_ENTITA_ID' => $Caster->getEntitaId()
			);

			$Caster->summonMob($mob);

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}