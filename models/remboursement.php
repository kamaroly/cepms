<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class remboursement extends ORM {

        public $primary_key = 'IDremboursement';
        public $table       = 'remboursement';

        function _init()
        {
                self::$fields = array(
                       
      'IDremboursement'   => ORM::field('auto[255]'), 
      'NrAdhesion'        => ORM::field('char[255]'), 
      'NrContratPret'     => ORM::field('char[255]'),
      'Noms'              => ORM::field('char[255]'),
      'Institution'       => ORM::field('char[255]'),
      'Mois'              => ORM::field('char[255]'),
      'TrancheMensuelle'  => ORM::field('char[255]'),
      'Timed'             => ORM::field('char[255]'),
      'NrDocument'        => ORM::field('char[255]'),
      'TrancheMens'       => ORM::field('char[255]'),   
                );
        }


 /**
 *
 */
 
 }
}


    