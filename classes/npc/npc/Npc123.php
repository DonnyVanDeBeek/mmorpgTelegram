<?php
	//BARBONE TODD
	class Npc123 extends Npc{
		private $npcId = 123;

		public function __construct(){
			parent::__construct($this->npcId);
		}
	}