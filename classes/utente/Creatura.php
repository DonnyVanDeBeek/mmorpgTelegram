<?php
	interface interface_creatura{
		#Danni
		public function subisciDannoFisico			(Danno $Danno);
		public function subisciDannoBruciatura		(Danno $Danno);
		public function subisciDannoContundente		(Danno $Danno);
		public function subisciDannoPerforante		(Danno $Danno);
		public function subisciDannoTagliente		(Danno $Danno);
		public function subisciDannoMagico			(Danno $Danno);
		public function subisciDannoPuro			(Danno $Danno);
		public function subisciDannoEsplosione		(Danno $Danno);
		public function subisciDannoVeleno			(Danno $Danno);
		public function subisciDannoSanguinamento	(Danno $Danno);
		public function subisciDannoAcido			(Danno $Danno);
		public function subisciDannoElettrico		(Danno $Danno);
		public function subisciDannoSquarciante		(Danno $Danno);
		public function subisciDannoFuoco			(Danno $Danno);

		#Funzione principale che gestisce il danno, tutti i danni passano da questa
		public function subisciDanno 			    (Danno &$Danno); 

		#OverTimes
		public function dealWithOverTime(OverTime &$OT); #Quando un OverTime si attiva

		#Battaglia
		public function passive(); #Si attiva automaticamente a inizio turno
		public function dealDamage(Danno &$D); #Quando arreca danno
		public function dealWithBuff(Buff &$Buff); #Quando subisce un buff/debuff
		public function dodge($precisione); #Calcola se la schivata riesce o meno

		#Movimento 
		public function moveAwayFrom($Target); #Decide di allontanarsi da qualcuno
		public function moveTowards($Target); #Decide di avvicinarsi a qualcuno
		public function sposta($n, $verso); #Viene spostato
	}

	Class Creatura implements interface_creatura{
		protected $arrStat = array();

		public function setArrStat($statId, $tipo, $value){
			$this->arrStat[$statId][$tipo] = $value;
		}
		
		//INIZIO SUBISCI DANNI
		public function subisciDanno(Danno &$Danno){
			return $Danno->getDmg();
		}

		public function subisciDannoFisico(Danno $Danno){
			$perc = $this->getPercDannoExp($this->getTotalStat('ARMATURA'));
			if($perc == 0) $perc = 0.01;
			$dmg = $Danno->getDmg() * ($perc / 100);
			$this->setHp($this->getHp() - intVal($dmg));

			write($this->getNome() . ' subisce '.(int)$dmg.' danni fisici! '.SYMBOLS_BROKEN_HEART."\n");
			return $dmg;
		}

		public function subisciDannoBruciatura(Danno $Danno){
			$dmg = $Danno->getDmg();
			$this->setHp($this->getHp() - $dmg);

			write($this->getNome() . ' subisce '.(int)$dmg.' danni da bruciatura! '.SYMBOLS_BROKEN_HEART."\n");
			return $dmg;
		}

		public function subisciDannoContundente(Danno $Danno){
			$perc = $this->getPercDannoExp($this->getTotalStat('ARMATURA'));
			if($perc == 0) $perc = 0.01;
			$dmg = $Danno->getDmg() * ($perc / 100);
			$this->setHp($this->getHp() - $dmg);

			write($this->getNome() . ' subisce '.(int)$dmg.' danni contundenti! '.SYMBOLS_BROKEN_HEART."\n");
			return $dmg;
		}

		public function subisciDannoPerforante(Danno $Danno){
			$perc = $this->getPercDannoExp($this->getTotalStat('ARMATURA'));
			if($perc == 0) $perc = 0.01;

			$dmg = (int)$Danno->getDmg()/2 * ($perc / 100);
			$dmg += (int)$Danno->getDmg()/2;

			$this->setHp($this->getHp() - $dmg);

			write($this->getNome() . ' subisce '.(int)$dmg.' danni perforanti! '.SYMBOLS_BROKEN_HEART."\n");
			return $dmg;
		}

		public function subisciDannoTagliente(Danno $Danno){
			$perc = $this->getPercDannoExp($this->getTotalStat('ARMATURA'));
			if($perc == 0) $perc = 0.01;
			$dmg = $Danno->getDmg() * ($perc / 100);
			$this->setHp($this->getHp() - $dmg);

			write($this->getNome() . ' subisce '.(int)$dmg.' danni da taglio! '.SYMBOLS_BROKEN_HEART."\n");
			return $dmg;
		}

		public function subisciDannoMagico(Danno $Danno){
			$perc = $this->getPercDannoExp($this->getTotalStat('SALVAMAGIA'));
			if($perc == 0) $perc = 0.01;
			$dmg = $Danno->getDmg() * ($perc / 100);
			$this->setHp($this->getHp() - $dmg);

			write($this->getNome() . ' subisce '.(int)$dmg.' danni magici! '.SYMBOLS_BROKEN_HEART."\n");
			return $dmg;
		}

		public function subisciDannoPuro(Danno $Danno){
			$this->setHp($this->getHp() - $Danno->getDmg());
			write($this->getNome() . ' subisce '.(int)$Danno->getDmg().' danni puri! '.SYMBOLS_BROKEN_HEART."\n");
			return $Danno->getDmg();
		}

		public function subisciDannoEsplosione(Danno $Danno){
			$perc = $this->getPercDannoExp($this->getTotalStat('ARMATURA'));
			if($perc == 0) $perc = 0.01;
			$dmg = $Danno->getDmg() * ($perc / 100);
			$this->setHp($this->getHp() - $Danno->getDmg());

			write($this->getNome() . ' subisce '.(int)$Danno->getDmg().' danni da esplosione! '.SYMBOLS_BROKEN_HEART."\n");
			return $Danno->getDmg();
		}

		public function subisciDannoVeleno(Danno $Danno){
			$this->setHp($this->getHp() - $Danno->getDmg());
			write($this->getNome() . ' subisce '.(int)$Danno->getDmg().' danni da veleno! '.SYMBOLS_BROKEN_HEART."\n");
			return $Danno->getDmg();
		}

		public function subisciDannoSanguinamento(Danno $Danno){
			$this->setHp($this->getHp() - $Danno->getDmg());
			write($this->getNome() . ' subisce '.(int)$Danno->getDmg().' danni da sanguinamento! '.SYMBOLS_BROKEN_HEART."\n");
			return $Danno->getDmg();
		}

		public function subisciDannoAcido(Danno $Danno){
			$perc = $this->getPercDannoExp($this->getTotalStat('ARMATURA'));
			if($perc == 0) $perc = 0.01;

			$dmg = (int)$Danno->getDmg()/2 * ($perc / 100);
			$dmg += (int)$Danno->getDmg()/2;

			$this->setHp($this->getHp() - $dmg);

			write($this->getNome() . ' subisce '.(int)$Danno->getDmg().' danni da acido! '.SYMBOLS_BROKEN_HEART."\n");
			return $Danno->getDmg();
		}

		public function subisciDannoElettrico(Danno $Danno){
			$perc = $this->getPercDannoExp($this->getTotalStat('SALVAMAGIA'));
			if($perc == 0) $perc = 0.01;
			$dmg = $Danno->getDmg() * ($perc / 100);
			$this->setHp($this->getHp() - $dmg);

			write($this->getNome() . ' subisce '.(int)$Danno->getDmg().' danni elettrici! '.SYMBOLS_BROKEN_HEART."\n");
			return $Danno->getDmg();
		}

		public function subisciDannoSquarciante(Danno $Danno){
			$perc = $this->getPercDannoExp($this->getTotalStat('ARMATURA'));
			if($perc == 0) $perc = 0.01;
			$dmg = $Danno->getDmg() * ($perc / 100);
			$this->setHp($this->getHp() - $dmg);

			write($this->getNome() . ' subisce '.(int)$Danno->getDmg().' danni squarcianti! '.SYMBOLS_BROKEN_HEART."\n");
		}

		public function subisciDannoFuoco(Danno $Danno){
			$perc = $this->getPercDannoExp($this->getTotalStat('ARMATURA'));
			if($perc == 0) $perc = 0.01;
			$dmg = $Danno->getDmg() * ($perc / 100);
			$this->setHp($this->getHp() - $dmg);

			write($this->getNome() . ' subisce '.(int)$Danno->getDmg().' danni da fuoco! '.SYMBOLS_BROKEN_HEART."\n");
		}

		public function chooseDamage($tipo){
			switch(strtoupper($tipo)){
				case 'FISICO':
					return 'subisciDannoFisico';
				break;

				case 'MAGICO':
					return 'subisciDannoMagico';
				break;

				case 'PURO':
					return 'subisciDannoPuro';
				break;

				case 'CONTUNDENTE':
					return 'subisciDannoContundente';
				break;

				case 'PERFORANTE':
					return 'subisciDannoPerforante';
				break;

				case 'TAGLIENTE':
					return 'subisciDannoTagliente';
				break;

				case 'BRUCIATURA':
					return 'subisciDannoBruciatura';
				break;

				case 'ESPLOSIONE':
					return 'subisciDannoEsplosione';
				break;

				case 'VELENO':
					return 'subisciDannoVeleno';
				break;

				case 'SANGUINAMENTO':
					return 'subisciDannoSanguinamento';
				break;

				case 'ACIDO':
					return 'subisciDannoAcido';
				break;

				case 'ELETTRICO':
					return 'subisciDannoElettrico';
				break;

				case 'SQUARCIANTE':
					return 'subisciDannoSquarciante';
				break;

				case 'FUOCO':
					return 'subisciDannoFuoco';
				break;

				default:
					return 'subisciDannoPuro';
			}
		}
		//FINE SUBISCI DANNI

		public function dodge($precisione){
			//$r = rand(0, 100);
			$destrezza = $this->getTotalStat('DESTREZZA');
			$destrezza = rand(0, intval($destrezza/3));
			$precisione = rand(0, $precisione);
			if($destrezza > $precisione){
				//write($this->getNome() . ' schiva! '.RUN."\n");
				write('<i>Mancato!</i>'."\n");
				return true;
			}else{
				return false;
			}
		}

		public function dealDamage(Danno &$D){
			return false;
		}

		public function giveBuff($stat, $val, $turni){
			$B = new Buff();
			$B->setTarget($this);
			$B->setStat($stat);
			$B->setValue((int)$val);
			$B->setTurni($turni);
			$B->send();
		}

		public function passive(){
			return false;
		}

		public function removeTipoOvertime($overTimeId){
			$sql = "DELETE FROM BOT_RPG_OVERTIME WHERE TIPO_OVERTIME_ID = $overTimeId AND TARGET_ID = ".$this->getId()." AND ENTITA_ID = ".$this->getEntitaId();
			Database()->query($sql);
		}

		public function removeOvertime($overTimeId){
			$sql = "DELETE FROM BOT_RPG_OVERTIME WHERE TIPO_OVERTIME_ID = $overTimeId AND TARGET_ID = ".$this->getId()." AND ENTITA_ID = ".$this->getEntitaId();
			Database()->query($sql);
		}

		public function giveOverTime($id, $val, $turni){
			$OT = new OverTime();
			$OT->setTipoOverTimeId($id);
			$OT->setValue($val);
			$OT->setNumTurni($turni);
			$OT->setTarget($this);
			$OT->send();
		}

		public function dealWithOverTime(OverTime &$OT){
			return false;
		}

		public function triggerOverTimeDealWithOverTime(OverTime &$OverTime){

		}

		public function dealWithBuff(Buff &$Buff){
			return false;
		}

		public function heal($healing){
			$hp = $this->getHp();

			$this->setHp($this->getHp() + abs($healing));

			$heal = $this->getHp() - $hp;

			if($heal > 0)
				write($this->getNome() . ' recupera ' . (int)$heal . ' HP!' . "\n");
		}

		public function moveAwayFrom($Target){
			$tx = $Target->getX();
			$ty = $Target->getY();

			$dx = $this->getX();
			$dy = $this->getY();

			if($tx > $dx)
				$dir = 'OVEST';

			if($tx < $dx)
				$dir = 'EST';

			if($ty > $dy)
				$dir = 'NORD';

			if($ty < $dy)
				$dir = 'SUD';

			return $this->muovi(1, $dir);
		}

		public function moveTowards($Target){
			$tx = $Target->getX();
			$ty = $Target->getY();

			$dx = $this->getX();
			$dy = $this->getY();

			if($tx > $dx)
				$dir = 'EST';

			if($tx < $dx)
				$dir = 'OVEST';

			if($ty > $dy)
				$dir = 'SUD';

			if($ty < $dy)
				$dir = 'NORD';

			return $this->muovi(1, $dir);
		}

		public function provaDi($statNome){
			$stat = $this->getTotalStat($statNome);
			if($stat <= 0)
				return 0;
			else
				return rand(0, $stat);
		}

		public function summonMob($array){
			$tipoMobId = $array['ID'];
			$sottoluogoId = $this->getSottoluogoId();
			$livello = $array['LVL'];
			$utenteId = isset($array['UTENTE_ID']) ? $array['UTENTE_ID'] : $this->getId();
			$mobHp = $array['HP'];
			$nomeProprioId = isset($array['NOME_ID']) ? isset($array['NOME_ID']) : rand(100, 80000);
			$flagTarget = 99;
			$pm = 5;
			$pa = 5;
			$x = $array['X'];
			$y = $array['Y'];
			$targetId = $array['TARGET_ID'];
			$targetEntitaId = $array['TARGET_ENTITA_ID'];
			$pet = isset($array['PET']) ? isset($array['PET']) : 0;
			$Functions = new Functions();
			$Functions->spawnSpecificMob(
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
			);
		}

		//SUBISCI DANNO
		public function getPercDannoExp($difesa){
			/*
			$perc = $difesa * 1.7;
			$perc /= 10;
			if($perc > 90) $perc = 90;
			$perc = 100 - $perc;
			*/

			//$difesa = -100;

			/*
			if($difesa == 0)
 				$difesa = 1;

			if($difesa > 0){
			  $perc = log($difesa, 0.4);
			  $perc = abs($perc * 10); 
			}
			
			if($difesa < 0){
			  $perc = log(abs($difesa), 0.4);
			  $perc = $perc * 10;  
			}

			$cap = 90;

			if($perc > $cap)
				$perc = $cap;

			if($perc < ($cap * -1))
				$perc = ($cap * -1);
			*/

			//if($difesa == 0)
				//$difesa = 1;

			$sommaFinale = 0;
			
			if($difesa < 0){
			  $difesa = $difesa * -1;
			  $sommaFinale = 100; 
			  $perc = 100 / (100 + $difesa);
			  $perc = (($perc * 100) + $sommaFinale) - 300;
			  $perc = $perc * -1;
			  return $perc;
			}else{
				$perc = 100 / (100 + $difesa);
				return $perc * 100;
			}
		}

		public function getDistanceFrom(&$ta){
			$x1 = $ta->getX();
			$x2 = $this->getX();

			$y1 = $ta->getY();
			$y2 = $this->getY();

			//$this->sendMessage('('.$x1.','.$y1.')');
			//$this->sendMessage('('.$x2.','.$y2.')');

			if($this->getSottoluogoId() == $ta->getSottoluogoId()){
				$msg = round(sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2)), 2);
			}else{
				$msg = 'Non siete nello stesso luogo!';
			}
			return $msg;
		}

		public function sposta($n, $verso){
			for($i = 0; $i < $n; $i++){
				$this->muovi(1, strtoupper($verso));
			}
			$msg = $this->getNome() . ' si sposta di ' . $n . ' metri verso ' . $verso . "\n";
			return $msg;
		}

		protected $impaired = false;

		public function isImpaired(){
			return $this->impaired;
		}

		public function setImpaired($bool){
			$this->impaired = $bool;
		}

		protected $movable = true;

		public function isMovable(){
			return $this->movable;
		}

		public function setMovable($bool){
			$this->movable = $bool;
		}

		public function canMove($bool = null){
			if($bool !== null)
				$this->movable = $bool;
			else
				return $this->movable;
		}

		public function canCast($bool = null){
			if($bool !== null)
				$this->impaired = !$bool;
			else
				return $this->impaired;
		}

		public function overtimeBuff(Danno &$Danno){
			$OTS = $this->getOverTimes();
			$n = count($OTS);
			for($i = 0; $i < $n; $i++){
				$OTS->buff($Danno);
			}
		}

		public function randomMovement(){
			$dir = array('NORD', 'SUD', 'OVEST', 'EST');
			$n = count($dir);
			$direzione = $dir[rand(0,$n-1)];
			$this->muovi(1, $direzione);
		}

		public function goToSamePositionOf(&$Target){
			$this->setX($Target->getX());
			$this->setY($Target->getY());
		}

		public function intimidisce($Target){

		}

		public function vieneIntimidito($Target){

		}

		public function isUtente(){
			if($this->getEntitaId() == 0)
				return true;
			else
				return false;
		}

		public function isMob(){
			if($this->getEntitaId() == 1)
				return true;
			else
				return false;
		}

		public function hasTipoOvertime($tipoOvertimeId){
			$sql = "SELECT COUNT(*) AS C FROM BOT_RPG_OVERTIME WHERE TARGET_ID = ".$this->getId()." AND ENTITA_ID = ".$this->getEntitaId()." AND NUM_TURNI > 0 AND TIPO_OVERTIME_ID = $tipoOvertimeId";
			$res = Database()->query($sql);
			$row = $res->fetch_object();
			if($row->C > 0) return true;
			else return false;
		}

		public function spaventarsi(&$Target){
			$val = -10;
			$turni = 6;
			$this->giveBuff('ARMATURA', $val, $turni);
			$this->giveBuff('COSTITUZIONE', $val, $turni);
			$this->giveBuff('DESTREZZA', $val, $turni);
		}

		public function getTargetsOfCategoriaInRange($catId, $range = 999){
			$TarCat = array();
			$Targs = $this->getTargetsInRange($range);
			$n = count($Targs);
			for($i = 0; $i < $n; $i++){
				if($Targs[$i]->getCategoria() == $catId)
					$TarCat[] = &$Targs[$i];
			}

			return $TarCat;
		}

		public function test(){
			return 'dentro creatura';
		}


	}
