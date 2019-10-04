<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CriptoModel;

class Cripto extends BaseController
{
    private $sessao;
    public function __construct()
    {
        $this->sessao = session();
    }
    public function index()
    {
        echo 'estou no cripo';
        // if ($this->check_sessao()) {
        //     //echo 'sessão ativa';
        //     $this->homePage();
        // } else {
        //     $this->login();
        // }
    }
    //------------------------------------------------------------------------
    public function guardaCartao(){
        $numero_cartao = '5480451111111199';
        $model = new CriptoModel();
        $model->encriptar($numero_cartao);
        echo 'cartao encriptado';

    }
    //------------------------------------------------------------------------
    public function apresentarCartao($id=1){
        $model = new CriptoModel();
        $resultado = $model->desencriptar($id);
        echo '<pre>';
        print_r($resultado);
        echo '</pre>';


    }
    
    //------------------------------------------------------------------------
    public function procurarCartao($cartao='xxxxxxxx123456ab'){
        $model = new CriptoModel();
        $resultado = $model->procurar($cartao);
        exit();
        echo '<pre>';
        print_r($resultado);
        echo '</pre>';


    }
//------------------------------------------------------------------------
public function teste($cartao='aaaaa123456ab'){
    $model = new CriptoModel();
    $resultado = $model->enc($cartao);
    exit();
    echo '<pre>';
    print_r($resultado);
    echo '</pre>';


}

}