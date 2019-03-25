<?php
	class Skill51 extends Skill{
		//FUCILATA
		private $id = 51;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . " spara una fucilata a  " . $Target->getNome() . "!" . "\n");

			$dmg = $Caster->getTotalStat('PRECISIONE');
			$prec = $Caster->getTotalStat('PRECISIONE');

			if($Caster->hasTipoEquipAttivo(131)){
				$dmg *= 2;
				write('Grazie al cappello da pistolero la fucilata è davvero devastante!');
			}

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setDmg($dmg);
			$da->setTipo("PERFORANTE");
			$da->setPrecisione($prec);
			$da->setEquips($Equips);
			$da->setTarget($Target);

			$da->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}