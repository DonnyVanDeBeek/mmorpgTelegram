<?php
	Class Mob57 extends Mob{
		//GABIBBO
		public function __construct($id){
			parent::__construct($id);
		}

		public function doSomething(&$target){
			$this->OBJUtente = $target;

			$frasi = array(
				'WE BESUGHI!',
				'SIAMO SPACCIATI!',
				'EHI, BELLA GENTE!!',
				'BELANDI!',
				'DOBBIAMO STARE VICINI VICINI!',
				'PRINCIPI AZZURRI DI TUTTO IL MONDO, UNITEVI!',
				'VIVA LE FIABE!',
				'SI METTE MALE!'
			);

			$n = count($frasi);

			write('<b>'.$this->getNome().'</b>: '.$frasi[rand(0, $n-1)]."\n");

			$this->moveTowards($target);
		}

		public function subisciDanno(Danno $Danno){
			if($Danno->getDealer() !== NULL){
				$del = $Danno->getDealer();
				if($del->getEntitaId() == 0 && $del->getId() == $this->mobUtenteId){
					write('<b>'.$this->getNome().'</b>: EHI EHI CALMA CALMA!!'."\n");
					return false;
				}
			}

			parent::subisciDanno($Danno);
		}
	}