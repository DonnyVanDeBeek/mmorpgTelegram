<?php
	class Skill52 extends Skill{
		//FALCIATA
		private $id = 52;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " falcia tutti coloro che lo circondano!" . "\n");

			$dmg = $Caster->getTotalStat('FORZA');
			$prec = $Caster->getTotalStat('PRECISIONE');

			$range = 1;
			$targets = $Caster->getTargetsInRange(1);
			$n = count($targets);
			for($i = 0; $i < $n; $i++){
				write($targets[$i]->getNome().' è nella traiettoria della falce!'."\n");
				$da = new Danno();
				$da->setDealer($Caster);
				$da->setDmg($dmg);
				$da->setTipo("TAGLIENTE");
				$da->setPrecisione($prec);
				$da->setEquips($Equips);
				$da->setTarget($targets[$i]);

				$this->equipBuff($da);
				$this->overtimeBuff($da);

				$da->send();

				unset($da);
			}

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}