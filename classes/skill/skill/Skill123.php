<?php
	class Skill123 extends Skill{
		//SUCCHIASANGUE
		private $id = 123;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " apre una ferita su " . $Target->getNome() . "!" . "\n");

			$dmg = $Caster->getTotalStat('MAGIA') * 0.2;

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("PERFORANTE");
			$da->canBeDodged(false);
			$da->isSpell(true);
			$da->setEquips($Equips);
			$da->setTarget($Target);

			$Sanguinamento = 3;
			$turni = rand(3,5);
			$val = rand($dmg, $dmg*2);
			$OT = OverTime::create($Target, $Sanguinamento, $val, $turni);
			$da->addOverTime($OT);

			$da->send();

			if($da->hasSucceded()){
				$Cost = $Caster->getTotalStat("COSTITUZIONE");
				$healing = rand($Cost * 0.5, $Cost * 1.5);
				$healing = intVal($healing);
				$Caster->heal($healing);
			}

			$this->startCooldown($this->getCooldown());
		
			return true;
		}
	}