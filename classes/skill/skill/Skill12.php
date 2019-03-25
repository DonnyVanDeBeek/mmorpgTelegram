<?php
	class Skill12 extends Skill{
		//LEGAME DI SANGUE
		private $id = 12;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . ' si taglia il braccio e fa sgorgare il proprio sangue sul terreno.'."\n");

			$dmg = $Caster->getPercentualeStat('HP', 3);


			$da = new Danno();
			$da->setDealer($Caster);
			$da->setTipo('PURO');
			$da->setElemento('NORMALE');
			$da->setPrecisione(999);
			$da->setDmg($dmg);
			$da->setTarget($Caster);
			$da->send();

			write($Target->getNome().' subisce il patto sanguigno'."\n");

			$da->setEquips($Equips);

			/*
			$Caster->loadEnemies();
			$arr = $Caster->getEnemies();
			$n = count($arr);
			for($i = 0; $i < $n; $i++){
				$da->setTarget($arr[$i]);
				$this->equipBuff($da);
				$da->send();
			}
			*/
			$this->equipBuff($da);
			$da->setTarget($Target);
			$da->setDmg($dmg * rand(2,5));
			$da->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			//$caster->setPA($caster->getPA() - 1);

			return true;
		}
	}