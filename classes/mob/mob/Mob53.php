<?php
	Class Mob53 extends Mob{
		//GUARDIA DELLA MINIERA D`ORO DI OSKARIA
		public function __construct($id){
			parent::__construct($id);
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
				$sql = "SELECT MOB_ID FROM BOT_RPG_MOB WHERE MOB_TIPO_MOB_ID = 52 AND MOB_SOTTOLUOGO_ID = ".$this->getMobSottoluogoId()." AND MOB_UTENTE_ID = ".$this->getMobUtenteId()." AND MOB_HP > 0 LIMIT 1";
				//mail('lorenzo.dona97@gmail.com', 'BotMob', "$sql");
				$res = Database()->query($sql);
				if($res->num_rows == 0)
					return 'NO_MOB';
				
				$suff = 52;
				$className .= $suff;
				$Target = new $className($res->fetch_object()->MOB_ID);
				$this->changeFocus($Target->getId(), $Target->getEntitaId());
				return $Target;
			}

			$suff = $res->fetch_object()->SUFF;
			$className .= $suff;
			$Target = new $className($id);

			return $Target;
		}
	}