<?php
	Class Razza3 extends Utente{
		private $target;
		private $onRampage;

		public function __construct($UTENTE_ID){
			$current_time = date('H:i');
			$sunrise = "08:00";
			$sunset = "20:00";
			$date1 = DateTime::createFromFormat('H:i', $current_time);
			$date2 = DateTime::createFromFormat('H:i', $sunrise);
			$date3 = DateTime::createFromFormat('H:i', $sunset);
			
			if ($date1 > $date2 && $date1 < $date3){
   				$onRampage = false;
			}else{
				$onRampage = true;
			}

			$this->onRampage = $onRampage;

			parent::__construct($UTENTE_ID);
		}

		public function passive(){
			if(!$this->onRampage) return false;
			$forza = $this->getTotalStat('FORZA');
			if($forza > 100)
				$forza = 100;
			write($this->getNome(). ' è in furia lupesca!');
			$this->giveBuff('FORZA', $forza, 1);
		}
	}