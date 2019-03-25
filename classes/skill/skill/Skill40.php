<?php
	class Skill40 extends Skill{
		//ARTIGLIATE
		private $id = 40;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " si prepara a graffiare " . $Target->getNome() . " con una serie di artigliate!" . "\n");

			$dmg = $Caster->getPercentualeStat('FORZA', 30);
			$perc = $Caster->getPercentualeStat('PRECISIONE', 90);

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("TAGLIENTE");
			$da->setPrecisione($perc);
			$da->setEquips($Equips);
			$da->setTarget($Target);

			$this->equipBuff($da);
			$this->overtimeBuff($da);

			$n = rand(3,5);
			for($i = 0; $i < $n && $Target->isVivo(); $i++){
				$num = $i+1;
				write('Artigliata numero <b>'.$num.'</b> di '.$Caster->getNome()."!\n");
				$da->send();
			}

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());
			

			return true;
		}
	}