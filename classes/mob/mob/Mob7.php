<?php
	Class Mob7 extends Mob{
		//Lupo Selvatico
		public function __construct($id){
			parent::__construct($id);
		}

		public function dealDamage(Danno &$Danno){
			$Lupo = 3;
			$counter = -1;
			$Lupi = $Danno->getTarget()->getTargetsInRange(1.9);
			$n = count($Lupi);
			for($i = 0; $i < $n; $i++){
				$T = &$Lupi[$i];
				if($T->getCategoria() == $Lupo)
					$counter++;
			}

			if($counter > 0){
				$perc = $counter/10 + 1;
				$Danno->modifier($perc);
			}
		}


	}
