<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\StocksModel;

class Stocks extends BaseController
{
    private $sessao;
    //    private $success = '';
    public function __construct()
    {
        $this->sessao = session();
    }
    //----------------------------------------------------------
    public function index()
    {
        echo view('stocks/main');
    }
    //----------------------------------------------------------
    // ==================================================
    // FAMILIAS
    // ==================================================
    public function familias()
    {
        // carregar os dados das famílias para passar para a view
        $model = new StocksModel();
        $data['familias'] = $model->get_all_families();
        // if ($this->success != '') {
        //     echo $this->success;
        //     exit();
        //     $data['success'] = $this->success;
        //     $this->success = '';
        // }

        // echo '<pre>';
        // print_r($data);
        // print_r($data['success']);
        // echo '</pre>';
        // die();
        echo view('stocks/familias', $data);
    }
    //----------------------------------------------------------
    // ==================================================
    public function familia_adicionar()
    {
        //adicionar nova familia

        //  echo 'adicionar familia';
        //  return;

        // // adicionar nova família

        $model = new StocksModel();
        $data['familias'] = $model->get_all_families();
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // vamos buscar os dados submetidos pelo formulário
            $request = \Config\Services::request();
            $id_parent = $request->getpost('select_parent');
            $designacao = $request->getpost('text_designacao');
            //USANDO O HELPER ABAIXO            
            //FIM DE USANDO HELPER            
            //       }
            // verificar se já existe a família com mesmo nome
            $resultado = $model->check_family($request->getPost('text_designacao'));
            if ($resultado) {
                $error = 'Já existe uma família com a mesma designação';
            }
            // helper('funcoes');
            // teste();
            // verRow($resultado);
            // verSessao();
            // exit();

            // guardar a nova família na base de dados
            if ($error == '') {
                $model->family_add();
                $data['success'] =  "Família adicionada com sucesso.";
                // echo 'aiaiai';
                // echo $this->success;
                // exit();
                $data['familias'] = $model->get_all_families();
                // echo '<pre>';
                // print_r($data);
                // echo '</pre>';
                // die();
                echo view('stocks/familias_adicionar', $data);
                return;

                // return redirect()->to(site_url('stocks/familias'));
            } else {
                $data['error'] = $error;
            }
        }

        echo view('stocks/familias_adicionar', $data);
    }
    //--------------------------------------------------------------------
    public function familia_editar($id_familia)
    {

        $get = true;
        $data = array();
        $fam = array();
        $fams = array();
        $error = '';
        //foi submissão?
        $model = new StocksModel();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //trata alteração
            $get = false;
            $request = \Config\Services::request();
            $dados = $request->getPost();


            //verificação dos dados
            $fam[0]['id_familia'] = $dados['txt_id_familia'];
            $fam[0]['ancestral'] = $dados['select_parent'];
            $fam[0]['designacao'] = $dados['text_designacao'];
            $fams = $_SESSION['fams'];
            $resultado = $model->check_family($request->getPost('text_designacao'));
            //    echo '<pre>';
            //          print_r($resultado);
            //           echo '</pre>';
           //        die();
            if (count($resultado) > 0) {
                if ($resultado[0]['id_familia'] != $fam[0]['id_familia']) {
                    $error = 'Já existe uma família com a mesma designação';
                    //   echo $error;
                    //die();
                    // echo $resultado[0]['id_familia'];
                    // echo '<br>';
                    // echo $fam[0]['id_familia'];
                    //   echo '<pre>';
                    // print_r($resultado);
                    //  echo '</pre>';
                   //  die();
                }
         }
            if ($error == '') {
                $model->update_family();
                //             return redirect()->to(site_url('stocks/familias'));
                $data['success'] =  "Família atualizada com sucesso.";
                $data['familias'] = $fams;
                $data['familia'] = $fam[0];

                echo view('stocks/familias', $data);
                return;
            }
        }
        if ($get) {
            $fams = $model->get_all_families();
            $fam = $model->get_family($id_familia);
            for ($i = 0; $i < count($fams); $i++) {
                if ($fams[$i]['id_familia'] == $fam[0]['id_parent']) {
                    $fams[$i]['selected'] = "selected";
                } else {
                    $fams[$i]['selected'] = "";
                }
            }
            $_SESSION['fams'] = $fams;

            // foreach ($fams as $f) {
            //     if ($f['id_familia'] == $fam[0]['id_parent']){
            //         $fams['selected'] = "selected";
            //         // $f['selected'] = "selected";

            //     } else{
            //         $fams['selected'] = " ";
            //         // $f['selected'] = " ";


            //     }
            // echo '<pre>';
            // print_r($fams);
            //  echo '</pre>';
            //  die();


            //                 echo '<pre>';
            //                 print_r($fams);
            //  //               print_r($temp);
            //                  echo '</pre>';
            //                die();

            if (count($fam) == 0) {

                return redirect()->to(site_url('/stocks/familias'));
            }
        }
        $data['familias'] = $fams;
        $data['familia'] = $fam[0];
        if ($error != '') {
            $data['error'] = $error;
        }



        echo view('stocks/familias_editar', $data);
    }



    public function movimentos()
    {
        echo view('stocks/movimentos');
    }
    //----------------------------------------------------------

    public function produtos()
    {
        echo view('stocks/produtos');
    }
    //----------------------------------------------------------

    public function taxas()
    {
        echo view('stocks/taxas');
    }
    // private function verDados($array)
    // {
    //     echo '<pre>';
    //     foreach ($array as $key => $value) {
    //         echo "<p> $key => $value</p>";
    //     }
    //     echo '</pre>';

    //     exit();
    // }
}
