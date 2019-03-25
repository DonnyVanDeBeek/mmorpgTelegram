<?php
	class Skill53 extends Skill{
		//MIETERE
		private $id = 53;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " si prepara a mietere " . $Target->getNome() . " con la falce!" . "\n");

			$dmg = (int)$Caster->getTotalStat('FORZA')/2;
			$prec = $Caster->getTotalStat('PRECISIONE');

			$n = 3;
			for($i = 0; $i < $n; $i++){
				write('Parte il colpo di falce da parte di '.$Caster->getNome()."!\n");

				$da = new Danno();
				$da->setDealer($Caster);
				$da->setDmg($dmg);
				$da->setTipo("TAGLIENTE");
				$da->setPrecisione($prec);
				$da->setEquips($Equips);
				$da->setTarget($Target);

				$this->equipBuff($da);
				$this->overtimeBuff($da);
				$da->send();

				unset($da);
			}

			if($Target->getHp() <= (int)$Target->getPercentualeStat('HP', 10)){
				write($Caster->getNome()." infierisce su ".$Target->getNome()."!!!\n");

				$da = new Danno();
				$da->setDealer($Caster);
				$da->setDmg($dmg);
				$da->setTipo("TAGLIENTE");
				$da->setPrecisione($prec);
				$da->setEquips($Equips);
				$da->setTarget($Target);

				$this->equipBuff($da);
				$this->overtimeBuff($da);
				$da->send();
			}

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}