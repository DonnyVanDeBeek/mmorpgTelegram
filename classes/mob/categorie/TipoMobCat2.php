<?php
	Class TipoMobCat2 extends Mob{
		//Bandito
		public function __construct($id){
			parent::__construct($id);
		}

		public function passive(){
			write($this->getNome().' è furtivo');
			$this->giveBuff('DESTREZZA', rand(1,10), 1);
		}



	}