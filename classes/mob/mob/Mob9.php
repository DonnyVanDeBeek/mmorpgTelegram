<?php
	Class Mob9 extends Mob{
		public function __construct($id){
			parent::__construct($id);
		}

		public function suonaIlFlauto(){
			//Colpo alla testa
			$range = 99;
			$Target = $this->target;
			if($this->getDistanceFrom($Target) > $range){
				//$this->msg['SKILL'];
				return false;
			}

			$Functions = new Functions();
			
			$numTopi = rand(2, 5);
			write($this->getNome() . ' inizia a suonare una dolce melodia... appaiono '.$numTopi.' topi!'."\n");
			for($i = 0; $i < $numTopi; $i++){
				$Functions->spawnSpecificMob(10, $this->getMobSottoluogoId(), $this->getMobLevel() - 1, $Target->getUtenteId(), rand(5, 25), rand(2000, 5000), 50, 5, 5, rand(0, 10), rand(0, 10));
			}

			return true;
		}

		public function melodiaMagica(){
			$range = 5;
			$minRange = 0;

			$Target = $this->target;
			$dist = $this->getDistanceFrom($Target);
			if($dist > $range || $dist < $minRange){
				//$this->msg['SKILL'];
				return false;
			}

			write($this->getNome().' utilizza il potere della musica per lanciare un incantesimo verso '.$Target->getNome()."!\n");

			$dmg = $this->getTotalStat('MAGIA') * rand(1, 2);

			$dan = new Danno();
			$dan->setDealer($this);
			$dan->setDmg((int)$dmg);
			$dan->setTipo('MAGICO');
			$dan->setPrecisione(65);
			$dan->setTarget($Target);
			$dan->send();

			return true;
		}
	}
