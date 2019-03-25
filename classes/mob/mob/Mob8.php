<?php
	Class Mob8 extends Mob{
		public function __construct($id){
			parent::__construct($id);
		}

		public function ululato(){
			$range = 999;
			$Target = $this->target;
			$dist = $this->getDistanceFrom($Target);
			if($dist > $range){
				//$this->msg['SKILL'];
				return false;
			}

			write($this->getNome() . ' ulula verso il cielo'."\n");

			if(rand(0, 10) >= 8){
				write('sembra che un lupo abbia sentito il suo richiamo!'."\n");
				$Functions = new Functions();
				$Functions->spawnSpecificMob(7, $this->getMobSottoluogoId(), $this->getMobLevel() - 10, $Target->getUtenteId(), $this->getMobHp(), rand(1000, 2000), 50, 5, 5, 0, rand(0, 10));
			}

			return true;
		}

		public function sguardoAssassino(){
			$range = 10;
			$Target = $this->target;
			if($this->getDistanceFrom($Target) > $range){
				//$this->msg['SKILL'];
				return false;
			}

			write($this->getNome() . ' lancia un temibile sguardo verso ' . $Target->getNome()."\n");

			$Debuff = new Buff();
			$Debuff->setUtente($Target);
			$Debuff->setStat('DESTREZZA');
			$Debuff->setDurata(100);
			$Debuff->setValue(rand(-10, -25));
			$Debuff->send();

			return true;
		}
	}
