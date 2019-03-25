<?php
	class Skill20 extends Skill{
		//Ombra Silenziosa
		private $id = 20;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write('Un\'ombra di forma umanoide con in mano una spada prende forma e si avventa su '.$Target->getNome().'!'."\n");

			$dmg = 300;

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setTipo('FISICO');
			$da->setPrecisione($Caster->getTotalStat('PRECISIONE') + 100);
			$da->setDmg($dmg);
			$da->setTarget($Target);
			//$da->setEquips($Equips);
			
			$n = rand(1,3);
			for($i = 0; $i < $n; $i++){
				write('L\'essere delle ombre solleva la spada e colpisce'."\n");
				$da->setDmg(rand(10, $dmg));
				$da->send();
			}

			write('L\'ombra si dissolve, tornando silenziosamente nel suo regno'."\n");

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			//$caster->setPA($caster->getPA() - 1);

			return true;
		}
	}