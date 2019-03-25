<?php
	Class Arciere extends Utente{
		
		public function __construct($UTENTE_ID){
			parent::__construct($UTENTE_ID);
		}
		
		public function useSkill($skill, $target){
			switch($skill){
				
				default:
					return 'Skill sconosciuta';
			}
		}
		
		//Skills
		
	}