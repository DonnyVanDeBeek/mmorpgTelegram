<?php
	class Skill21 extends Skill{
		//PUGNALATA DELLA SPERANZA
		private $id = 21;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . ' si infligge una pugnalata, sperando nella divina provvidenza.' ."\n");

			$dmg = $Caster->getPercentualeStat('HP', 10);
			$heal = $Caster->getPercentualeStat('HP', 25);

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setTipo('PURO');
			$da->setDmg($dmg);
			$da->setPrecisione(999);
			$da->setTarget($Caster);
			$da->send();

			if(rand(0, 100) > 50){
				write("Il tributo di ".$Caster->getNome()." viene accolto!\n");
				$Caster->heal($heal);
			}else{
				write("Non succede nulla...\n");
			}
			
			
			//$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}