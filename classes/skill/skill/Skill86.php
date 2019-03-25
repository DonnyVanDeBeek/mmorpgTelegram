<?php
	class Skill86 extends Skill{
		//EVOCAZIONE: SFERE INFERNALI
		private $id = 86;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			write("Se stai leggendo questo significa che codesta skill non è ancora stata programmata\nVai da Donny e digli di muovere il culo!");
			return false;
			/*
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " Sorprende " . $Target->getNome() . " con due attacchi consecutivi!" . "\n");

			$dmg = 0;
			$dmg += intVal(rand($Caster->getTotalStat("FORZA") * 0.1, $Caster->getTotalStat("FORZA")));
			$dmg += intVal(rand($Caster->getTotalStat("FORZA") * 0.1, $Caster->getTotalStat("FORZA")));

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("FISICO");
			$da->setElemento("NORMALE");
			$da->setPrecisione(95);
			$da->setEquips($Equips);
			$da->setTarget($Target);

			$this->equipBuff($da);
			$this->overtimeBuff($da);

			$da->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());
			
			//$caster->setPA($Caster->getPA() - 1);
			*/

			return true;
		}
	}