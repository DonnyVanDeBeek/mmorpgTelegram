<?php
	class Skill11 extends Skill{
		//ATTACCO BASE
		private $id = 11;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . ' usa Tempesta di Vergate contro ' . $Target->getNome()."\n");

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setTipo('FISICO');
			$da->setElemento('NORMALE');
			$da->setPrecisione(80);
			$da->setTarget($Target);

			$forza = $Caster->getTotalStat('FORZA');

			$i = 0;
			$colpito = true;
			while($colpito && $i < 10){
				if(!$Target->isVivo()) break;
				write($Caster->getNome() . ' cala la verga su ' . $Target->getNome().' '.ROD."\n");
				$dmg = intVal(rand($forza * 0.5, $forza * 0.7));
				$da->setDmg($dmg);
				$this->equipBuff($da);
				$colpito = $Target->subisciDanno($da);
				if($da->getPrecisione() > 20)
					$da->setPrecisione($da->getPrecisione() - 10);
				$i++;
			}

			write($Caster->getNome() . ' ha calato la verga ' . $i . ' volte!'."\n");
			
			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}