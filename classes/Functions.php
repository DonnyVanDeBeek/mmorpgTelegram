<?php
	Class Functions extends Database{

		public function __construct(){
			$this->getDB();
		}

		public function isRegistered($UTENTE_TELEGRAMID){
			$bool_res = false;

			$q = "SELECT COUNT(*) AS C FROM BOT_RPG_UTENTE WHERE UTENTE_TELEGRAMID = '".$UTENTE_TELEGRAMID."'";
			$res = $this->db->query($q);
			$row = $res->fetch_object();

			if($row->C == 1)
				$bool_res = true;

			return $bool_res;
		}

		public function register($UTENTE_TELEGRAMID, $UTENTE_CHATID){
			$q = "SELECT MAX(UTENTE_ID) + 1 AS UTENTE_ID FROM BOT_RPG_UTENTE";
			$res = $this->db->query($q);
			$row = $res->fetch_object();

			$q = "INSERT INTO BOT_RPG_UTENTE VALUES(
				".$row->UTENTE_ID.",
				'".$UTENTE_TELEGRAMID."',
				'".$row->UTENTE_ID."temp',
				0,
				".$UTENTE_CHATID.",
				NOW(),
				0, 0, 0, 0, 0, 100, 0)";
			$this->db->query($q);
		}

		public function getUTENTE_STATO_REGISTRAZIONE_ID($UTENTE_ID){
			$q = "SELECT UTENTE_STATO_REGISTRAZIONE_ID FROM BOT_RPG_UTENTE WHERE UTENTE_ID = ". $UTENTE_ID;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			$S = $row->UTENTE_STATO_REGISTRAZIONE_ID;

			return $S;
		}

		public function aumUTENTE_STATO_REGISTRAZIONE_ID($UTENTE_ID){
			$q = "UPDATE BOT_RPG_UTENTE SET UTENTE_STATO_REGISTRAZIONE_ID = UTENTE_STATO_REGISTRAZIONE_ID + 1 WHERE UTENTE_ID = ". $UTENTE_ID;
			$this->db->query($q);
		}

		public function updateUTENTE_NICKNAME($UTENTE_ID, $UTENTE_NICKNAME){
			$q = "UPDATE BOT_RPG_UTENTE SET UTENTE_NICK = '".$this->db->real_escape_string($UTENTE_NICKNAME)."' WHERE UTENTE_ID = ". $UTENTE_ID;
			$this->db->query($q);
		}

		public function selectALL_CLASSE_NOME_BUTTON(){
			$string = '';
			$q = "SELECT CLASSE_NOME FROM BOT_RPG_CLASSE";
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$string .= '["'.ucfirst($row->CLASSE_NOME).'"], ';
			}

			$string .= '["Scegli una classe"]';

			return $string;
		}

		public function selectALL_LUOGO_NOME_BUTTON(){
			$string = '';
			$q = "SELECT LUOGO_NOME FROM BOT_RPG_LUOGO";
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$string .= '["'.$row->LUOGO_NOME.'"], ';
			}

			$string .= '["Torna al menu principale"]';

			return $string;
		}


		public function updateClasse($UTENTE_ID, $CLASSE_NOME){
			$q = "SELECT CLASSE_ID, COUNT(*) AS C FROM BOT_RPG_CLASSE WHERE CLASSE_NOME = '".strtolower($CLASSE_NOME)."'";
			$res = $this->db->query($q);
			$row = $res->fetch_object();

			if($row->C == 1){
				$q = "UPDATE BOT_RPG_UTENTE SET UTENTE_CLASSE_ID = ". $row->CLASSE_ID ." WHERE UTENTE_ID = ". $UTENTE_ID;
				$this->db->query($q);
				$bool = true;
			}else{
				$bool = false;
			}

			return $bool;
		}

		public function deleteAccount($UTENTE_ID){
			$q = "DELETE FROM BOT_RPG_UTENTE WHERE UTENTE_ID = ". $UTENTE_ID;
			$this->db->query($q);
		}

		public function getIdFromTelegramId($UTENTE_TELEGRAMID){
			$q = "SELECT UTENTE_ID, COUNT(*) AS C FROM BOT_RPG_UTENTE WHERE UTENTE_TELEGRAMID = '".$UTENTE_TELEGRAMID."'";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 0){
				$ris = false;
			}else{
				$ris = $row->UTENTE_ID;
			}

			return $ris;
		}

		public function doesLuogoExist($LUOGO_NOME){
			$q = "SELECT COUNT(*) AS C FROM BOT_RPG_LUOGO WHERE LUOGO_NOME = '".$LUOGO_NOME."'";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 1) return true;
			else return false;
		}

		public function areThereMobsAtAll(){
			$q = "SELECT COUNT(*) AS C FROM BOT_RPG_MOB";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 0)
				return false;
			else
				return true;
		}

		public function getMaxIdMob(){
			if(!$this->areThereMobsAtAll())
				return 0;

			$q = "SELECT MAX(MOB_ID) + 1 AS M FROM BOT_RPG_MOB";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->M;
		}

		public function spawnMob(&$ut){
			/*$osc = 2;
			if($ut->getUtenteLevel() >= 3){

			}
			$lvl = rand($ut->, 35);*/

			$ul = $ut->getUtenteLevel();
			$osc = 2;
			$lvl = rand( ($ul <= $osc) ? 1 : ($ul - $osc), $ul + $osc );
			$sottoluogo_id = $ut->getUtenteSottoluogoId();
			$mobId = 0;

			//$countIter = 0;
			$flag = false;
			//while(!$flag || $countIter < 999){
			for ( $countIter = 0; !$flag && $countIter < 999; ++$countIter) {
			    $q = "SELECT * FROM BOT_RPG_MOB_SPAWN WHERE SOTTOLUOGO_ID = ".$sottoluogo_id." ORDER BY RAND()";
		 	    $res = $this->db->query($q);
		 	    while($row = $res->fetch_object() && !flag){
					    if($row->MOB_SPAWN_PROB > rand(0, 1000000)){
						      $mobId = $row->TIPO_MOB_ID;
									$flag = true;
									//$countIter++;
							}
			    }
		  }

			if(!flag){
			    $ut->sendMessage('Non hai trovato nulla!');
					return 1;
			}

			$q = "SELECT * FROM BOT_RPG_NOME ORDER BY RAND() LIMIT 1";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			$nome = $row->NOME_NOME;

			$q = "SELECT TIPO_MOB_HP_XLIVELLO AS XLVL, TIPO_MOB_HP AS FLAT FROM BOT_RPG_TIPO_MOB WHERE TIPO_MOB_ID = ". $mobId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			$sum = intVal($row->FLAT) + ($row->XLVL * $lvl);
			$sum = intVal($sum);
			$q = "INSERT INTO BOT_RPG_MOB VALUES (".$this->getMaxIdMob().", ".$mobId.", ".$sottoluogo_id.", ".$lvl.", ".$ut->getUtenteId().", ".$sum.", '".$nome."')";
			$this->db->query($q);
			return $q;
		}

		public function getIdFromLuogoNome($LUOGO_NOME){
			$q = "SELECT LUOGO_ID FROM BOT_RPG_LUOGO WHERE LUOGO_NOME = '".$LUOGO_NOME."'";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->LUOGO_ID;
		}

		public function getClasseNomeFromUtenteId($UTENTE_ID){
			$q = "SELECT CLASSE_NOME FROM BOT_RPG_UTENTE, BOT_RPG_CLASSE WHERE CLASSE_ID = UTENTE_CLASSE_ID AND UTENTE_ID = ". $UTENTE_ID;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->CLASSE_NOME;
		}

		public function keyboardFormat(&$arr){
			$n = count($arr);
			$str = '';
			for($i = 0; $i < $n; $i++){
				$str .= '["'.$arr[$i].'"]';
				if($i != $n - 1)
				   $str .= ',';
			}
			return $str;
		}


	}
