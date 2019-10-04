<?php

namespace App\Models;

use CodeIgniter\Model;

class CriptoModel extends Model
{
        protected $db;
        protected $method = 'AES-128-CBC';
        protected $key = 'jrCxnpedY7pKFGE8';
        protected $ke1 = 'jrzzzpedY7pKFGE8';
        public function __construct()
        {
                $this->db = db_connect();
        }
        //----------------------------------------------------------

        public function encriptar($cartao)
        {
                $encrypted = $this->enc($cartao);

                $params = array(
                        $encrypted
                );
                $query = "insert into criptografia(numero_cartao) values(?)";
                echo $query . '<br>';
                $this->db->query($query, $params);
        }
        //----------------------------------------------------------
        public function desencriptar($id)
        {

                $params = array(
                        $id
                );
                $query = "select * from criptografia where id = ? ";
                echo $query;
                echo '<br>';
                $resultado = $this->db->query($query, $params)->getResult('array');
                $decrypted = $this->dec($resultado[0]['numero_cartao']);
                exit();
                //return  $this->db->query($query, $params)->getResult('array');
        }
        //----------------------------------------------------------

        public function procurar($cartao)
        {
                $encrypted = $this->enc($cartao);
                $params = array(
                        $encrypted
                );
                $query = "select * from criptografia where numero_cartao = ?";
                $resultado = $this->db->query($query, $params)->getResult('array');
                echo '<pre>';
                print_r($resultado);
                echo '</pre>';
                echo $resultado[0]['id'];
                echo '<br>';
                echo $resultado[0]['numero_cartao'];
                //   exit();
                echo '<br>';
                echo $query;
                echo '<br>';
                $decrypted = $this->dec($resultado[0]['numero_cartao']);
                die();
        }
        //----------------------------------------------------------
        public function enc($cartao)
        {
                $encrypted = openssl_encrypt($cartao, $this->method, $this->key, 0, $this->ke1);
                echo "Encrypted: " . $encrypted;
                echo '<br>';
                return $encrypted;
        }
        //----------------------------------------------------------
        public function dec($encrypted)
        {
                $encrypted = $encrypted . ':' . base64_encode($this->ke1);
                $parts = explode(':', $encrypted);
                echo 'parte 0 :' . $parts[0];
                echo '<br>';
                echo 'parte 1 :' . $parts[1];
                echo '<br>';
                $decrypted = openssl_decrypt($parts[0], $this->method, $this->key, 0, base64_decode($parts[1]));
                echo "Decrypted: " .  $decrypted;
        }
}
