<?php

namespace App\Models;

use CodeIgniter\Model;

class StocksModel extends Model
{
    protected $db;

    // ===========================================
    // familias
    // ===========================================
    public function __construct()
    {
        $this->db = db_connect();
    }

    // ===========================================
    public function get_all_families()
    {

        // returns all families
        // return $this->query("SELECT * FROM stock_familias")->getResult('array');
        return $this->query('
    
            SELECT a.*, b.designacao AS ancestral
            FROM stock_familias a LEFT JOIN stock_familias b
            ON a.id_parent = b.id_familia
    
            ')->getResult('array');
    }
    //----------------------------------------------------------
    public function check_family($designacao)
    {
        //verifica se o ID tem este email
        $params = array(
            $designacao
        );
        $query = "select id_familia from stock_familias where designacao = ?";
        return $this->db->query($query, $params)->getResult('array');
    }
    //----------------------------------------------------------
    public function family_add()
    {
        $request = \Config\Services::request();
        $params = array(
            $request->getPost('select_parent'),

            $request->getPost('text_designacao'),
        );
        $this->db->query("insert into stock_familias(id_parent, designacao) values(?,?)", $params);
    }
    //----------------------------------------------------------
    public function get_family($id_familia)
    {
        //pegar o ID na tabela
        $params = array($id_familia);
        $query = "select * from stock_familias where id_familia = ?";
        return $this->db->query($query, $params)->getResult('array');
    }
    //----------------------------------------------------------
    public function update_family()
    {
        $request = \Config\Services::request();
        $dados = $request->getPost();
        //trabalha profile
        $params = array(
            $dados['select_parent'],
            $dados['text_designacao'],

            $dados['txt_id_familia']
        );
        return  $this->db->query("update stock_familias set id_parent = ?, designacao = ? where id_familia = ?", $params);

        //     echo $this->db->affectedRows();
        //     echo $this->db->connId;

        //  $r = (array) $ret;
        //    $rr = (array) $r['connID'];
        //         echo '<pre>';
        //      print_r($ret->resultID);
        //   //      print_r($ret[]->connId);

        // $ret->connId;
        //   print_r($ret);
        //     //  print_r($r['resultObject']);
        //     //  print_r($r['connID']);
        //     //  print_r($rr);


        //    //  print_r($rr);

        //         echo '</pre>';
        //         exit();
    }



    //+++++++++++++++++++++++teste+++++++++++++++++++++
    public function teste()
    {

        // returns all families
        //    return $this->query("SELECT designacao, COALESCE(teste, 1)/100 * 50  FROM stock_familias ")->getResult('array');
        return $this->query("SELECT designacao, (ISNULL(teste,1.00)/100.00) * 50  FROM stock_familias ")->getResult('array');
    }
}
