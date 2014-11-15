<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class interetsAnnuels extends ORM {

        public $primary_key = 'NrAdhesion';
        public $table       = 'interetsAnnuels';

        function _init()
        {
                self::$fields = array(
                      
   'Dated'          => ORM::field('char[255]'), 
  'NrAdhesion'     => ORM::field('char[255]'), 
  'Noms'           => ORM::field('char[255]'), 
  'Institution'    => ORM::field('char[255]'), 
  'Taux'           => ORM::field('char[255]'), 
  'Epargne'        => ORM::field('char[255]'), 
  'Interets'       => ORM::field('char[255]'), 
  'Annee'          => ORM::field('char[255]'),  
                );
        }
    public function all_interetsAnnuels()
        {
               return $this->db->count_all_results('interetsAnnuels');      
        }
}

 