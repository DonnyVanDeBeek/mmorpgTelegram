<?php
	Class Mob extends TipoMob{
		protected $mobX;
		protected $mobY;
		protected $mobPM;
		protected $mobPA;
		protected $mobHp;
		protected $mobId;
		protected $mobLevel;
		protected $mobMobId;
		protected $mobTipoMobId;
		protected $mobSottluogoId;
		protected $mobNomeProprioId;

		protected $mobTargetId;
		protected $mobTargetEntitaId;

		protected $target;

		protected $OBJUtente;

		protected $OBJNome;

		//protected $OBJEquips;

		protected $exists = true;

		protected $saltaTurno = false;

		protected $OBJEquips = array();

		protected $skills = array();

		private $tableName = 'BOT_RPG_MOB';

		protected $db;

		protected $msg = array();

		public function __construct($id){
			$this->db = Database();

			$q = "SELECT * FROM ". $this->tableName ." WHERE MOB_ID = ". $id;
			$res = $this->db->query($q);

			if($res->num_rows == 0){
				$this->exists = false;
				return false;
			}

			$row = $res->fetch_object();

			$this->mobX 			= $row->MOB_X;
			$this->mobY 			= $row->MOB_Y;
			$this->mobId 			= $row->MOB_ID;
			$this->mobHp 			= $row->MOB_HP;
			$this->mobPA 			= $row->MOB_PA;
			$this->mobPM 			= $row->MOB_PM;
			$this->mobLevel		    = $row->MOB_LIVELLO;
			$this->mobTipoMobId 	= $row->MOB_TIPO_MOB_ID;
			$this->mobUtenteId 		= $row->MOB_UTENTE_ID;
			$this->mobSottluogoId 	= $row->MOB_SOTTOLUOGO_ID;
			$this->mobNomeProprioId = $row->MOB_NOME_PROPRIO_ID;

			$this->mobTargetId 		 = $row->MOB_TARGET_ID;
			$this->mobTargetEntitaId = $row->MOB_TARGET_ENTITA_ID;

			if(count($this->getActiveEquipArrayColumn('ID')) == 0){
				$this->assegnaEquip();
			}

			$this->OBJNome = new Nome($this->mobNomeProprioId);
			parent::__construct($this->mobTipoMobId);

			//use TipoMobCat0;

		}

		public function provaCategoria(){
			write('non ci siamo');
		}

		public function doesExists(){
			return $this->exists;
		}

		public function getMobId(){
			return $this->mobId;
		}

		public function doesSaltaTurno(){
			return $this->saltaTurno;
		}

		public function setSaltaTurno($a){
			$this->saltaTurno = $a;
		}

		public function getLevel(){
			return $this->mobLevel;
		}

		public function setX($a){
			$this->setMobX($a);
		}

		public function setY($a){
			$this->setMobY($a);
		}

		public function getY(){
			return $this->getMobY();
		}

		public function getX(){
			return $this->getMobX();
		}

		public function getPA(){
			return $this->getMobPA();
		}

		public function getTargetId(){
			return $this->mobTargetId;
		}

		public function getMobTargetId(){
			return $this->mobTargetId;
		}

		public function getMobTargetEntitaId(){
			return $this->mobTargetEntitaId;
		}

		public function getMobUtenteId(){
			return $this->mobUtenteId;
		}

		public function getPM(){
			return $this->getMobPM();
		}

		public function setPA($a){
			return $this->setMobPA($a);
		}

		public function setPM($a){
			return $this->setMobPM($a);
		}

		public function setMobTargetId($a){
			$q = "UPDATE BOT_RPG_MOB SET MOB_TARGET_ID = ".$a." WHERE MOB_ID = ". $this->mobId;
			$this->db->query($q);
			$this->mobTargetId = $a;
		}

		public function setMobTargetEntitaId($a){
			$q = "UPDATE BOT_RPG_MOB SET MOB_TARGET_ENTITA_ID = ".$a." WHERE MOB_ID = ". $this->mobId;
			$this->db->query($q);
			$this->mobTargetEntitaId = $a;
		}

		public function setMobPA($a){
			$q = "UPDATE BOT_RPG_MOB SET MOB_PA = ".$a." WHERE MOB_ID = ". $this->mobId;
			$this->db->query($q);
			$this->mobPA = $a;
		}

		public function setMobPM($a){
			$q = "UPDATE BOT_RPG_MOB SET MOB_X = ".$a." WHERE MOB_ID = ". $this->mobId;
			$this->db->query($q);
			$this->mobPM = $a;
		}

		public function getMobPM(){
			return $this->mobPM;
		}

		public function getEntitaId(){
			return $this->entitaId;
		}

		public function getMobPA(){
			return $this->mobPA;
		}

		public function sendMessage($msg){
			return 0;
		}

		public function getId(){
			return $this->mobId;
		}

		public function getSkills(){
			return $this->skills;
		}

		public function getOBJEquips(){
			return $this->OBJEquips;
		}

		public function setUtente(&$a){
			$this->OBJUtente = $a;
		}

		public function getUtente(){
			return $this->OBJUtente;
		}

		public function isVivo(){
			$a = $this->getMobHp() > 0;
			if($a) return true;
			else return false;
		}

		public function getNome(){
			return ucfirst(strtolower($this->tipoMobNome)) . ' ' . ucfirst(strtolower($this->OBJNome->getNomeNome()));
		}

		public function getNomeProprio(){
			return ucfirst(strtolower($this->OBJNome->getNomeNome()));
		}

		protected $arrStat = array();

		public function setArrStat($statId, $tipo, $value){
			$this->arrStat[$statId][$tipo] = $value;
		}

		//Getters
		public function getTotalStat($stat){
			$tot = 0;
			$limit = 1000;

			$fu = new Functions();
			$statId = $fu->getStatIdFromName($stat);
			$tot += $this->getStatFromTipoMob($statId);
			//$arr = $this->getStatFromTipoMob($statId);
			//$tot += $arr['VALUE'];
			//$tot += $arr['VALUE_XLVL'] * $this->getMobLevel();
			$tot += $this->getStatFromBuff($statId);

			if($tot > $limit)
				$tot = $limit;

			return $tot;
		}

		public function getStatFromBuff($statId){
			if(isset($this->arrStat[$statId]['buff']))
				return $this->arrStat[$statId]['buff'];

			$sql = "
				SELECT SUM(VALUE) AS VAL, COUNT(*) AS C
				FROM BOT_RPG_MOB_STAT_BUFF
				WHERE STAT_ID = $statId
				AND MOB_ID = ".$this->getMobId()."
				AND SCADENZA > 0";
			$res = Database()->query($sql);
			$row = $res->fetch_object();

			$val = $row->C > 0 ? $row->VAL : 0;

			$this->arrStat[$statId]['buff'] = $val;

			return $val;
		}

		public function lowerBuff(){
			$id = $this->getId();
			$sql = "UPDATE BOT_RPG_MOB_STAT_BUFF SET SCADENZA = SCADENZA - 1 WHERE MOB_ID = $id";
			Database()->query($sql);
		}

		public function gainItem($a, $b = 1){
			return false;
		}

		public function subisciDanno(Danno &$da){
			if(!$this->isVivo()){
				return false;
			}

			if($da->getFrase() !== null)
				write($da->getFrase());

			if($da->canBeDodged()){
				if($this->dodge($da->getPrecisione())){
					$da->setDodged(true);
					return false;
				}
			}

			$da->setDodged(false);

			$this->loadEquips();

			$this->triggerEquipsDebuff($da);

			$this->triggerOvertimesDebuff($da);

			$subisciDanno = $this->chooseDamage($da->getTipo());
			$dmg = $this->{$subisciDanno}($da);

			if(count($da->getEquips()) > 0) $this->subisciEquips($da);

			$this->triggerEquipsOnGetHitten($da->getDealer());

			if(count($da->getOverTimes()) > 0) $this->subisciOverTimes($da->getOverTimes());

			if(count($da->getBuff()) > 0) $this->buff($da->getBuff());

			if($da->getDealer() !== null){
				$this->changeFocus($da->getDealer()->getId(), $da->getDealer()->getEntitaId());
			}

			$this->talk();

			$this->checkDeath();

			$cd = $da->getCollateralDamage();
			$n = count($cd);
			if($n > 0){
				for($i = 0; $i < $n; $i++){
					if($cd[$i]->getTarget()->isVivo())
						$cd[$i]->send();
				}
			}

			return true;
		}

		public function talk(){
			$str = '';
			$sql = "
					SELECT FRASE_MOB_TESTO, FRASE_MOB_ID
					FROM BOT_RPG_FRASE_MOB
					WHERE FRASE_MOB_TIPO_MOB_ID = ".$this->getTipoMobId()."
					ORDER BY RAND()
					LIMIT 1
					";
			$res = Database()->query($sql);

			if($res->num_rows > 0){
				$row = $res->fetch_object();
				$frase = $row->FRASE_MOB_TESTO;
				//$frase = str_replace('_man_', $this->target->getNome(), $frase);
				$str .= "<b>".$this->getNome()."</b>: ".'"'.$frase.'"';
			}

			write($str);
		}

		public function getMsg($name){
            return $this->msg[$name];
        }

		public function setMobX($a){
			$q = "UPDATE BOT_RPG_MOB SET MOB_X = ".$a." WHERE MOB_ID = ". $this->mobId;
			$this->db->query($q);
			$this->mobX = $a;
		}

		public function setMobY($a){
			$q = "UPDATE BOT_RPG_MOB SET MOB_Y = ".$a." WHERE MOB_ID = ". $this->mobId;
			$this->db->query($q);
			$this->mobY = $a;
		}

		public function getMobX(){
			return $this->mobX;
		}

		public function getMobY(){
			return $this->mobY;
		}

		public function getOBJNome(){
			return $this->OBJNome;
		}

		public function getMobHp(){
			$sql = "SELECT MOB_HP FROM BOT_RPG_MOB WHERE MOB_ID = ".$this->getId();
			return $this->mobHp;
		}

		public function getMobNomeProprioId(){
			return $this->mobNomeProprioId;
		}

		public function setMobHp($a){
			$this->mobHp = $a;
			$this->mobHp = ($this->getTotalStat('HP') < $this->mobHp ? $this->getTotalStat('HP') : $this->mobHp);
			$q = "UPDATE BOT_RPG_MOB SET MOB_HP = ".$this->mobHp." WHERE MOB_ID = ". $this->mobId;
			$this->db->query($q);
		}

		public function getMobLevel(){
			return $this->mobLevel;
		}

		public function getMobSottoluogoId(){
			return $this->mobSottluogoId;
		}

		public function getMobTipoMobId(){
			return $this->mobTipoMobId;
		}

		public function attacca($ut){
			$dmg = $ut->subisciDanno($this, $this->getTotalStat('FORZA'));
			return $dmg;
		}

		public function takeSoldi(){
			return $this->getTipoMobSoldi(); //* $this->getMobLevel();
		}

		public function takeExp(){
			return $this->getTipoMobExp(); //* $this->getMobLevel();
		}

		function getHowManyDroppableItems(){

		}

		public function getSottoluogoId(){
			return $this->getMobSottoluogoId();
		}

		public function muovi($n, $where){
			if(!$this->isMovable())
				return true;

			$flag = false;
			$sl = new Sottoluogo($this->getMobSottoluogoId());
			switch(strtoupper($where)){
				case 'NORD':
					if($this->getMobY() - $n < 0) break;
					if($this->isAMobThere($this->getX(), $this->getY() - $n)) break;
					$this->setMobY($this->getMobY() - $n);
					$flag = true;
				break;

				case 'SUD':
					if($this->getMobY() + $n > $sl->getSottoluogoAmpiezza() - 1) break;
					if($this->isAMobThere($this->getX(), $this->getY() + $n)) break;
				    $this->setMobY($this->getMobY() + $n);
					$flag = true;
				break;

				case 'OVEST':
					if($this->getMobX() - $n < 0) break;
					if($this->isAMobThere($this->getX() - $n, $this->getY() - $n)) break;
					$this->setMobX($this->getMobX() - $n);
					$flag = true;
				break;

				case 'EST':
					if($this->getMobX() + $n > $sl->getSottoluogoAmpiezza() - 1) break;
					if($this->isAMobThere($this->getX() + $n, $this->getY() - $n)) break;
					$this->setMobX($this->getMobX() + $n);
					$flag = true;
				break;
			}

			if($flag){
				//write($this->getNome()." si sposta verso ".strtolower($where)."\n");
				//$this->setUtentePM($this->getUtentePM() - 1);
				return true;
			}else{
				return false;
			}
			/*
			if($flag){
				$msg = 'Movimento eseguito';
				$this->setMobPM($this->getMobPM() - 1);
			}else{
				$msg = 'Movimento NON eseguito';
			}
			*/

			//return $msg;
		}

		public function ArrMsgDmg($msg, $dmg){
			$data = array();
			$data['msg'] = $msg;
			$data['dmg'] = $dmg;
			return $data;
		}

		public function getSubisciDannoFrase($dealer, $dmg){
			$msg = $this->getNome() . ' subisce ' . $dmg . ' danni!';
			return $msg;
		}

		/*
		public function getDistanceFrom(&$ta){
			if($this->getUtenteSottoluogoId() == $ta->getSottoluogoId()){
				$msg = round(sqrt(pow($ta->getY() - $this->getY(), 2) + pow($ta->getX() - $this->getX(), 2)), 2);
			}else{
				$msg = 'Non siete nello stesso luogo!';
			}
			return $msg;
		}
		*/

		/*
		public function moveVersusPlayer(&$ut){
			if($this->getX() > $ut->getX() && $this->getY() > $ut->getY()){

			}
		}
		*/

		public function drop(&$Ut){
			//write('Hai sconfitto '.$this->getNome()."\n");
			if($this->mobTargetEntitaId != 0)
				return false;

			$Drop = new Drop($Ut, $this);

			$soldi = $this->takeSoldi();
			$exp = $this->takeExp();

			$Ut->accumulaSoldi(rand(0,$soldi));
			$Ut->accumulaExp($exp);

			//$Ut->giveSoldi(rand(0,$soldi));
			//$Ut->giveExp($exp);

			$Drop->send();
		}

		public function deleteAll(){
			$this->deleteOT();
			$this->deleteMemo();
			$this->deleteCooldowns();
			$this->deleteEquips();
		}

		public function deleteEquips(){
			$sql = "DELETE FROM BOT_RPG_MOB_EQUIP WHERE EQUIP_MOB_ID = ".$this->getId();
			Database()->query($sql);
		}

		public function deleteOT(){
			$sql = "DELETE FROM BOT_RPG_OVERTIME WHERE ENTITA_ID = ".$this->getEntitaId()." AND TARGET_ID = ".$this->getId();
			Database()->query($sql);
		}

		public function deleteCooldowns(){
			$entitaId = $this->getEntitaId();
			$mobId = $this->getId();
			$sql = "DELETE FROM BOT_RPG_UTENTE_COOLDOWN_SKILL WHERE ENTITA_ID = $entitaId AND UTENTE_ID = $mobId";
			Database()->query($sql);
		}

		public function die(){
			if($this->mobTargetEntitaId != 0){
				$this->deleteAll();
				$tipoMobId = $this->getTipoMobId();
				$sId = $this->getMobSottoluogoId();
				$sql = "INSERT INTO BOT_RPG_UTENTE_UCCIDE_MOB VALUES(
						999999,
						$tipoMobId,
						CURRENT_TIMESTAMP,
						$sId
					)";
				Database()->query($sql);
				return false;
			}

			$Ut = new Utente($this->mobTargetId);
			$this->drop($Ut);
			$Ut->addMobUcciso($this->getTipoMobId());
			$this->deleteAll();
		}

		public function buildTarget(&$tar){
			$id = $this->getMobTargetId();
			$entitaId = $this->getMobTargetEntitaId();
			$className = '';

			if($entitaId == 0){
				//$sql = "SELECT UTENTE_RAZZA_ID AS SUFF FROM BOT_RPG_UTENTE WHERE UTENTE_ID = $id";
				//$className .= 'Razza';
				return $tar;
			}

			if($entitaId == 1){
				$sql = "SELECT MOB_TIPO_MOB_ID AS SUFF FROM BOT_RPG_MOB WHERE MOB_ID = $id AND MOB_HP > 0";
				$className .= 'Mob';
			}

			$res = Database()->query($sql);
			if($res->num_rows == 0){
				return 'NO_MOB';
			}

			$suff = $res->fetch_object()->SUFF;
			$className .= $suff;
			$Target = new $className($id);

			$addrTarget = &$Target;

			return $addrTarget;
		}

		public function chooseWhatToDo(){
			$Intelligenza = new AI('AGGRESSIVE');
			$Intelligenza->setDealer($this);
			$Intelligenza->setTarget($this->target);
			$Intelligenza->run();
		}

		public function doSomething(&$target){
			//$this->target = $target;
			$this->OBJUtente = $target;
			$this->target = $this->buildTarget($target);

			if($this->target == 'NO_MOB'){
				return false;
			}

			$this->loadSkills();

			$this->chooseWhatToDo();
		}

		public function loadSkills(){
			$data = array();
			$sql = "SELECT SKILL_ID FROM BOT_RPG_SKILL_TIPO_MOB WHERE TIPO_MOB_ID = ".$this->getTipoMobId();
			$res = Database()->query($sql);
			while($row = $res->fetch_object()){
				$data[] = $row->SKILL_ID;
			}

			$this->skills = $data;
			return $data;
		}

		public function learnSkill($skillId, $livello){
			return false;
		}

		public function setHp($a){
			$this->setMobHp($a);
		}

		public function getHp(){
			return $this->getMobHp();
		}

		public function checkDeath(){
			if(!$this->isVivo()){
				write($this->getNome() . ' è stato sconfitto'."\n");
				$this->die();
				return true;
			}else{
				return false;
			}
		}

		public function buff($Buff){
			$n = count($Buff);
			for($i = 0; $i < $n; $i++){
				$Buff[$i]->send();
			}
		}

		public function hasOvertime(){
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_OVERTIME WHERE TARGET_ID = ".$this->getMobId()." AND ENTITA_ID = ".$this->getEntitaId()." AND NUM_TURNI > 0";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C > 0) return true;
			else return false;
		}

		public function triggerOvertimesDebuff(Danno $Danno){
			if(!$this->hasOvertime()) return 0;

			$ids = $this->getOverTimeCol('OVERTIME_ID');
			$tipoOvertimeIds = $this->getOverTimeCol('TIPO_OVERTIME_ID');
			$n = count($ids);
			for($i = 0; $i < $n; $i++){
				$className = 'OverTime'.$tipoOvertimeIds[$i];
				$OT = new $className($this, $ids[$i]);
				$OT->debuff($Danno);
				unset($OT);
			}
		}

		public function triggerOvertimesBuff(Danno &$Danno){
			if(!$this->hasOvertime()) return 0;

			$ids = $this->getOverTimeCol('OVERTIME_ID');
			$tipoOvertimeIds = $this->getOverTimeCol('TIPO_OVERTIME_ID');
			$n = count($ids);
			for($i = 0; $i < $n; $i++){
				$className = 'OverTime'.$tipoOvertimeIds[$i];
				$OT = new $className($this, $ids[$i]);
				$OT->buff($Danno);
				unset($OT);
			}
		}

		public function getOvertimeCol($col){
			$data = array();
			$sql = "SELECT $col AS DATA FROM BOT_RPG_OVERTIME WHERE TARGET_ID = ".$this->getMobId()." AND ENTITA_ID = ".$this->getEntitaId()." AND NUM_TURNI > 0";
			$res = Database()->query($sql);
			while($row = $res->fetch_object()){
				$data[] = $row->DATA;
			}

			return $data;
		}

		public function getOverTimes(){
			$data = array();
			$ids = $this->getOverTimeCol('OVERTIME_ID');
			$tipoOvertimeIds = $this->getOverTimeCol('TIPO_OVERTIME_ID');
			$n = count($ids);
			for($i = 0; $i < $n; $i++){
				$className = 'OverTime'.$tipoOvertimeIds[$i];
				$OT = new $className($this, $ids[$i]);
				$data[] = &$OT;
				unset($OT);
			}
			return $data;
		}

		public function triggerOvertimes(){
			if(!$this->hasOvertime()) return 0;

			$ids = $this->getOverTimeCol('OVERTIME_ID');
			$tipoOvertimeIds = $this->getOverTimeCol('TIPO_OVERTIME_ID');
			$n = count($ids);
			for($i = 0; $i < $n; $i++){
				$className = 'OverTime'.$tipoOvertimeIds[$i];
				$OT = new $className($this, $ids[$i]);
				$OT->trigger();
				unset($OT);
			}
		}

		public function subisciEquips(&$Danno){
			$Equips = $Danno->getEquips();
			$Dealer = $Danno->getDealer() !== NULL ?  $Danno->getDealer() : NULL;
			$n = count($Equips);
			for($i = 0; $i < $n; $i++){
				if($Dealer !== NULL)
					$Dealer->aumentaTalentoCategoriaEquip($Equips[$i]->getTipoEquipCategoriaId());
				$Equips[$i]->onHit($this);
			}
		}

		public function subisciOverTimes($OverTimes){
			$n = count($OverTimes);
			for($i = 0; $i < $n; $i++){
				$OverTimes[$i]->send();
			}
		}

		public function hasEquipped($nomeCategoriaEquip){
			/*
			if(!$this->hasSomethingEquipped()) return false;
			$fu = new Functions();
			if(!$fu->doesCategoriaEquipNameExist($nomeCategoriaEquip)) return false;
			$tipoEquipCategoriaId = $fu->getCategoriaEquipIdByName($nomeCategoriaEquip);
			$eqIds = $this->getActiveEquipArrayColumn('ID');
			$n = count($eqIds);
			for($i = 0; $i < $n; $i++){
				$eq = new Equip($eqIds[$i]);
				if($eq->getTipoEquipCategoriaId() == $tipoEquipCategoriaId)
					return true;
			}

			return false;
			*/
			return true;
		}

		public function getActiveEquipArrayColumn($col){
			$data = array();
			$col = strtoupper($col);
			$q = "SELECT EQUIP_$col AS V FROM BOT_RPG_MOB_EQUIP WHERE EQUIP_ATTIVO = 1 AND EQUIP_MOB_ID = ".$this->getId();
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$data[] = $row->V;
			}

			return $data;
		}

		public function hasSomethingEquipped(){
			$q = "
				SELECT COUNT(*) AS C
				FROM BOT_RPG_MOB_EQUIP
				WHERE EQUIP_MOB_ID = ". $this->getId()."
				AND EQUIP_ATTIVO = 1";
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			if($row->C == 0)
				return false;
			else
				return true;
		}

		public function loadEquips(){
			if(count($this->getOBJEquips()) != 0)
				return true;

			unset($this->OBJEquips);

			$arrIds = $this->getActiveEquipArrayColumn('ID');
			$arrTipo = $this->getActiveEquipArrayColumn('TIPO_EQUIP_ID');

			$n = count($arrIds);
			for($i = 0; $i < $n; $i++){
				$className = 'Equip'.$arrTipo[$i];
				//$this->target->sendMessage($className);
				$Eq = new $className($this, $arrIds[$i]);
				//$this->target->sendMessage($Eq->getTipoEquipCategoriaId());
				$this->OBJEquips[] = &$Eq;
				unset($Eq);
			}
		}

		public function triggerEquipsEffect(){
			$arr = $this->getOBJEquips();
			$n = count($arr);
			$str = '';
			for($i = 0; $i < $n; $i++){
				$arr[$i]->effect();
			}
		}

		public function triggerEquipsDebuff(Danno &$Danno){
			$Equips = $this->getOBJEquips();
			$n = count($Equips);
			for($i = 0; $i < $n; $i++){
				$Equips[$i]->debuff($Danno);
			}
		}

		public function triggerEquipsBuff(Danno &$Danno){
			$Equips = $this->getOBJEquips();
			$n = count($Equips);
			for($i = 0; $i < $n; $i++){
				$Equips[$i]->buff($Danno);
			}
		}

		public function triggerEquipsOnGetHitten(&$Dealer){
			$Equips = $this->getOBJEquips();
			$n = count($Equips);
			for($i = 0; $i < $n; $i++){
				$Equips[$i]->onGetHitten($Dealer);
			}
		}

		public function triggerEquipsOnAttack(&$target, $equipCategoria){
			$arr = $this->OBJEquips;
			$n = count($arr);
			$str = '';
			for($i = 0; $i < $n; $i++){
				if(strtoupper($arr[$i]->getTipoEquipCategoriaNome()) == strtoupper($equipCategoria))
					$arr[$i]->onAttack($target);
			}
		}

		public function getEquipsOfCategorie($equipCategorie){
			$this->loadEquips();
			$arr = $this->OBJEquips;
			$n = count($arr);
			$k = count($equipCategorie);
			$data = array();
			for($i = 0; $i < $n; $i++){
				for($j = 0; $j < $k; $j++){
					//$this->sendMessage($arr[$i]->getTipoEquipCategoriaNome().'='.$equipCategorie[$j]);
					if(strtoupper($arr[$i]->getTipoEquipCategoriaNome()) == strtoupper($equipCategorie[$j]))
						$data[] = &$arr[$i];
				}
			}

			return $data;
		}

		public function hasUnlockedSkill($skillId){
			$q = "SELECT *
				  FROM BOT_RPG_SKILL_TIPO_MOB
				  WHERE
				  	SKILL_ID = ".$skillId." AND TIPO_MOB_ID = ".$this->getTipoMobId();
			$res = $this->db->query($q);
			if($res->num_rows == 0) return false;
			else return true;
		}

		public function lowerCooldowns(){
			$sql = "UPDATE BOT_RPG_UTENTE_COOLDOWN_SKILL SET COOLDOWN_TURNI = COOLDOWN_TURNI - 1 WHERE COOLDOWN_UTENTE_ID = ".$this->getId()." AND COOLDOWN_ENTITA_ID = ".$this->getEntitaId()." AND COOLDOWN_TURNI > 0";
			Database()->query($sql);

			$sql = "DELETE FROM BOT_RPG_UTENTE_COOLDOWN_SKILL WHERE COOLDOWN_UTENTE_ID = ".$this->getId()." AND COOLDOWN_ENTITA_ID = ".$this->getEntitaId()." AND COOLDOWN_TURNI < 1";
			Database()->query($sql);
		}

		public function useRandomSkill(){
			$arr = $this->skills;
			if(count($arr) == 0){
				write($this->getNome().' non ha skill!'."\n");
				return 1;
			}
			$n = $arr[rand(0,count($arr)-1)];
			//$this->target->sendMessage('skill: '.$n);
			return $this->useSkill($n);
		}

		public function useSkill($skillId){
			if($this->isImpaired())
				return true;

			$className = 'Skill'.$skillId;
			$Skill = new $className();
			$Skill->setCaster($this);
			$Skill->setTarget($this->target);
			$Skill->loadEquips();
			$Skill->loadOvertimes();
			if($Skill->check()){
				return $Skill->getReadyToBeTriggered();
				//return true;
			}else{
				return false;
			}
		}

		protected $enemies = array();
		public function loadEnemies(){
			unset($this->enemies);
			$sql = "SELECT MOB_UTENTE_ID, UTENTE_RAZZA_ID FROM BOT_RPG_MOB, BOT_RPG_UTENTE WHERE MOB_ID = ".$this->getId()." AND UTENTE_ID = MOB_UTENTE_ID";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			$className = 'Razza'.$row->UTENTE_RAZZA_ID;
			$Target = new $className($row->MOB_UTENTE_ID);
			$this->enemies[] = &$Target;
		}

		public function getEnemies(){
			return $this->enemies;
		}

		public function isMemoSet($string){
			$string = strtoupper($string);
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_MOB_MEMO WHERE MEMO_TESTO = '$string' AND MEMO_MOB_ID = ".$this->getId();
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C > 0){
				return true;
			}else{
				return false;
			}
		}

		public function getMemo($string){
			$string = strtoupper($string);
			$sql = "SELECT MEMO_VALUE FROM BOT_RPG_MOB_MEMO WHERE MEMO_TESTO = '$string' AND MEMO_MOB_ID = ".$this->getId();
			$res = Database()->query($sql);
			if($res->num_rows > 0){
				$row = $res->fetch_object();
				return $row->MEMO_VALUE;
			}else{
				return 0;
			}
		}

		public function setMemo($string, $val){
			$db = Database();
			$id = $this->getId();
			$string = strtoupper($string);

			$sql = "DELETE FROM BOT_RPG_MOB_MEMO WHERE MEMO_TESTO = '$string' AND MEMO_MOB_ID = $id";
			$db->query($sql);

			$sql = "INSERT INTO BOT_RPG_MOB_MEMO VALUES ($id, '$string', $val)";
			$db->query($sql);
		}

		public function deleteMemo(){
			$id = $this->getId();
			$sql = "DELETE FROM BOT_RPG_MOB_MEMO WHERE MEMO_MOB_ID = $id";
			Database()->query($sql);
		}

		public function getPercentualeStat($stat, $percentuale){
			$sta = $this->getTotalStat($stat);
			$perc = intVal(($sta * $percentuale) / 100);
			return $perc;
		}

		public function changeFocus($targetId, $entitaId){
			$this->setMobTargetId($targetId);
			$this->setMobTargetEntitaId($entitaId);
			return true;
		}

		public function isThereAnyEnemy($x, $y){
			return $this->isThereAnyMob($x, $y) || $this->isThereAnyUser($x, $y);
		}

		public function isThereAnyMob($X, $Y){
			$q = "SELECT MOB_ID
				  FROM BOT_RPG_MOB
				  WHERE
				  	MOB_X = $X
				  AND
					MOB_Y = $Y
				  AND
				  	MOB_SOTTOLUOGO_ID = ".$this->getMobSottoluogoId()."
				  AND
				  	MOB_UTENTE_ID = ".$this->mobUtenteId."
				  AND
				  	MOB_HP > 0
				  AND
				  	MOB_ID <> ".$this->getId();
			$res = $this->db->query($q);
			if($res->num_rows < 1) return false;
			else return true;
		}

		public function isThereAnyUser($X, $Y){
			$q = "SELECT UTENTE_ID
				  FROM BOT_RPG_UTENTE
				  WHERE
				  	UTENTE_X = $X
				  AND
					UTENTE_Y = $Y
				  AND
				  	UTENTE_SOTTOLUOGO_ID = ".$this->getMobSottoluogoId()."
				  AND
				  	UTENTE_ID = ".$this->mobUtenteId;
			$res = $this->db->query($q);
			if($res->num_rows < 1) return false;
			else return true;
		}

		public function getUserOBJHere($X, $Y){
			$q = "SELECT *
				  FROM BOT_RPG_UTENTE
				  WHERE
				  	UTENTE_X = $X
				  AND
					UTENTE_Y = $Y
				  AND
				  	UTENTE_SOTTOLUOGO_ID = ".$this->getMobSottoluogoId()."
				  AND
				  	UTENTE_ID = ".$this->mobUtenteId;
			$res = $this->db->query($q);
			$data = array();
			while($row = $res->fetch_object()){
				$className = 'Razza'.$row->UTENTE_RAZZA_ID;
				$Utente = new $className($row->UTENTE_ID);
				$data[] = &$Utente;
				unset($Utente);
			}
			return $data;
		}

		public function getMobArrOBJHere($X, $Y){
			$q = "SELECT *
				  FROM BOT_RPG_MOB
				  WHERE
				  	MOB_X = $X
				  AND
					MOB_Y = $Y
				  AND
				  	MOB_SOTTOLUOGO_ID = ".$this->getMobSottoluogoId()."
				  AND
				  	MOB_UTENTE_ID = ".$this->mobUtenteId."
				  AND
				  	MOB_HP > 0
				  AND
				  	MOB_ID <> ".$this->getId();
			$res = $this->db->query($q);
			$data = array();
			while($row = $res->fetch_object()){
				$className = 'Mob'.$row->MOB_TIPO_MOB_ID;
				$Mob = new $className($row->MOB_ID);
				$data[] = &$Mob;
				unset($Mob);
			}
			return $data;
		}

		public function selectAllMobsMultidimensionalArrayIdXY(){
			$data = array();
			$i = 0;
			$q = "
				SELECT MOB_ID, MOB_Y, MOB_X
				FROM BOT_RPG_MOB
				WHERE MOB_HP > 0
					AND MOB_SOTTOLUOGO_ID = ".$this->getSottoluogoId()."
					AND MOB_UTENTE_ID = " . $this->mobUtenteId;
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$data[$i]['ID'] = $row->MOB_ID;
				$data[$i]['X'] = $row->MOB_X;
				$data[$i]['Y'] = $row->MOB_Y;
				$i++;
			}

			return $data;
		}

		public function isAMobThere($x, $y){
			$arr = $this->selectAllMobsMultidimensionalArrayIdXY();
			$n = count($arr);
			for($i = 0; $i < $n; $i++){
				if($arr[$i]['X'] == $x && $arr[$i]['Y'] == $y){
					return true;
				}
			}

			return false;
		}

		public function getTargetsInRange($range = 1){
			return array_merge($this->getMobObjInRange($range), $this->getUserObjInRange($range));
		}

		public function getUserObjInRange($range){
			$data = array();
			if($this->OBJUtente !== NULL){
				if($this->getDistanceFrom($this->OBJUtente) <= $range)
					$data[] = &$this->OBJUtente;
			}
			return $data;
		}

		public function getMobObjInRange($range){
			$utenteId = $this->mobUtenteId;
			$X = $this->getX();
			$Y = $this->getY();
			$sottoluogoId = $this->getSottoluogoId();
			/*
			$sql = "SELECT MOB_ID, MOB_TIPO_MOB_ID
					FROM BOT_RPG_MOB
					WHERE MOB_SOTTOLUOGO_ID = $sottoluogoId
					AND MOB_UTENTE_ID = $utenteId
					AND MOB_HP > 0
					AND ((MOB_X = $X AND MOB_Y = $Y)
					OR (MOB_X <= $X + $range AND MOB_Y = $Y)
					OR (MOB_X >= $X - $range AND MOB_Y = $Y)
					OR (MOB_Y <= $Y + $range AND MOB_X = $X)
					OR (MOB_Y >= $Y - $range AND MOB_X = $X)
					OR (MOB_X <= $X + $range AND MOB_Y <= $Y + $range)
					OR (MOB_X >= $X - $range AND MOB_Y <= $Y + $range)
					OR (MOB_X >= $X - $range AND MOB_Y >= $Y - $range)
					OR (MOB_X <= $X + $range AND MOB_Y >= $Y - $range))
					";
			*/
			$mobId = $this->getId();
			$sql = "SELECT MOB_ID, MOB_TIPO_MOB_ID
					FROM BOT_RPG_MOB
					WHERE MOB_SOTTOLUOGO_ID = $sottoluogoId
					AND MOB_UTENTE_ID = $utenteId
					AND MOB_HP > 0
					AND MOB_ID <> $mobId
					";
			$res = Database()->query($sql); //die($sql);
			$data = array();
			while($row = $res->fetch_object()){
				$className = 'Mob'.$row->MOB_TIPO_MOB_ID;
				$Mob = new $className($row->MOB_ID);
				if($this->getDistanceFrom($Mob) <= $range)
					$data[] = &$Mob;
				unset($Mob);
			}

			return $data;
		}

		public function aumentaTalentoCategoriaEquip($categoriaEquipId){
			return false;
		}

		public function getEquipInfo($EQUIP_ID){
			$eq = new Equip($EQUIP_ID, $this);

			$msg = '';
			$msg .= '<b>'.$eq->getTipoEquipNome() . '</b> ('.$eq->getEquipLivello().')' . "\n";

			$q = "SELECT * FROM BOT_RPG_STAT_TIPO_EQUIP WHERE TIPO_EQUIP_ID = ".$eq->getTipoEquipId();
			$res = $this->db->query($q);
			if($res->num_rows == 0) return $msg . 'Questo equip non ha statistiche'."\n";
			while($row = $res->fetch_object()){
				$st = new Stat($row->STAT_ID);
				$value = $eq->getEquipLivello() == 1 ? $row->VALUE : (int)($row->VALUE * $eq->getEquipLivello()/9) + $row->VALUE;
				if($value != 0)
					$msg .= getEmojiStats()[strtoupper($st->getStatNome())].$st->getStatNome() ." <i>". $value . "</i>\n";
			}

			//$msg .= "\n";
			return $msg;






			/*
			$str = '';
			$stats = array('forza', 'intelligenza', 'saggezza', 'destrezza', 'costituzione', 'carisma');
			$q = "
				SELECT *
				FROM BOT_RPG_EQUIP, BOT_RPG_TIPO_EQUIP
				WHERE EQUIP_TIPO_EQUIP_ID = TIPO_EQUIP_ID
				AND EQUIP_ID = ". $EQUIP_ID;
			$res = $this->db->query($q);
			$row = $res->fetch_object();
			$str = ucfirst($row->TIPO_EQUIP_NOME). ' (+'.$row->EQUIP_LIVELLO.')' ."\n";
			for($i = 0; $i < 6; $i++){
				$stmt = 'TIPO_EQUIP_'.strtoupper($stats[$i]);
				if($row->{$stmt} != 0){
					if($row->{$stmt} > 0) $sign = '+';
					else $sign = '';
					$str .= $sign . ($row->{$stmt}  + ($row->EQUIP_LIVELLO * intVal($row->{$stmt}/10) )) . ' ' . ucfirst($stats[$i]) . "\n";
				}
			}
			return $str;
			*/


		}

		public function printEquip(){
			if($this->hasSomethingEquipped()){
				$ids = array();

				//$msg = 'Equipaggiamento indossato' . "\n\n";
				$ids = $this->getActiveEquipArrayColumn('ID');
				$n = count($ids);
				for($i = 0; $i < $n; $i++){
					$msg .= $this->getEquipInfo($ids[$i]) . "\n";
				}

				/*
				$msg .= 'Equipaggiamento non indossato' . "\n";
				$ids = $this->getIdsEquipNotActive();
				$n = count($ids);
				for($i = 0; $i < $n; $i++){
					$msg .= $this->getEquipInfo($ids[$i]) . "\n";
				}
				*/
			}else{
				//$msg = $this->getNome().' non ha oggetti equipaggati!';
			}

			return $msg;
		}

		public function printInfo(){
			$ut = &$this;

			$razza = $this->getTipoMobNome();

			$msg  = '';
			$msg .= ucfirst($ut->getNomeProprio());
			$msg .= ' (' . ucfirst($razza) . ')';
			$msg .= "\n";
			$msg .= '<i>Livello</i> '.Functions::drawNumberToEmoji($this->getMobLevel());//$ut->calculateLevel().'</i>';
			$msg .= "\n\n";

			$msg .= HP.'<b>HP</b>: '		. (int)$ut->getHp() . '/' . (int)$ut->getTotalStat('HP') . "\n";

			$q = "SELECT STAT_NOME FROM BOT_RPG_STAT";
			$res = $this->db->query($q);
			while($row = $res->fetch_object()){
				$statValue = (int)$ut->getTotalStat($row->STAT_NOME);
				if(strtoupper($row->STAT_NOME) == 'ARMATURA') $armor = $statValue;
				if(strtoupper($row->STAT_NOME) == 'SALVAMAGIA') $salva = $statValue;
				if($row->STAT_NOME != 'HP' && $statValue != 0)
					$msg .= getEmojiStats()[strtoupper($row->STAT_NOME)].'<b>'.$row->STAT_NOME.'</b>: '.$statValue."\n";
			}

			$armor = ($this->getPercDannoExp($armor) - 100);
			$salva = ($this->getPercDannoExp($salva) - 100);

			$armorSign = '';
			if($armor > 0)
				$armorSign = '+';

			$salvaSign = '';
			if($salva > 0)
				$salvaSign = '+';

			$msg .= ($armor != 0 || $salva != 0) ? "\n<b>SUBISCE</b>\n" : '';
			$msg .= $armor != 0 ? ' '.ARMATURA.' <b>'.$armorSign.''.round($armor,1).'% Danni Fisici</b>'."\n" : '';
			$msg .= $salva != 0 ? ' '.SALVAMAGIA.' <b>'.$salvaSign.''.round($salva,1). '% Danni Magici</b>'."\n" : '';;

			$msg .= $this->printEquip();

			//if($this->getUtente()->isDonny())
				$msg .= '<a href = "'.$this->getTipoMobImgPath().'"> </a>';

			write($msg);
		}

		public function triggerPreOvertimes(){
			if(!$this->hasOvertime()) return 0;

			if($this->ots !== null){
				$OTS = $this->ots;
				$n = count($OTS);
				for($i = 0; $i < $n; $i++){
					$OTS[$i]->preTrigger();
				}
				
				return true;
			}

			$ids = $this->getOverTimeCol('OVERTIME_ID');
			$tipoOvertimeIds = $this->getOverTimeCol('TIPO_OVERTIME_ID');
			$n = count($ids);
			for($i = 0; $i < $n; $i++){
				$className = 'OverTime'.$tipoOvertimeIds[$i];
				$OT = new $className($this, $ids[$i]);
				$OT->preTrigger();
				unset($OT);
			}
		}

		public function battleFlow(&$ut){
			$Mob = &$this;
			if($Mob->isVivo()){
				$Mob->triggerPreOvertimes();
				$Mob->doSomething($ut);
				$Mob->passive();
				$Mob->triggerOvertimes();
				$Mob->lowerBuff();
				$Mob->lowerCooldowns();
			}
		}

		public function assegnaEquip(){

		}

		public function giveEquip($tipoEquipId, $livello){
			$mobId = $this->getId();
			$sql = "INSERT INTO BOT_RPG_MOB_EQUIP VALUES(null, $mobId, $tipoEquipId, $livello, 1)";
			Database()->query($sql);
		}

		public function scegliDardo(){
			return true;
		}


	}
