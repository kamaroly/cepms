<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class cotisation extends ORM {

        public $primary_key = 'ID';
        public $table       = 'cotisations';

        function _init()
        {
                self::$fields = array(
  'ID'            => ORM::field('auto[255]'),
  'NrAdhesion'    => ORM::field('char[255]'), 
  'Noms'          => ORM::field('char[255]'),
  'Institution'   => ORM::field('char[255]'), 
  'Mois'          => ORM::field('char[255]'),
  'Cotisation'    => ORM::field('char[255]'),
  'Etat'          => ORM::field('char[255]'),
  'Timed'         => ORM::field('char[255]'),
  'Dated'         => ORM::field('char[255]'),     
  'NrDocument'    => ORM::field('char[255]'),    
                );
        }
    public function all_cotisation()
        {
               return $this->db->count_all_results('cotisations');      
        }
}


 