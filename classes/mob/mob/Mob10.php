<?php
	Class Mob10 extends Mob{
		public function __construct($id){
			parent::__construct($id);
		}

		public function rosicchia(){
			//Colpo alla testa
			$range = 0.1;
			$Target = $this->target;
			if($this->getDistanceFrom($Target) > $range){
				//$this->msg['SKILL'];
				return false;
			}

			write($this->getNome() . ' affonda i suoi dentoni!'."\n");

			$dmg = $this->getTotalStat('FORZA') * 0.3;

			$dan = new Danno();
			$dan->setDealer($this);
			$dan->setDmg((int)$dmg);
			$dan->setTipo('PERFORANTE');
			$dan->setPrecisione(999);
			$dan->setTarget($Target);
			$dan->send();

			return true;
		}

		public function movimentoFurtivo(){
			$range = 999;
			$minRange = 1;

			$Target = $this->target;
			$dist = $this->getDistanceFrom($Target);
			if($dist > $range || $dist < $minRange){
				//$this->msg['SKILL'];
				return false;
			}

			write($this->getNome().' zampetta veloce verso '.$Target->getNome()."!\n");

			$n = rand(3, 6);
			for($i = 0; $i < $n; $i++){
				$this->moveTowards($Target);
			}

			return true;
		}
	}
