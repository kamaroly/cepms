<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class  coution  extends ORM {

        public $primary_key = 'CoutionID';
        public $table       = 'coution';

        function _init()
        {
                self::$fields = array(
  
    'CoutionID'     => ORM::field('auto[255]'), 
    'NrContratPret' => ORM::field('char[255]'), 
    'Dated'         => ORM::field('char[255]'), 
    'NrAdhesion1'   => ORM::field('char[255]'), 
    'NrAdhesion2'   => ORM::field('char[255]'), 
    'Montant'       => ORM::field('char[255]'), 
    'Timed'         => ORM::field('char[255]'), 
    'NrDocument'    => ORM::field('char[255]'),  
                );
        }
    public function all_members()
        {
               return $this->db->count_all_results('coution');      
        }
}

 