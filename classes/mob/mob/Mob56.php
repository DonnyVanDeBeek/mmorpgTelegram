<?php
	Class Mob56 extends Mob{
		//GALLINA ARRABBIATA
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
				$sql = "SELECT MOB_ID, MOB_TIPO_MOB_ID FROM BOT_RPG_MOB WHERE MOB_SOTTOLUOGO_ID = ".$this->getMobSottoluogoId()." AND MOB_UTENTE_ID = ".$this->getMobUtenteId()." AND MOB_HP > 0 AND MOB_ID <> ".$this->getId()." LIMIT 1";
				//mail('lorenzo.dona97@gmail.com', 'BotMob', "$sql");
				$res = Database()->query($sql);
				if($res->num_rows == 0)
					return 'NO_MOB';

				$row = $res->fetch_object();
				$className .= $row->MOB_TIPO_MOB_ID;
				$Target = new $className($row->MOB_ID);
				$this->changeFocus($Target->getId(), $Target->getEntitaId());
				return $Target;
			}

			$suff = $res->fetch_object()->SUFF;
			$className .= $suff;
			$Target = new $className($id);

			return $Target;
		}

		public function changeFocus($targetId, $entitaId){
			if($entitaId == 0)
				return false;

			$this->setMobTargetId($targetId);
			$this->setMobTargetEntitaId($entitaId);
			return true;
		}

		public function subisciDanno(Danno &$Danno){
			if($Danno->getDealer() !== NULL){
				$del = $Danno->getDealer();
				if($del->getEntitaId() == 0 && $del->getId() == $this->mobUtenteId){
					write($del->getNome(). ' non può colpire il suo pet!');
					return false;
				}
			}

			parent::subisciDanno($Danno);
		}
	}