<?php
	Class Mob40 extends Mob{
		//QUERCIA
		public function __construct($id){
			parent::__construct($id);
		}

		public function doSomething(&$target){
			$this->target = $target;

			$Intelligenza = new AI('DO_NOTHING');
			$Intelligenza->setDealer($this);
			$Intelligenza->setTarget($target);
			$Intelligenza->run();
		}

		public function subisciDannoBruciatura(Danno $Danno){
			$dmg = $Danno->getDmg() * rand(2,3);
			$this->setMobHp($this->getMobHp() - $dmg);

			//write($this->getNome() . ' subisce '.(int)$dmg.' danni da bruciatura! '.SYMBOLS_BROKEN_HEART."\n");
			write('Il tronco di '.$this->getNome().' viene divorato dalle fiamme e subisce '.(int)$dmg.' danni da bruciatura! '.SYMBOLS_BROKEN_HEART.FIRE."\n");
			return $dmg;
		}

		public function subisciDanno(Danno $Danno){
			parent::subisciDanno($Danno);
			if(rand(0,100) < 10 && $Danno->getDealer() !== NULL){
				$legno = 9;
				$quantita = rand(1,10);
				$Danno->getDealer()->gainItem($legno, $quantita);
				write($Danno->getDealer()->getNome().' ottiene <b>'.$quantita.'</b> pezzi di legno!');
			}
		}
	}