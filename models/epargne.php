<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class Epargne extends ORM {

        public $primary_key = 'EpargneID';
        public $table       = 'epargne';

        function _init()
        {
                self::$fields = array(
                        'EpargneID'       => ORM::field('auto[255]'),      
                        'nradhesion'      => ORM::field('char[255]'),      
                        'NrDocument'      => ORM::field('char[255]'),      
                        'Dated'           => ORM::field('char[255]'),      
                        'NatureMvt'       => ORM::field('char[255]'),      
                        'TypeOperation'   => ORM::field('char[255]'),      
                        'Libelle'         => ORM::field('char[255]'),      
                        'Epargne'         => ORM::field('char[255]'),      
                        'Retrait'         => ORM::field('char[255]'),      
                        'NrCheque'        => ORM::field('char[255]'),      
                        'Banque'          => ORM::field('char[255]'),      
                        'NrCompteDebit1'  => ORM::field('char[255]'),      
                        'NrCompteDebit2'  => ORM::field('char[255]'),      
                        'NrCompteCredit1' => ORM::field('char[255]'),      
                        'NrCompteCredit2' => ORM::field('char[255]'),      
                        'IntituleDebit1'  => ORM::field('char[255]'),      
                        'IntituleDebit2'  => ORM::field('char[255]'),      
                        'IntituleCredit1' => ORM::field('char[255]'),      
                        'IntituleCredit2' => ORM::field('char[255]'),      
                        'MontantDebit1'   => ORM::field('char[255]'),      
                        'MontantCredit1'  => ORM::field('char[255]'),      
                        'MontantDebit2'   => ORM::field('char[255]'),      
                        'MontantCredit2'  => ORM::field('char[255]'),      
                        'Operateur'       => ORM::field('char[255]'),      
                        'Timed'           => ORM::field('char[255]'),      
                );
        }


 /**
 *
 */
 public function get_by_column($column_name,$column_value=null,$somme=false)
 {
    if($somme==true)
    {
        $this->db->select_sum('Epargne');
    }
    $this->db->where($column_name,$column_value);
    return $this->db->get('epargne')->result();
 }
}

     
         