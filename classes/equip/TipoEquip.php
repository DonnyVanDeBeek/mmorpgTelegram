<?php
    class TipoEquip{
        protected $tipoEquipId;
        protected $tipoEquipNome;
        protected $tipoEquipDescrizione;
        protected $tipoEquipCategoriaId;
        protected $tipoEquipImgpath;

        private $tableName = 'BOT_RPG_TIPO_EQUIP';

        protected $utente;

        protected $msg = array();

        private $db;

        public function __construct($id){
            global $con;
            $this->db = $con->getDB();

            $q = "SELECT * FROM BOT_RPG_TIPO_EQUIP WHERE TIPO_EQUIP_ID = ".$id;
            $res = $this->db->query($q);
            $row = $res->fetch_object();

            $this->tipoEquipId          = $row->TIPO_EQUIP_ID;
            $this->tipoEquipNome        = $row->TIPO_EQUIP_NOME;
            $this->tipoEquipDescrizione = $row->TIPO_EQUIP_DESC;
            $this->tipoEquipCategoriaId = $row->TIPO_EQUIP_CATEGORIA_EQUIP_ID;
            $this->tipoEquipImgpath     = $row->TIPO_EQUIP_IMGPATH;
        }

        public function getMsg($name){
            return $this->msg[$name];
        }

        public function getTipoEquipId(){
            return $this->tipoEquipId;
        }

        public function getTipoEquipNome(){
            return $this->tipoEquipNome;
        }

        public function getTipoEquipDescrizione(){
            return $this->tipoEquipDescrizione;
        }

        public function getTipoEquipCategoriaId(){
            return $this->tipoEquipCategoriaId;
        }

        public function getTipoEquipImgpath(){
            return $this->tipoEquipImgpath;
        }

        public function getParteDelCorpoData(){
            $sql = "
                SELECT PDC.PARTE_DEL_CORPO_ID, PDC.PARTE_DEL_CORPO_NOME, QUANTITA FROM BOT_RPG_CATEGORIA_EQUIP CE, BOT_RPG_PARTE_DEL_CORPO_CATEGORIA_EQUIP PDCCE, BOT_RPG_PARTE_DEL_CORPO PDC
                WHERE CE.CATEGORIA_EQUIP_ID = PDCCE.CATEGORIA_EQUIP_ID
                AND PDCCE.PARTE_DEL_CORPO_ID = PDC.PARTE_DEL_CORPO_ID
                AND CE.CATEGORIA_EQUIP_ID = ".$this->getTipoEquipCategoriaId();
            $res = Database()->query($sql);
            $row = $res->fetch_object();
            $data = array(
                'ID'        => $row->PARTE_DEL_CORPO_ID,
                'NOME'      => $row->NOME,
                'QUANTITA'  => $row->QUANTITA
            );
            return $data;
        }

        public function printStats(){
            $sql = "SELECT * FROM BOT_RPG_STAT_TIPO_EQUIP WHERE TIPO_EQUIP_ID = ".$this->getTipoEquipId();
            $res = Database()->query($sql);
            $msg = '';
            while($row = $res->fetch_object()){
                $Stat = new Stat($row->STAT_ID);
                $msg .= getEmojiStats()[strtoupper($Stat->getStatNome())].$Stat->getStatNome() . ' ' . $row->VALUE . "\n";
            }

            return $msg;
        }

        public function printStatsBrowser(){
            $sql = "SELECT * FROM BOT_RPG_STAT_TIPO_EQUIP WHERE TIPO_EQUIP_ID = ".$this->getTipoEquipId();
            $res = Database()->query($sql);
            $msg = '';
            while($row = $res->fetch_object()){
                $Stat = new Stat($row->STAT_ID);
                $msg .= $Stat->getStatNome() . ' ' . $row->VALUE . "\n";
            }

            return $msg;
        }

        protected $stats = array();

        public function loadStats(){
            if(count($this->stats) > 0)
                return true;

            $i = 0;
            $sql = "SELECT STAT_ID, VALUE FROM BOT_RPG_STAT_TIPO_EQUIP WHERE TIPO_EQUIP_ID = ".$this->getTipoEquipId();
            $res = Database()->query($sql);
            while($row = $res->fetch_object()){
                $this->stats[$row->ID] = $row->VALUE;
            }
        }

        public function getTipoEquipStat($id){
            $this->loadStats();

            return $this->stats[$id];
        }

        public function getTipoEquipCategoriaNome(){
            $sql = "SELECT CATEGORIA_EQUIP_NOME FROM BOT_RPG_CATEGORIA_EQUIP WHERE CATEGORIA_EQUIP_ID = ".$this->getTipoEquipCategoriaId();
            return Database()->query($sql)->fetch_object()->CATEGORIA_EQUIP_NOME;
        }

        public function getMultiDimensionalArrayCraftData(){
            $id = $this->getTipoEquipId();
            $data = array();
            $i = 0;
            $sql = "
                SELECT CRAFT_TIPO_ITEM_ID, CRAFT_QUANTITA, TIPO_ITEM_NOME
                FROM BOT_RPG_CRAFT_TIPO_EQUIP, BOT_RPG_TIPO_ITEM
                WHERE CRAFT_TIPO_ITEM_ID = TIPO_ITEM_ID 
                AND CRAFT_TIPO_EQUIP_ID = $id";
            $res = Database()->query($sql);
            while($row = $res->fetch_object()){
                $data[$i]['QUANTITA']       = $row->CRAFT_QUANTITA;
                $data[$i]['TIPO_ITEM_ID']   = $row->CRAFT_TIPO_ITEM_ID;
                $data[$i]['TIPO_ITEM_NOME'] = $row->TIPO_ITEM_NOME;
                $i++;
            }

            return $data;
        }

        public function printCraftingItems(){
            $msg = '';
            $msg .= '<b>'.$this->getTipoEquipNome().'</b>'."\n";
            $msg .= '<i>'.$this->printStats().'</i>'."\n";

            $msg .= '<b>Categoria:</b>'."\n";
            $msg .= '<i>'.$this->getTipoEquipCategoriaNome().'</i>'."\n\n";

            $msg .= '<b>Descrizione:</b>'."\n";
            $msg .= '<i>'.$this->getTipoEquipDescrizione().'</i>'."\n\n";

            $msg .= '<b>Ricetta:</b>'."\n";

            $arr = $this->getMultiDimensionalArrayCraftData();
            $n = count($arr);
            for($i = 0; $i < $n; $i++){
                $msg .= '><i>'.$arr[$i]['TIPO_ITEM_NOME']."</i> x".$arr[$i]['QUANTITA']."\n";
            }

            write($msg);
        }


    }
