<?php
	class Skill97 extends Skill{
		//PASSO DEL GUERRIERO
		private $id = 97;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " si avvicina a " . $Target->getNome() . " e lo colpisce!" . "\n");

			$Caster->moveTowards($Target);

			$tipo = "TAGLIENTE";
			$dmg = $Caster->getTotalStat('FORZA');
			$prec = $Caster->getTotalStat('PRECISIONE');

			$Danno = new Danno();
			$Danno->setDealer($Caster);
			$Danno->setDmg($dmg);
			$Danno->setTipo($tipo);
			$Danno->setPrecisione($prec);
			$Danno->setEquips($Equips);
			$Danno->setTarget($Target);
			$Danno->isMelee(true);
			$Danno->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}