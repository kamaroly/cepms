<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class institution extends ORM {

        public $primary_key = 'InstitutionID';
        public $table       = 'institution';

        function _init()
        {
                self::$fields = array(
                      
  'InstitutionID'            => ORM::field('auto[255]'),
  'instituton'               => ORM::field('char[255]'), 
   'District'                => ORM::field('char[255]'), 
  
                );
        }
    public function all_pret()
        {
               return $this->db->count_all_results('institution');      
        }
}

  