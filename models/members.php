<?php

namespace Model;

use \Gas\Core;
use \Gas\ORM;

class members extends ORM {

        public $primary_key = 'MembreId';
        public $table       = 'membres';

        function _init()
        {
                self::$fields = array(
                        'MembreId'             => ORM::field('auto[255]'),                    
                        'NrAdhesion'           => ORM::field('char[255]'),               
                        'NrContratEpargne'     => ORM::field('char[255]'),               
                        'Noms'                 => ORM::field('char[255]'),               
                        'DateNaissance'        => ORM::field('char[255]'),               
                        'Nationalite'          => ORM::field('char[255]'),               
                        'District'             => ORM::field('char[255]'),               
                        'Province'             => ORM::field('char[255]'),               
                        'Sexe'                 => ORM::field('char[255]'),               
                        'CINr'                 => ORM::field('char[255]'),               
                        'Telephone'            => ORM::field('char[255]'),               
                        'Email'                => ORM::field('email[40]'),               
                        'DateAdhesion'         => ORM::field('char[255]'),               
                        'DateDepart'           => ORM::field('char[255]'),               
                        'Institution'          => ORM::field('char[255]'),               
                        'Service'              => ORM::field('char[255]'),               
                        'CotisationMensuelle'  => ORM::field('char[255]'),               
                        'Mandataire'           => ORM::field('char[255]'),               
                        'Photo'                => ORM::field('char[255]'),               
                        'Signature'            => ORM::field('char[255]'),               
                        'PhotoMandataire'      => ORM::field('char[255]'),               
                        'SignatureMandataire'  => ORM::field('char[255]'),               
                        'Status'               => ORM::field('char[255]'),               
                        'Timed'                => ORM::field('char[255]'),      
                );
        }
    public function all_members()
        {
               return $this->db->count_all_results('membres');      
        }

    public function get_by_nradherision($NrAdhesion){
       $this->db->where('NrAdhesion',$NrAdhesion);

       return $this->db->get('membres')->result();
    }
}

         