<?php
	Class Mob92 extends Mob{
		//BANDITO GOLIA
		public function __construct($id){
			parent::__construct($id);
		}

		public function subisciDannoFisico(Danno &$Danno){
			$turni = 3;
			$value = $Danno->getDmg() * 0.15;

			parent::subisciDannoFisico($Danno);

			$this->giveBuff('ARMATURA', intVal($value), $turni);
		}


}