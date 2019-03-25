<?php
	class Skill41 extends Skill{
		//SUICIDIO INDOTTO
		private $id = 41;
		public function __construct(){
			parent::__construct($this->id);
		}

		public function trigger(){
			$Caster = $this->getCaster();
			$Target = $this->getTarget();

			write($Caster->getNome() . " lancia una maledizione contro " . $Target->getNome()." per indurlo al suicidio\n");

			$res = $Target->changeFocus($Target->getId(), $Target->getEntitaId());

			if($res){
				write($Target->getNome().' inizia a dare visibili segni di squilibrio: è sotto l\'effetto della maledizione!'."\n");
			}else{
				write($Target->getNome().' è immune alla maledizione!'."\n");
			}

			$this->startCooldown($this->getCooldown());

			return true;
		}
	}