<?php
	Class Mob11 extends Mob{
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
	}
