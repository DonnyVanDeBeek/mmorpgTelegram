<?php
	//MANTO DELLA LUNGIMIRANZA
	class Equip107 extends Equip{
		private $equipId = 107;

		public function __construct(&$ut, $id){
			parent::__construct($id);
			$this->utente = $ut;
		}

		public function onGetHitten(&$Dealer){
			$Ut = $this->utente;
			$memo = 'EQUIP_107_CARICA';

			if($Ut->isMemoSet($memo)){
				$memoVal = $Ut->getMemo($memo);
				switch($memoVal){
					case 3:
						$Ut->setMemo($memo, 0);
						$dmg = $Ut->getMemo('EQUIP_107_DANNO');
						$cura = (int)$dmg * 0.3;

						write($this->getTipoEquipNome().' ha raggiunto tre cariche!'."\n");
						write($Ut->getNome().' ottiene una cura!'."\n");

						$OT = new OverTime();
						$OT->setTarget($Ut);
						$OT->setValue($cura);
						$OT->setTipoOvertime('CURA');
						$OT->setNumTurni(2);
						$OT->send();

						$Ut->setMemo('EQUIP_107_CARICA', 0);
						$Ut->setMemo('EQUIP_107_DANNO', 0);
					break;

					default:
						$Ut->setMemo($memo, $memoVal+1);
				}
			}else{
				$Ut->setMemo($memo, 1);
			}
		}

		public function debuff(Danno &$Danno){
			$Ut = $this->utente;

			$memo = 'EQUIP_107_DANNO';
			if($Ut->isMemoSet($memo)){
				$Ut->setMemo($memo, $Ut->getMemo($memo) + $Danno->getDmg());
			}else{
				$Ut->setMemo($memo, $Danno->getDmg());
			}

			$memo = 'EQUIP_107_CARICA';
			if($Ut->isMemoSet($memo)){
				if($Ut->getMemo($memo) == 3){
					write($this->getTipoEquipNome().' riduce il danno del 30%!'."\n");
					$dmg = (int)$Danno->getDmg() * 0.7;
					$Danno->setDmg($dmg);
				}
			}
		}
	}