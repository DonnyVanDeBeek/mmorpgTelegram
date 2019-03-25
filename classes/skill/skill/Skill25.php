<?php
	class Skill25 extends Skill{
		//MORSO
		private $id = 25;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();

			write($Caster->getNome() . " spalanca le fauci e tenta di mordere " . $Target->getNome() . "\n");

			$dmg = $Caster->getTotalStat('FORZA');

			if(rand(0,10) > 5){
				$dmg *= 2;
				write('È un morso critico!'."\n");
			}

			$prec = $Caster->getTotalStat('PRECISIONE');
			$precBase = 100;

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("FISICO");
			$da->setPrecisione($prec + $precBase);
			$da->setTarget($Target);

			$this->overtimeBuff($da);

			$da->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}