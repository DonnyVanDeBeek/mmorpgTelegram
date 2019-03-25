<?php
	Class Herobrine extends Mob{
		private $target;

		public function __construct($id){
			parent::__construct($id);
		}

		public function useSkill($target){
			$this->target = $target;
			$arrSkill = array(0, 1);
			return $this->{'s_'.rand(0,count($arrSkill) - 1)}();
		}

		public function subisciDanno(Danno $da){
			$msg = '';
			$perc = log($this->getTotalStat('COSTITUZIONE'), 300000) * 100;
			if($perc > 90) $perc = 90;
			$dmg = intVal($dmg * ((100 - $perc) / 100));
			if($dmg < 0) $dmg = 1;
			$msg .= $dealer->getNome() . ' ha inflitto ' . $dmg . ' a ' . $this->getNome() . '!' . "\n";
			//$dealer->sendMessage($msg);
			$this->setMobHp($this->getMobHp() - $dmg);

			$od = $this->getTotalStat('DESTREZZA');
			$dd = $dealer->getTotalStat('DESTREZZA');
			if(rand(0, $od) > 1){
				$msg .= $this->getNome() . ': ho vinto il duello di destrezza contro ' . $dealer->getNome() . ' eheh!' . "\n";
				//$dealer->sendMessage($msg);
			}

			return $msg;

		}

		public function s_0(){
			//Colpo alla testa
			$msg = '';
			$tes = '';
			$fo = $this->getTotalStat('FORZA');
			if(rand(0, 100) > 50){
				$dmg = rand($fo * 1.5, $fo * 1.9);
				$tes .= 'Mira alla testa!';
			}
			else
				$dmg = rand($fo * 0.6, $fo * 0.9);
			$msg .= $this->getNome() . ' cerca di colpire ' . $this->target->getNome() . ' '. $tes . "\n";
			//$this->target->sendMessage($msg);
			$msg .= $this->target->subisciDanno($this, intVal($dmg));
			return $msg;
		}

		public function s_1(){
			//Colpo alla cieca
			$msg = '';
			$msg = $this->getNome() . ' inizia a menare colpi alla cieca!' . "\n";
			//$this->target->sendMessage($msg);
			$colpi = rand(1, 10);
			$dmg = intVal(rand($this->getTotalStat('FORZA') * 0.1, $this->getTotalStat('FORZA') * 0.5));
			for($i = 0; $i < $colpi; $i++){
				$r = rand(0, 1);
				if($r == 0){
					$msg .= $this->getNome() . ' colpisce ' . $this->target->getNome() . "!\n";
					//$this->target->sendMessage($msg);
					$msg .= $this->target->subisciDanno($this, $dmg);
				}else{
					$msg .= $this->getNome() . ' si colpisce da solo!' . "\n";
					//$this->target->sendMessage();
					$msg .= $this->subisciDanno($this, $dmg);
				}
			}

			return $msg;
		}



	}
