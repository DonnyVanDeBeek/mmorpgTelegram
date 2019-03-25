<?php
	class Skill110 extends Skill{
		//ATTACCO ECTOPLASMATICO
		private $id = 110;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " si prepara a tempestare " . $Target->getNome() . " con l'ectoplasma!" . "\n");

			$prec = $Caster->getTotalStat('PRECISIONE');
			$magia = $Caster->getTotalStat('MAGIA');

			$dmg = $magia * $this->getVar(3);
			$buffAlDanno = $magia * $this->getVar(2);

			$minColpi = $this->getVar(0);
			$maxColpi = $this->getVar(1);

			if($maxColpi < $minColpi){
				$minColpi = 3;
				$maxColpi = 5;
			}

			$n = rand($minColpi, $maxColpi);
			for($i = 0; $i < $n; $i++){

				if(Functions::percentuale(50)){
					$dmg += $buffAlDanno;
				}

				$Danno = new Danno();
				$Danno->setDealer($Caster);
				$Danno->setDmg($dmg);
				$Danno->setTipo("FISICO");
				$Danno->setPrecisione($prec);
				$Danno->setEquips($Equips);
				$Danno->setTarget($Target);
				$Danno->isMelee(true);
				$Danno->send();
				unset($Danno);	
			}

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}