<?php
	class Skill142 extends Skill{
		//FLAGELLO D'ASCE
		private $id = 142;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " si avventa contro " . $Target->getNome() . " con numerosi fendenti!" . "\n");

			$dmg = $Caster->getPercentualeStat('FORZA', 60);
			$prec = $Caster->getPercentualeStat('PRECISIONE', 50);

			$min = 3;
			$max = 5;
			$n = rand($min,$max);
			for($i = 0; $i < $n && $Target->isVivo(); $i++){
				write('L\'ascia taglia l\'aria!');
				$Danno = new Danno();
				//$Danno->setFrase($frase);
				$Danno->setDealer($Caster);
				$Danno->setDmg($dmg);
				$Danno->setTipo("FISICO");
				$Danno->setPrecisione($prec);
				$Danno->setEquips($Equips);
				$Danno->setTarget($Target);
				$Danno->isMelee(true);
				$Danno->send();
			}

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}