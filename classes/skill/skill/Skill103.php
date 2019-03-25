<?php
	class Skill103 extends Skill{
		//SCYTHE SLASH
		private $id = 103;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " corre con la falce contro " . $Target->getNome() . " e lo affetta!" . "\n");

			$dmg = $Caster->getTotalStat('FORZA');
			$prec = $Caster->getTotalStat('PRECISIONE');

			$Caster->goToSamePositionOf($Target);

			$Danno = new Danno();
			$Danno->setDealer($Caster);
			$Danno->setDmg($dmg);
			$Danno->setTipo("TAGLIENTE");
			$Danno->setPrecisione($prec);
			$Danno->setEquips($Equips);
			$Danno->setTarget($Target);
			$Danno->send();

			$Caster->randomMovement();
			$Caster->randomMovement();

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}