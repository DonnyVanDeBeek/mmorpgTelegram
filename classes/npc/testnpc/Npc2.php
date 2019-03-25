<?php
	class Npc2 extends Npc{
		private $npcId = 2;
		
		public function __construct(){
			parent::__construct($this->npcId);
		}
	}