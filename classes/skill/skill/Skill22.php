<?php
	class Skill22 extends Skill{
		//RAFFICA DI FRECCE
		private $id = 22	;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();
			$Equips = $this->getEquips();

			write($Caster->getNome() . ' Si prepara a scoccare numerose frecce.' ."\n");


			$frecce = intVal($Caster->getTotalStat('DESTREZZA')/20) + 3;
			$frecce = rand(3, $frecce);
			$dmg = $Caster->getPercentualeStat('FORZA', 10);
			$precisione = $Caster->getTotalStat('PRECISIONE');

			$da = new Danno();
			$da->setDealer($Caster);
			$da->setTipo('FISICO');
			$da->setElemento('NORMALE');
			$da->setDmg($dmg);
			$da->setPrecisione($precisione);
			$da->setTarget($Target);

			for($i = 0; $i < $frecce; $i++){
				write($Caster->getNome().' scocca una freccia!'."\n");
				$tipo = rand(0, 100) > 25 ? 'FISICO' : 'PURO';
				$da->setTipo($tipo);
				$da->send();
			}
			
			$this->equipOnAttack();
			$this->startCooldown($this->getCooldown());

			return true;
		}
	}