<?php
	Class Mob86 extends Mob{
		//ANIMA INFERNALE
		public function __construct($id){
			parent::__construct($id);
		}

		public function subisciDannoMagico(Danno &$Danno){
			$perc = 2.5;
			$Danno->modifier($perc);
			parent::subisciDannoMagico($Danno);
		}

		public function dealWithOverTime(OverTime &$OverTime){
			$msg = $this->getNome().' assorbe la bruciatura e la trasforma in cura!';
			$heal = $OverTime->getValue();
			$Bruciatura = 1;
			if($OverTime->getTipoOverTimeId() == $Bruciatura){
				write($msg);
				$OverTime->cancel();
				$this->heal($heal);
			}
		}
	}