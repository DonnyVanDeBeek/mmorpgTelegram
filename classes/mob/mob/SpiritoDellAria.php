<?php
	Class SpiritoDellAria extends Mob{
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
			if(rand(0, 10) > 7){
				$msg .= $this->getNome() . ': "Ti è andata male, sono fatto d\'aria, sono difficile da colpire! Beccati questo!"' . "\n";
				//$dealer->sendMessage($msg);
				$msg .= $dealer->subisciDanno($this, $this->getTotalStat('FORZA') * 0.3);
				return $msg;
			}

			$perc = log($this->getTotalStat('COSTITUZIONE'), 300000) * 100;
			if($perc > 90) $perc = 90;
			$dmg = intVal($dmg * ((100 - $perc) / 100));
			if($dmg < 0) $dmg = 1;
			$msg .= $dealer->getNome() . ' ha inflitto ' . $dmg . ' a ' . $this->getNome() . '!' . "\n";
			//$dealer->sendMessage($msg);
			$this->setMobHp($this->getMobHp() - $dmg);

			return $msg;
		}

		public function s_0(){
			$msg = '';
			//Morso
			$msg .= $this->getNome() . ' soffia contro ' . $this->target->getNome() . '!' . "\n";
			//$this->target->sendMessage($msg);
			$lf = $this->getTotalStat('FORZA');
			$dmg = intVal(rand($lf * 0.5, $lf * 1.3));
			$msg .= $this->target->subisciDanno($this, $dmg);
			return $msg;
		}

		public function s_1(){
			//Graffio
			$msg = '';
			$msg .= $this->getNome() . ' colpisce ' . $this->target->getNome() . '!' . "\n";
			//$this->target->sendMessage($msg);
			$lf = $this->getTotalStat('FORZA');
			$dmg = intVal(rand($lf * 0.1, $lf * 2.5));
			$msg .= $this->target->subisciDanno($this, $dmg);
			return $msg;
		}
	}
