<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class pret extends ORM {

        public $primary_key = 'PretID';
        public $table       = 'pret';

        function _init()
        {
                self::$fields = array(
                      
  'PretID'            => ORM::field('auto[255]'),
  'NrContratPret'     => ORM::field('char[255]'), 
  'NrDocument'       => ORM::field('char[255]'),
  'NrAdhesion'       => ORM::field('char[255]'),
  'NatureMvt'        => ORM::field('char[255]'),
  'TypeOperation'    => ORM::field('char[255]'),
  'DateLettre'       => ORM::field('char[255]'),
  'Dated'            => ORM::field('char[255]'),
  'DroitAuPret'      => ORM::field('char[255]'),
  'MontantSouhait'   => ORM::field('char[255]'), 
  'PretaRemb'        => ORM::field('char[255]'),
  'Interets'         => ORM::field('char[255]'),
  'InteretsPU'       => ORM::field('char[255]'), 
  'NetaToucher'      => ORM::field('char[255]'), 
  'NbreTranches'     => ORM::field('char[255]'),
  'TrancheMensuelle' => ORM::field('char[255]'), 
  'NrCheque'         => ORM::field('char[255]'),
  'Banque'           => ORM::field('char[255]'),
  'TypeCaution'      => ORM::field('char[255]'), 
  'Cautionneur1'     => ORM::field('char[255]'), 
  'Cautionneur2'     => ORM::field('char[255]'), 
  'MoyenRemb'        => ORM::field('char[255]'),
  'MontantRemb'     => ORM::field('char[255]'),
  'Libelle'          => ORM::field('char[255]'),
  'NrContratPS'     => ORM::field('char[255]'),
  'TranchesRestante' => ORM::field('char[255]'),
  'TranchePS'        => ORM::field('char[255]'),
  'InteretsPS'       => ORM::field('char[255]'),
  'PSaToucher'       => ORM::field('char[255]'), 
  'NrCompteDebit1'   => ORM::field('char[255]'), 
  'NrCompteCredit1'  => ORM::field('char[255]'), 
  'NrCompteCredit2'  => ORM::field('char[255]'),
  'NrCompteCredit3'  => ORM::field('char[255]'),
  'IntituleDebit1'   => ORM::field('char[255]'),
  'IntituleCredit1'  => ORM::field('char[255]'),
  'IntituleCredit2'  => ORM::field('char[255]'),
  'IntituleCredit3'  => ORM::field('char[255]'), 
  'Operateur'        => ORM::field('char[255]'),
  'Timed'            => ORM::field('char[255]'),   
                );
        }
    public function all_pret()
        {
               return $this->db->count_all_results('pret');      
        }
}

  