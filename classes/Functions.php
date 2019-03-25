<?php
	Class Functions{
		private $db;

		public function __construct(){
			$this->db = Database();
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

			if($UTENTE_TELEGRAMID == ''){
				write('Hai bisogno di un nick di Telegram per registrarti! (@CortoMaItese)');
				return false;
			}

			$slId = 10;

			$q = "INSERT INTO BOT_RPG_UTENTE VALUES(
				".$row->UTENTE_ID.",
				0,
				0,
				'".$UTENTE_TELEGRAMID."',
				'".$row->UTENTE_ID."temp',
				0,
				".$UTENTE_CHATID.",
				NOW(),
				0,
				$slId,
				0,
				1000,
				500,
				100,
				0,
				0,
				NOW(),
				999,
				999,
				0,
				0,
				0,
				0,
				0,
				0
			)";
			$this->db->query($q);

			//GLI FORNISCO LE SKILL PER INIZIARE
			/*
			$arrSkillId = array(0,93);
			$n = count($arrSkillId);
			for($i = 0; $i < $n; $i++){
				$this->addRowLearnedSkill($arrSkillId[$i], $row->UTENTE_ID, 1);
			}
			*/

			/*
			$arrEquipId = array(13, 14);
			$n = count($arrEquipId);
			for($i = 0; $i < $n; $i++){
				$this->addRowEquip($arrEquipId[$i], $row->UTENTE_ID, 1, 0);
			}
			*/

			//$adminMail = 'lorenzo.dona97@gmail.com';
			//$from = 'From: Donny@donnybot.it';
			
			segnalaNotifica("Registrazione\n\n@$UTENTE_TELEGRAMID");
		}

		public function utenteNickExist($nick){
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_UTENTE WHERE UTENTE_NICK = '".$nick."'";
			if(Database()->query($sql)->fetch_object()->C > 0)
				return true;
			else
				return false;
		}

		public function getUtenteIdByNick($nick){
			$sql = "SELECT UTENTE_ID AS ID FROM BOT_RPG_UTENTE WHERE UTENTE_NICK = '".$nick."'";
			return Database()->query($sql)->fetch_object()->ID;
		}

		public function getUtenteRazzaIdById($id){
			$sql = "SELECT UTENTE_RAZZA_ID AS ID FROM BOT_RPG_UTENTE WHERE UTENTE_ID = $id";
			return Database()->query($sql)->fetch_object()->ID;
		}

		public function getRazzaNomeById($id){
			$sql = "SELECT RAZZA_NOME FROM BOT_RPG_RAZZA WHERE RAZZA_ID = $id";
			return Database()->query($sql)->fetch_object()->RAZZA_NOME;
		}

		public function selectRandomTipoEquipId(){
			$sql = "SELECT TIPO_EQUIP_ID FROM BOT_RPG_TIPO_EQUIP ORDER BY RAND() LIMIT 1";
			return Database()->query($sql)->fetch_object()->TIPO_EQUIP_ID;
		}

		public function addRowLearnedSkill($skillId, $utenteId, $lvl){
			$sql = "INSERT INTO BOT_RPG_LEARNED_SKILL VALUES(
				$skillId, $utenteId, $lvl
			)";
			$this->db->query($sql);
		}

		public function addRowEquip($tipoEquipId, $utenteId, $lvl, $attivo){
			$sql = "SELECT MAX(EQUIP_ID) + 1 AS M FROM BOT_RPG_EQUIP";
			$res = $this->db->query($sql);
			$row = $res->fetch_object();
			$equipId = $row->M;

			$sql = "INSERT INTO BOT_RPG_EQUIP VALUES(
				$equipId,
				$utenteId,
				$tipoEquipId,
				$lvl,
				$attivo
				)";
			$this->db->query($sql);
		}

		public function spawnSpecificMob($tipoMobId, $sottoluogoId, $livello, $utenteId, $mobHp, $nomeProprioId, $flagTarget, $pm, $pa, $x, $y, $targetId, $targetEntitaId, $pet = 0){
			$id = $this->getMaxIdMob();
			$sql = "INSERT INTO BOT_RPG_MOB VALUES(
			$id,
			$tipoMobId,
			$sottoluogoId,
			$livello,
			$utenteId,
			$mobHp,
			$nomeProprioId,
			$flagTarget,
			$pm,
			$pa,
			$x,
			$y,
			$targetId,
			$targetEntitaId,
			$pet
			)";
			Database()->query($sql);

			return $id;
		}

		public function itemNameExist($itemName){
			//$itemName = Database()->real_escape_string($itemName);
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_TIPO_ITEM WHERE TIPO_ITEM_NOME = '".$itemName."'";
			if(Database()->query($sql)->fetch_object()->C > 0)
				return true;
			else
				return false;
		}

		public function getTipoItemIdByName($itemName){
			//$itemName = Database()->real_escape_string($itemName);
			$sql = "SELECT TIPO_ITEM_ID FROM BOT_RPG_TIPO_ITEM WHERE TIPO_ITEM_NOME = '".$itemName."'";
			return Database()->query($sql)->fetch_object()->TIPO_ITEM_ID;
		}

		public function getTipoItemNameById($tipoItemId){
			$sql = "SELECT TIPO_ITEM_NOME FROM BOT_RPG_TIPO_ITEM WHERE TIPO_ITEM_ID = $tipoItemId";
			return Database()->query($sql)->fetch_object()->TIPO_ITEM_NOME;
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

			$sql = "DELETE FROM BOT_RPG_LEARNED_SKILL WHERE LEARNED_SKILL_UTENTE_ID = ". $UTENTE_ID;
			$this->db->query($sql);

			$sql = "DELETE FROM BOT_RPG_EQUIP WHERE EQUIP_UTENTE_ID = ". $UTENTE_ID;
			$this->db->query($sql);
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
			$res = Database()->query($q);
			$row = $res->fetch_object();
			if($row->C == 0)
				return false;
			else
				return true;
		}

		public function getTipoMobMaxHp($mobId, $lvl){
			$sum = 0;
			$q = "SELECT VALUE AS FLAT, VALUE_XLVL AS XLVL FROM BOT_RPG_STAT_TIPO_MOB WHERE TIPO_MOB_ID = $mobId AND STAT_ID = 9";
			$res = Database()->query($q);
			if($res->num_rows > 0){
				$row = $res->fetch_object();
				$sum += intVal($row->FLAT) + ($row->XLVL * $lvl);
				$sum = intVal($sum);
			}else{
				$sum += 1;
			}

			return $sum;
		}

		public function getMaxIdMob(){
			if(!Functions::areThereMobsAtAll())
				return 0;

			$q = "SELECT MAX(MOB_ID) + 1 AS M FROM BOT_RPG_MOB";
			$res = Database()->query($q);
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
			$mobId = 2;

			//$countIter = 0;
			$flag = false;
			/*
			//while(!$flag || $countIter < 999){
			for ( $countIter = 0; !$flag && $countIter < 50; ++$countIter) {
			    $q = "SELECT MOB_SPAWN_PROB, TIPO_MOB_ID FROM BOT_RPG_MOB_SPAWN WHERE SOTTOLUOGO_ID = ".$sottoluogo_id." ORDER BY RAND()";
		 	    $res = $this->db->query($q);
		 	    while($row = $res->fetch_object()){
						// && !flag
					    if($row->MOB_SPAWN_PROB > rand(0, 1000000)){
						      $mobId = $row->TIPO_MOB_ID;
							  $flag = true;
									//$countIter++;
						}
			    }
		  }*/

		  $q = "SELECT MOB_SPAWN_PROB, TIPO_MOB_ID FROM BOT_RPG_MOB_SPAWN WHERE SOTTOLUOGO_ID = ".$sottoluogo_id." ORDER BY RAND()";
		 	    $res = $this->db->query($q);
		 	    while($row = $res->fetch_object()){
						// && !flag
					    if($row->MOB_SPAWN_PROB > rand(0, 1000000) && !$flag){
						    $mobId = $row->TIPO_MOB_ID;
							$flag = true;
							//$countIter++;
					}
			   }

			if(!$flag){
			    //$ut->sendMessage('Non hai trovato nulla!');
					return 1;
			}

			$q = "SELECT * FROM BOT_RPG_NOME ORDER BY RAND() LIMIT 1";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			$nome = $row->NOME_ID;

			$sum = $this->getTipoMobMaxHp($mobId, $lvl);

			$q = "
				SELECT
					TIPO_MOB_TARGET_PERC_MIN AS PMIN,
					TIPO_MOB_TARGET_PERC_MAX AS PMAX,
					TIPO_MOB_TARGET_PERC_ANOMALO AS PANOMALO
					FROM BOT_RPG_TIPO_MOB
					WHERE TIPO_MOB_ID = ". $mobId;
			$res = $this->db->query($q);
			$row = $res->fetch_object();


			if(rand(0,100) < $row->PANOMALO){
				$row->PMIN = 0;
				$row->PMAX = 100;
			}

			$gaus = rand($row->PMIN, $row->PMAX);

			$sl = new Sottoluogo($sottoluogo_id);


			$pm = 2;
			$pa = 2;
			$x  = $sl->randAvailableX();
			$y  = $sl->randAvailableY();

			$q = "INSERT INTO BOT_RPG_MOB VALUES (
						".$this->getMaxIdMob().",
						".$mobId.",
						".$sottoluogo_id.",
						".$lvl.",
						".$ut->getUtenteId().",
						".$sum.",
						'".$nome."',
						".$gaus.",
						".$pm.",
						".$pa.",
						".$x.",
						".$y.",
						".$ut->getId().",
						".$ut->getEntitaId().",
						0
						)";
			$this->db->query($q);
			return $q;
		}

		public function spostaMob(&$ut){
			$sottoluogoId = $ut->getUtenteSottoluogoId();
			$sl = new Sottoluogo($sottoluogoId);
			$arr = $ut->selectAllMobsId();
			$n = count($arr);
			for($i = 0; $i < $n; $i++){
				if($this->getMobSottoluogoIdByMobId($arr[$i]) == $sottoluogoId){
					$mob = new Mob($arr[$i]);
					//$ut->sendMessage($arr[$i]);
					$mob->setMobX($sl->randAvailableX());
					$mob->setMobY($sl->randAvailableY());
				}
			}
		}

		public function getIdFromLuogoNome($LUOGO_NOME){
			$q = "SELECT LUOGO_ID FROM BOT_RPG_LUOGO WHERE LUOGO_NOME = '".$LUOGO_NOME."'";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->LUOGO_ID;
		}

		public function getMobSottoluogoIdByMobId($mobId){
			$sql = "SELECT MOB_SOTTOLUOGO_ID AS ID FROM BOT_RPG_MOB WHERE MOB_ID = $mobId";
			return $this->db->query($sql)->fetch_object()->ID;
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

		//Functiions
		public function doesSkillNomeExist($skillNome){
			$q = "SELECT COUNT(*) AS C FROM BOT_RPG_SKILL WHERE SKILL_NOME = '".$skillNome."'";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 0) return false;
			else return true;
		}

		public function getIdBySkillNome($skillNome){
			$q = "SELECT SKILL_ID FROM BOT_RPG_SKILL WHERE SKILL_NOME = '".$skillNome."'";
			$res = $this->db->query($q);
			if($res->num_rows == 0) return 0;
			$row = $res->fetch_object();
			return $row->SKILL_ID;
		}

		public function getSkillNomeById($id){
			$q = "SELECT SKILL_NOME FROM BOT_RPG_SKILL WHERE SKILL_ID = $id";
			$res = Database()->query($q);
			if($res->num_rows == 0) return 'Skill non esistente';
			$row = $res->fetch_object();
			return $row->SKILL_NOME;
		}

		public function getIdSottoluogoByNomeSottoluogoAndLuogoId($nomes, $luogoid){
			$q = "SELECT * FROM BOT_RPG_SOTTOLUOGO WHERE SOTTOLUOGO_NOME = '".$nomes."' AND SOTTOLUOGO_LUOGO_ID = ".$luogoid;
			$res = $this->db->query($q);
			return $res->fetch_object()->SOTTOLUOGO_ID;
		}
		/*
		public function newMob($id){
			$mob = new Mob($id);
			switch(strtolower($mob->getTipoMobNome())){
				case 'orco':
					return new Orco($id);

				case 'lupo':
					return new Lupo($id);

				case 'cinghiale cattivo':			//NB: il boss dei cinghiali cattivi si chiama Gagliardotto.
					return new CinghialeCattivo($id);

				default:
					return new Orco($id);
			}
		}
		*/

		public function deleteMobs(&$ut){
			$sl = new Sottoluogo($ut->getUtenteSottoluogoId());
			$del = "DELETE FROM BOT_RPG_MOB WHERE MOB_ID = ";
			$q = "
				SELECT * FROM BOT_RPG_MOB
				WHERE MOB_UTENTE_ID = ".$ut->getUtenteId(). "
				AND MOB_SOTTOLUOGO_ID = ".$sl->getSottoluogoId();
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				if($row->MOB_FLAG_TARGET < rand(1,99))
					$this->db->query($del.$row->MOB_ID);
			}
		}

		public function getArrayFromColumnAndTableName($column, $tableName){
				$data = array();
				$column = strtoupper($column);
				$tableName = strtoupper($tableName);
				$q = "SELECT $column as COL FROM $tableName";
				$res = $this->db->query($q);
				while($row = $res->fetch_object()){
					$data[] = $row->COL;
				}
				return $data;
		}

		public function drawMap(&$ut){
			global $emoji;
			$sl = new Sottoluogo($ut->getUtenteSottoluogoId());
			$n = $sl->getSottoluogoAmpiezza();

			$data = array();
			$alphab = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'Y', 'Z');
			$c = 0;
			$mobName = '';

			$q = "
				SELECT MOB_X, MOB_Y, MOB_ID, NOME_NOME, TIPO_MOB_NOME, MOB_HP
				FROM BOT_RPG_MOB, BOT_RPG_NOME, BOT_RPG_TIPO_MOB
				WHERE NOME_ID = MOB_NOME_PROPRIO_ID AND TIPO_MOB_ID = MOB_TIPO_MOB_ID AND MOB_SOTTOLUOGO_ID = ".$ut->getUtenteSottoluogoId()." AND MOB_HP > 0 AND MOB_UTENTE_ID = ".$ut->getUtenteId();
			$res = Database()->query($q);
			while($row = $res->fetch_object()){
				//$Mob = new Mob($row->MOB_ID);
				//$mobName .= ucfirst(strtolower($row->TIPO_MOB_NOME)).' '.ucfirst(strtolower($row->NOME_NOME)).' ('.$alphab[$c++].')'."\n";
				$data[] = array(
							'X' => $row->MOB_X,
							'Y' => $row->MOB_Y,
							'NOME' => ucfirst(strtolower($row->TIPO_MOB_NOME)).' '.ucfirst(strtolower($row->NOME_NOME)),
							'HP' => $row->MOB_HP,
							'ID' => $row->MOB_ID 
						);
			}

			$c = 0;

			$X = $ut->getX();
			$Y = $ut->getY();

			$len = count($data);
			$printed = false;
			$flagSame = false;
			$flag = false;
			$stampati = 0;

			$msg = '';
			$msg .= "<pre>";
			$msg .= ' '.str_repeat('_', $n);
			$msg .= "\n";
			for($i = 0; $i < $n; $i++){
				//$msg .= "|";
				for($k = 0; $k < $n; $k++){
					for($j = 0; $j < $len; $j++){
						if($data[$j]['X'] == $k && $data[$j]['Y'] == $i){
							if($k != $X || $i != $Y){
								$mobName .= '('.$alphab[$c].') '.$data[$j]['NOME'] ."\n";
								$msg .= $alphab[$c++];//$emoji['BOAR'];
								$stampati++;
								$flag = true;
							}else{
								$mobName .= '(?) '.$data[$j]['NOME'] ."\n";
								$flagSame = true;
							}
							$mobName .= $data[$j]['HP'].' HP'."\n";
							$mobName .= round(sqrt(pow($data[$j]['X'] - $X,2) + pow($data[$j]['Y'] - $Y,2)), 2) . ' metri'."\n";
							$mobName .= '/'.$data[$j]['ID'];
							$mobName .= "\n\n";
						}

						if(!$printed)
							if($k == $X && $i == $Y){
								$msg .= $ut->getSymbol();
								$flag = true;
								$printed = true;
								$stampati++;
							}
					}
					if(!$flag) $msg .= ' ';//$emoji['WHITE_MEDIUM_SQUARE'];
					$flag = false;
				}
				//for($m = 0; $m < $stampati; $m++){
					//$msg .= ' ';
				//}
				$stampati = 0;
				//$msg .= "|\n";//$emoji['BLACK_MEDIUM_SQUARE'];
				$msg .= "\n";
			}
			$msg .= ' '.str_repeat('¯', $n);//¯
			$msg .= "</pre>";

			if($flagSame)
				$msg = str_replace($ut->getSymbol(), '?', $msg);

			$mobName .= '('.$ut->getSymbol().') '.$ut->getNome()."\n";
			$mobName .= $ut->getUtenteHp().'/'.$ut->getTotalStat('HP').' HP';

			return $msg . "\n" . $mobName . "\n\n". $msg;
		}

		public function doesEquipExist($name){
			$q = "SELECT COUNT(*) AS C FROM BOT_RPG_TIPO_EQUIP WHERE TIPO_EQUIP_NOME = '".$name."'";
			$res = Database()->query($q);
			$row = $res->fetch_object();
			if($row->C > 0) return true;
			else return false;
		}

		public function getEquipIdByName($name){
			$q = "SELECT TIPO_EQUIP_ID FROM BOT_RPG_TIPO_EQUIP WHERE TIPO_EQUIP_NOME = '".$name."'";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			return $row->TIPO_EQUIP_ID;
		}

		public function getEquipButtonStringById($equipId){
			$eq = new Equip($equipId);
			$str = $eq->getTipoEquipNome() . ' (+' . $eq->getEquipLivello() . ')';
			return $str;
		}

		public function doesCategoriaEquipNameExist($name){
			$q = "SELECT CATEGORIA_EQUIP_ID FROM BOT_RPG_CATEGORIA_EQUIP WHERE CATEGORIA_EQUIP_NOME = '$name'";
			//$sql = Database()->prepare($q);
			//$sql->bind_param('s', $name);
			//$res = $sql->execute();
			$res = $this->db->query($q);
			if($res->num_rows == 0) return false;
			else return true;
		}

		public function getCategoriaEquipIdByName($name){
			$q = "SELECT CATEGORIA_EQUIP_ID FROM BOT_RPG_CATEGORIA_EQUIP WHERE CATEGORIA_EQUIP_NOME = '$name'";
			$res = Database()->query($q);
			$row = $res->fetch_object();
			return $row->CATEGORIA_EQUIP_ID;
		}

		public function getCategoriaEquipNameById($id){
			$q = "SELECT CATEGORIA_EQUIP_NOME AS NOME FROM BOT_RPG_CATEGORIA_EQUIP WHERE CATEGORIA_EQUIP_ID = $id";
			$res = Database()->query($q);
			$row = $res->fetch_object();
			return $row->NOME;
		}

		public function getStatIdFromName($stat){
			$q = "SELECT * FROM BOT_RPG_STAT WHERE LOWER(STAT_NOME) = '".strtolower($stat)."'";
			$res = Database()->query($q);
			if($res->num_rows == 0) return false;
			$row = $res->fetch_object();
			return $row->STAT_ID;
		}

		public function inserisciDBStatTipoMob($statId, $tipoMobId, $value, $valueXLVL){
            $q = "INSERT INTO BOT_RPG_STAT_TIPO_MOB(STAT_ID, TIPO_MOB_ID, VALUE, VALUE_XLVL)
				  VALUES ($statId, $tipoMobId, $value, $valueXLVL)";
		    $this->db->query($q);
        }

		public function getTipoMobColumn($col){
			$data = array();
			$q = "SELECT TIPO_MOB_$col as VAL FROM BOT_RPG_TIPO_MOB";
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$data[] = $row->VAL;
			}
			return $data;
		}

		public function getStatColumn($col){
			$data = array();
			$q = "SELECT STAT_$col as VAL FROM BOT_RPG_STAT";
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$data[] = $row->VAL;
			}
			return $data;
		}

		public function getColumnFromTable($tableName, $column){
			$data = array();
			$q = "SELECT $column as VAL FROM $tableName";
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$data[] = $row->VAL;
			}
			return $data;
		}

		//StatTipoMob
		public function handleStatTipoMob($tipoMobId, $statId, $value, $valueXLVL){
			if($this->checkDBStatTipoMob($tipoMobId, $statId)){
				$this->updateDBStatTipoMob($tipoMobId, $statId, $value, $valueXLVL);
			}
			else{
				$this->insertDBStatTipoMob($tipoMobId, $statId, $value, $valueXLVL);
			}
		}

		public function insertDBStatTipoMob($tipoMobId, $statId, $value, $valueXLVL){
			$q = "INSERT INTO BOT_RPG_STAT_TIPO_MOB (
				 	TIPO_MOB_ID,
					STAT_ID,
					VALUE,
					VALUE_XLVL
				)VALUES(
					$tipoMobId,
					$statId,
					$value,
					$valueXLVL
				)";
			$this->db->query($q);
		}

		public function checkDBStatTipoMob($tipoMobId, $statId){
			$q = "SELECT * FROM BOT_RPG_STAT_TIPO_MOB WHERE TIPO_MOB_ID = $tipoMobId AND STAT_ID = $statId";
			$res = $this->db->query($q);
			if($res->num_rows == 0) return false;
			else return true;
		}

		public function updateDBStatTipoMob($tipoMobId, $statId, $value, $valueXLVL){
			$q = "UPDATE BOT_RPG_STAT_TIPO_MOB
				  SET VALUE = $value, VALUE_XLVL = $valueXLVL
				  WHERE TIPO_MOB_ID = $tipoMobId AND STAT_ID = $statId";
			$this->db->query($q);
		}
		////////////////////////////////////////////////////////////////////////////

		public function doesNpcNameExist($NpcName){
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_NPC WHERE NPC_NOME = '".$NpcName."'";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C > 0)
				return true;
			else
				return false;
		}

		public function getNpcIdByName($NpcName){
			$sql = "SELECT NPC_ID FROM BOT_RPG_NPC WHERE NPC_NOME = '".$NpcName."'";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			return $row->NPC_ID;
		}

		public function inserisciDuello($utenteId, $enemyId){
			$sql = "SELECT MAX(DUELLO_ID) + 1 AS M FROM BOT_RPG_DUELLO";
			$maxId = Database()->query($sql)->fetch_object()->M;

			$sql = "INSERT INTO BOT_RPG_DUELLO VALUES(
				$utenteId,
				$enemyId,
				$utenteId,
				NOW(),
				NOW(),
				$maxId,
				0,
				1
			)";
			Database()->query($sql);
		}

		public function getActiveDuello($id){
			$sql = "SELECT DUELLO_ID
				FROM BOT_RPG_DUELLO
				WHERE (
					DUELLO_UTENTE_ID 	= $id
							OR
					DUELLO_ENEMY_ID 	= $id
				)
				AND
					DUELLO_TERMINATO = 1";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			return $row->DUELLO_ID;
		}

		public function terminaDuello($winner){
			$duelloId = $this->getActiveDuello($winner);

			$sql = "UPDATE BOT_RPG_DUELLO SET DUELLO_TERMINATO = 0, DUELLO_DATA_FINE = NOW(), DUELLO_VINCITORE_ID = $winner WHERE DUELLO_ID = $duelloId";
			Database()->query($sql);
		}

		public function switchTurnoDuello($id){
			$duelloId = $this->getActiveDuello($id);
			$sql = "UPDATE BOT_RPG_DUELLO SET DUELLO_UTENTE_TURNO_ID = $id WHERE DUELLO_ID = $duelloId";
			Database()->query($sql);
		}

		public function categoriaEquipNameExist($name){
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_CATEGORIA_EQUIP WHERE CATEGORIA_EQUIP_NOME = '$name'";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C > 0) return true;
			else return false;
		}

		public function convertDigitToEmoji($digit){
			switch($digit){
        		case 0:
        			return ZERO;
        		break;
        		
        		case 1:
        			return UNO;
        		break;

        		case 2:
        			return DUE;
        		break;

        		case 3:
        			return TRE;
        		break;

        		case 4:
        			return QUATTRO;
        		break;

        		case 5:
        			return CINQUE;
        		break;

        		case 6:
        			return SEI;
        		break;

        		case 7:
        			return SETTE;
        		break;

        		case 8:
        			return OTTO;
        		break;

        		case 9:
        			return NOVE;
        		break;
        	}
		}

		public function drawNumberToEmoji($num){
			$n = strlen($num);
			$number = '';
   			for($i = 0; $i < $n; $i++){
   				$number .= Functions::convertDigitToEmoji($num[$i]);
    		}

    		return $number;
		}

		public function getCategoriaEquipIdFromEquipId($equipId){
			$sql = "SELECT TIPO_EQUIP_CATEGORIA_EQUIP_ID AS ID FROM BOT_RPG_EQUIP, BOT_RPG_TIPO_EQUIP WHERE TIPO_EQUIP_ID = EQUIP_TIPO_EQUIP_ID AND EQUIP_ID = $equipId";
			$res = Database()->query($sql);
			if($res->num_rows == 0)
				return 10;
			return $res->fetch_object()->ID;
		}

		public function getSottoluogoNameById($id){
			$sql = "SELECT SOTTOLUOGO_NOME FROM BOT_RPG_SOTTOLUOGO WHERE SOTTOLUOGO_ID = $id";
			$res = Database()->query($sql);
			if($res->num_rows == 0)
				return 'Sottoluogo Inesistente';
			return $res->fetch_object()->SOTTOLUOGO_NOME;
		}

		public function getTipoMobNameById($id){
			$sql = "SELECT TIPO_MOB_NOME FROM BOT_RPG_TIPO_MOB WHERE TIPO_MOB_ID = $id";
			$res = Database()->query($sql);
			if($res->num_rows == 0)
				return 'Mob Inesistente';
			return $res->fetch_object()->TIPO_MOB_NOME;
		}

		public function getRandomSpawnBySottoluogoId($sottoluogo_id){
			$flag = false;
			$q = "SELECT MOB_SPAWN_PROB, TIPO_MOB_ID, MOB_LIV_MAX, MOB_LIV_MIN FROM BOT_RPG_MOB_SPAWN WHERE SOTTOLUOGO_ID = ".$sottoluogo_id." ORDER BY RAND()";
		 	$res = Database()->query($q);
		 	while($row = $res->fetch_object()){
				if($row->MOB_SPAWN_PROB > rand(0, 1000000) && !$flag){
					$mobId = $row->TIPO_MOB_ID;
					$lvl = rand($row->MOB_LIV_MIN, $row->MOB_LIV_MAX);
					$flag = true;
				}
			}

			if(!$flag){
				return false;
			}else{
				$arr = array('MOB_ID' => $mobId, 'MOB_LVL' => $lvl);
				return $arr;
			}
		}

		public function getMemoIdByName($nome){
			$sql = "SELECT MEMO_ID FROM BOT_RPG_MEMO WHERE MEMO_NOME = '$nome'";
			$res = Database()->query($sql);
			if($res->num_rows == 0)
				return false;
			else
				return $res->fetch_object()->MEMO_ID;
		}

		public function createMemo($string){
			$db = Database();
			$string = strtoupper($string);
			$sql = "INSERT INTO BOT_RPG_MEMO VALUES (null, '$string', 'WOI')";
			$db->query($sql);
			return $db->insert_id;
		}

		public function getOvertimeNomeById($id){
			$sql = "SELECT TIPO_OVERTIME_NOME FROM BOT_RPG_TIPO_OVERTIME WHERE TIPO_OVERTIME_ID = $id";
			$res = Database()->query($sql);
			if($res->num_rows == 0)
				return 'Stato non esistente';
			else
				return $res->fetch_object()->TIPO_OVERTIME_NOME;
		}

		public function getQuestNomeById($id){
			$sql = "SELECT QUEST_NOME FROM BOT_RPG_QUEST WHERE QUEST_ID = $id";
			$res = Database()->query($sql);
			if($res->num_rows == 0)
				return 'Quest non esistente';
			else
				return $res->fetch_object()->QUEST_NOME;
		}

		public function getTipoMobIdByMobId($id){
			$sql = "SELECT MOB_TIPO_MOB_ID AS ID FROM BOT_RPG_MOB WHERE MOB_ID = $id";
			$res = Database()->query($sql);
			if($res->num_rows == 0)
				return false;
			else
				return $res->fetch_object()->ID;
		}

		public function getTipoEquipIdByEquipId($id){
			$sql = "SELECT EQUIP_TIPO_EQUIP_ID AS ID FROM BOT_RPG_EQUIP WHERE EQUIP_ID = $id";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			return $row->ID;
		}

		public function percentuale($val){
			$r = rand(1, 100);
			if($r <= $val)
				return true;
			else
				return false;
		}

		public function redirectToNpc(&$Ut, $npcId, $flag = 0){
			$className = 'Npc'.$npcId;
			$Npc = new $className();
			$Ut->setUtenteNpcId($npcId);
			
			$Npc->setUtente($Ut);
			$Npc->setFlag($flag);
			$Npc->talk();

			global $key;
			$key = $Npc->getKeyboard();
		}

		public function getDioNomeById($id){
			$sql = "SELECT DIO_NOME FROM BOT_RPG_DIO WHERE DIO_ID = $id";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			return $row->DIO_NOME;
		}

		public function allGodsBackInGara(){
			$sql = "UPDATE BOT_RPG_CAMPIONATO_DEI SET IN_GARA = 1";
			Database()->query($sql);
		}

		public function godVsgod($god1, $god2){
			$winner = $god1;
			$p1 = Functions::getGodPotenza($god1);
			$loser = $god2;
			$p2 = Functions::getGodPotenza($god2);

			do{
				$res1 = rand(0, $p1);
				$res2 = rand(0, $p2); 
			}while($res1 == $res2);

			$winnerScore = $res1;
			$loserScore = $res2;

			if($res1 < $res2){
				$winner = $god2;
				$loser = $god1;
				$winnerScore = $res2;
				$loserScore = $res1;
			}

			Functions::kickGodOutOfTournament($loser);

			return Functions::getDioNomeById($winner) . " ($winnerScore)\n TRIONFA CONTRO \n" . Functions::getDioNomeById($loser) . " ($loserScore)\n\n";
		}

		public function getGodsInGara(){
			$sql = "SELECT DIO_ID FROM BOT_RPG_CAMPIONATO_DEI WHERE IN_GARA = 1 ORDER BY RAND()";
			$res = Database()->query($sql);
			$data = array();
			while($row = $res->fetch_object()){
				$data[] = $row->DIO_ID;
			}

			return $data;
		}

		public function kickGodOutOfTournament($godId){
			$sql = "UPDATE BOT_RPG_CAMPIONATO_DEI SET IN_GARA = 0 WHERE DIO_ID = $godId";
			Database()->query($sql);
		}

		public function addWinGod($godId){
			$sql = "UPDATE BOT_RPG_CAMPIONATO_DEI SET VITTORIE = VITTORIE + 1 WHERE DIO_ID = $godId";
			Database()->query($sql);
		}

		public function getGodPotenza($godId){
			$sql = "SELECT DIO_POTENZA FROM BOT_RPG_DIO WHERE DIO_ID = $godId";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			return $row->DIO_POTENZA;
		}

		public function diceRoll($val){
			if($val <= 0)
				return 0;
			else
				return rand(0, $val);
		}

	}
