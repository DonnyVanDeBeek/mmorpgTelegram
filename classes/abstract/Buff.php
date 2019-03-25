<?php
	Class Buff{
		private $utente;
		private $stat;
		private $value;
		private $durata;
		private $turni;

		private $cancelled = false;

		public function send(){
			$this->turni = isset($this->turni) ? $this->turni : 3;

			if($this->utente->getEntitaId() == 0){
				$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_STAT_BUFF WHERE SCADENZA > 0 AND UTENTE_ID = ".$this->utente->getUtenteId();
				$c = Database()->query($sql)->fetch_object()->C;

				$limit = 10;
				if($c >= $limit){
					write('<b>'.$this->utente->getNome().'</b> ha raggiunto il limite di '.$limit.' buff/debuff: buff non assorbito'."\n");
					return false;
				}

				$this->utente->dealWithBuff($this);

				if($this->cancelled){
					return false;
				}

				$sql = "
					INSERT INTO BOT_RPG_STAT_BUFF 
					VALUES(".
						$this->getStatIdByName().", ".
						$this->utente->getUtenteId().", ".
						$this->value.", ".
						$this->turni."
					)";
				Database()->query($sql);

				$ut = $this->getUtente();
				$statAggiornata = $ut->getStatFromBuff($this->getStat()) + $this->getValue();
				$ut->setArrStat($this->getStatIdByName(), 'buff', $statAggiornata);

				$sign = $this->value < 0 ? '-' : '+';
				write('<b>'.$this->utente->getNome().'</b>: '.strtolower($this->stat).' '.$sign.abs($this->value) ."\n");
			}

			if($this->utente->getEntitaId() == 1){
				$sql = "
					INSERT INTO BOT_RPG_MOB_STAT_BUFF 
					VALUES(".
						$this->getStatIdByName().", ".
						$this->utente->getMobId().", ".
						$this->value.", ". 
						$this->turni."
					)";
				Database()->query($sql);

				$sign = $this->value < 0 ? '-' : '+';
				write('<b>'.$this->utente->getNome().'</b>: '.strtolower($this->stat).' '.$sign.abs($this->value) ."\n");
			}

			return true;
		}

		public function getMsg(){
			$sign = $this->value >= 0 ? '+' : '-';
			//return '<b>'.$this->utente->getNome().'</b>: '.strtolower($this->stat).' '.$sign.abs($this->value) ."\n";
		}

		public function getStatIdByName(){
			$sql = "SELECT STAT_ID FROM BOT_RPG_STAT WHERE UPPER(STAT_NOME) = '".strtoupper($this->stat)."'";
			return Database()->query($sql)->fetch_object()->STAT_ID;
		}

		public function getUtente(){
			return $this->utente;
		}

		public function setTarget(&$a){
			$this->utente = $a;
		}

		public function getStat(){
			return $this->stat;
		}

		public function getValue(){
			return $this->value;
		}

		public function getDurata(){
			return $this->durata;
		}

		public function setUtente(&$a){
			$this->utente = $a;
		}

		public function setStat($a){
			$this->stat = $a;
		}

		public function setValue($a){
			$this->value = $a;
		}

		public function setDurata($a){
			$this->durata = $a;
		}

		public function setTurni($a){
			$this->turni = $a;
		}

		public function getTurni(){
			return $this->turni;
		}

		public function setNumTurni($a){
			$this->turni = $a;
		}

		public function cancel(){
			$this->cancelled = true;
		}

	}
