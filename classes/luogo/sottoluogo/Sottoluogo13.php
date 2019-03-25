<?php
	//CLUB AMICI NOTTURNI
	Class Sottoluogo13 extends Sottoluogo{
		private $id = 13;

		public function __construct(&$ut){
			parent::__construct($this->id);
			$this->utente = $ut;
		}

		public function isOpen(){
			$sql = "SELECT HOUR(NOW()) AS H";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			$H = $row->H;

			if($H >= 2 && $H <= 6)
				return true;
			else
				return false;
		}

		public function stepIn(){
			$isOpen = $this->isOpen();


			$msg = '';
			if($isOpen){
				$msg .= 'Il Club è aperto: sei entrato!';
				$this->utente->setUtenteSottoluogoId($this->getSottoluogoId());
			}else{
				$msg .= 'Il cartello dice:'."\n";
				$msg .= 'Orario di apertura'."\n";
				$msg .= '02:00 - 06:00';
			}

			write($msg);
		}

		public function isVisibile(){
			return Sottoluogo13::isOpen();
		}
	}