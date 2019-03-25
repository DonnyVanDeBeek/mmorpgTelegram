<?php
	class Skill17 extends Skill{
		//BECCATA
		private $id = 17;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . ' mira a perforare '.$Target->getNome().' con una tremenda beccata!'."\n");

			if(rand(0,10) > 7){
				$tipo = 'PERFORANTE';
				write($Caster->getNome() . ' riesce a individuare un punto scoperto nel corpo di '.$Target->getNome()."\n");
			}else{
				$tipo = 'FISICO';
			}

			$dmg = (int)$Caster->getTotalStat('FORZA') * 0.25;


			$da = new Danno();
			$da->setDealer($Caster);
			$da->setTipo($tipo);
			$da->setPrecisione($Caster->getTotalStat('PRECISIONE') + 100);
			$da->setDmg($dmg);
			$da->setTarget($Target);
			$da->setEquips($Equips);
			$da->send();

			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			//$caster->setPA($caster->getPA() - 1);

			return true;
		}
	}