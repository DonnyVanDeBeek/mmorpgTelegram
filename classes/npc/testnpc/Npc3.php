<?php
	class Npc3 extends Npc{
		private $npcId = 3;
		
		public function __construct(){
			parent::__construct($this->npcId);
		}
	}