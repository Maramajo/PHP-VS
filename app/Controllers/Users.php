<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsersModel;

class Users extends BaseController
{
    private $sessao;
    public function __construct()
    {
        $this->sessao = session();
    }
    public function index()
    {
        if ($this->check_sessao()) {
            //echo 'sessão ativa';
            $this->homePage();
        } else {
            $this->login();
        }
    }

    public function login()
    {

        if ($this->check_sessao()) {
            //Se existe sessão, vai para a página inicial homePage
            $this->homePage();
            return;
        }

        $error = "";
        $data = array();
        $request = \Config\Services::request();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $username = $request->getPost('text_username');
            $password = $request->getPost('text_password');

            if ($username == '' || $password == '') {
                $error = "preencha os campos corretamente";
            }
            //check database
            if ($error == '') {
                $model = new UsersModel();
                $result = $model->verifyLogin($username, $password);
                if (is_array($result)) {
                    $this->setSession($result);
                    $this->homePage();
                    return;
                } else {
                    //login inválido
                    //echo 'Not OK';
                    $error = 'Login inválido';
                    //echo $error;
                }
                //  exit();
            }
        }

        if ($error != '') {
            $data['error'] = $error;
        }
        echo view('users/login', $data);
    }


    //--------------------------------------------------------------------
    private function setSession($data)
    {
        //define session
        $session_data = array(
            'id_user' => $data['id_user'],
            'name' => $data['name'],
            'profile' => $data['profile']
        );

        $this->sessao->set($session_data);
    }
    //--------------------------------------------------------------------
    public function homePage()
    {
        //verifica se a sessão existe
        if (!$this->check_sessao()) {
            $this->login();
            return;
        }
        //verifica a profile
        $data = array();
        if ($this->check_profile('admin')) {
            $data['admin'] = true;
        }
        // else {
        //     echo 'não sou admin';
        // }


        // mostra a página Home
        echo view('users\homepage', $data);
    }

    //--------------------------------------------------------------------
    public function logout()
    {
        //logout
        $this->sessao->destroy();
        // $this->index();
        return redirect()->to(site_url('users'));
    }
    //--------------------------------------------------------------------

    private function check_sessao()
    {
        return $this->sessao->has('id_user');
    }
    //--------------------------------------------------------------------

    private function check_profile($profile)
    {
        //verifica se o ID é administrador
        if (preg_match("/$profile/", $this->sessao->profile)) {
            return true;
        } else {
            return false;
        }
    }
    //--------------------------------------------------------------------
    public function Op1()
    {
        echo 'op1';
    }
    //--------------------------------------------------------------------
    public function Op2()
    {
        echo 'op2';
    }


    //--------------------------------------------------------------------
    public function admin_users()
    {
        if (!$this->check_sessao()) {
            //Se não existe sessão, vai para a página inicial homePage
            $this->homePage();
            return;
        }

        if ($this->check_profile('admin') == false) {
            return redirect()->to(site_url('users'));
            echo 'não existe';
        }
        $users = new UsersModel();
        $results = $users->getUsers();
        //busca lista de IDs registrados e mostra em uma tabela da view
        $data['users'] = $results;

        echo view('users/admin_users', $data);
    }
    //--------------------------------------------------------------------
    public function admin_new_user()
    {
        if (!$this->check_sessao()) {
            //Se não existe sessão, vai para a página inicial homePage
            $this->homePage();
            return;
        }

        if ($this->check_profile('admin') == false) {
            return redirect()->to(site_url('users'));
        }
        //adiciona 1 elemento à base de dados
        $error = "";
        $data = array();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $request = \Config\Services::request();
            $dados = $request->getPost();
            //verificação dos dados
            if (
                $dados['text_username'] == "" ||
                $dados['text_password'] == "" ||
                $dados['text_password_repetir'] == "" ||
                $dados['text_email'] == "" ||
                $dados['text_name'] == ""
            ) {
                $error = "preencha todos os campos";
            }

            //verifica password
            if ($error == '') {
                if ($dados['text_password'] != $dados['text_password_repetir']) {
                    $error = "As senhas digitadas não conferem";
                }
            }
            //verifica check-box
            if (
                !isset($dados['check_admin']) &&
                !isset($dados['check_moderator']) &&
                !isset($dados['check_user'])
            ) {
                $error = "Check um perfil";
            }
            //verifica se já existe nome/email na base de dados
            $model = new UsersModel();
            $result = $model->checkExistingUser();
            if (count($result) != 0) {
                $error = "Já existe nome/usuário/email na base";
            }
            if ($error == "") {
                $model = new UsersModel();
                $model->addNewUser();
                return redirect()->to(site_url('users/admin_users'));
            }
        }
        if ($error != '') {
            $data['error'] = $error;
        }
        echo view('users/admin_new_user', $data);
    }
    //--------------------------------------------------------------------
    public function admin_edit_user($id_user)
    {
        if (!$this->check_sessao()) {
            //Se não existe sessão, vai para a página inicial homePage
            $this->homePage();
            return;
        }

        if ($this->check_profile('admin') == false) {
            return redirect()->to(site_url('users'));
        }
        if ($id_user == $this->sessao->id_user){
            return redirect()->to(site_url('users'));
        }

        $get = true;
        $data = array();
        $user[] = array(
            'id_user' => "",
            'username' => "",
            'name' => "",
            'email' => "",
            'profile' => ",,,"
        );
        $error = '';
        //foi submissão?
        $users = new UsersModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //trata alteração
            $get = false;
            $request = \Config\Services::request();
            $dados = $request->getPost();

            //verificação dos dados
            $user[0]['email'] = $dados['text_email'];
            $user[0]['username'] = $dados['text_username'];
            $user[0]['name'] = $dados['text_name'];
            $user[0]['id_user'] = $id_user;

            if (
                $dados['text_email'] == "" ||
                $dados['text_name'] == ""
            ) {
                $error = "preencha todos os campos";
            }
            //verifica check-box
            $profiletemp = array('', '', '');
            if (isset($dados['check_admin'])) {
                array_push($profiletemp, 'admin');
            }
            if (isset($dados['check_moderator'])) {
                array_push($profiletemp, 'moderator');
            }
            if (isset($dados['check_user'])) {
                array_push($profiletemp, 'user');
            }
            $profile = implode(',', $profiletemp);
            $user[0]['profile'] = $profile;
            if (
                !isset($dados['check_admin']) &&
                !isset($dados['check_moderator']) &&
                !isset($dados['check_user'])
            ) {
                $error = "Check um perfil";
            }
            if ($error == '') {
                $temp = $users->checkExistingEmail($dados['id_user']);
                if (count($temp) != 0) {
                    $error = "Já existe email na base";
                }
            }
            $data['error'] = $error;

            if ($error == '') {
                $users->updateUser();
                return redirect()->to(site_url('users/admin_users'));
            }
        }
        if ($get) {
            $user = $users->getUser($id_user);

            if (count($user) == 0 || $user[0]['id_user'] == $this->sessao->id_user) {

                return redirect()->to(site_url('/users/admin_users'));
            }
        }
        $data['user'] = $user[0];
        echo view('users/admin_edit_user', $data);
    }
    //--------------------------------------------------------------------
    public function admin_delete_user($id_user)
    {
        if (!$this->check_sessao()) {
            //Se não existe sessão, vai para a página inicial homePage
            $this->homePage();
            return;
        }

        if ($this->check_profile('admin') == false) {
            return redirect()->to(site_url('users'));
        }
        if ($id_user == $this->sessao->id_user){
            return redirect()->to(site_url('users'));
        }



        // echo $id_user;
        // exit();
        $get = true;
        $data = array();
        $user[] = array(
            'id_user' => "",
            'username' => "",
            'name' => "",
            'email' => "",
            'profile' => ",,,"
        );
        $error = '';
        //foi submissão?
        $users = new UsersModel();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //trata deleção
            // echo $id_user;
            // echo 'after posting';
            // exit();
            $get = false;
            $request = \Config\Services::request();
            $dados = $request->getPost();

            //verificação dos dados
            $user[0]['email'] = $dados['text_email'];
            $user[0]['username'] = $dados['text_username'];
            $user[0]['name'] = $dados['text_name'];
            $user[0]['id_user'] = $id_user;

            // if (
            //     $dados['text_email'] == "" ||
            //     $dados['text_name'] == ""
            // ) {
            //     $error = "preencha todos os campos";
            // }
            // //verifica check-box
            // $profiletemp = array('', '', '');
            // if (isset($dados['check_admin'])) {
            //     array_push($profiletemp, 'admin');
            // }
            // if (isset($dados['check_moderator'])) {
            //     array_push($profiletemp, 'moderator');
            // }
            // if (isset($dados['check_user'])) {
            //     array_push($profiletemp, 'user');
            // }
            // $profile = implode(',', $profiletemp);
            // $user[0]['profile'] = $profile;
            // if (
            //     !isset($dados['check_admin']) &&
            //     !isset($dados['check_moderator']) &&
            //     !isset($dados['check_user'])
            // ) {
            //     $error = "Check um perfil";
            // }
            // if ($error == '') {
            //     $temp = $users->checkExistingEmail($dados['id_user']);
            //     if (count($temp) != 0) {
            //         $error = "Já existe email na base";
            //     }
            // }
            // $data['error'] = $error;

            // if ($error == '') {
            $users->deleteUser();
            return redirect()->to(site_url('users/admin_users'));
            // }
        }
        if ($get) {
            $user = $users->getUser($id_user);

            if (count($user) == 0 || $user[0]['id_user'] == $this->sessao->id_user) {

                return redirect()->to(site_url('/users/admin_users'));
            }
        }
        $data['user'] = $user[0];
        echo view('users/admin_delete_user', $data);
    }
        //--------------------------------------------------------------------
        public function admin_recover_user($id_user)
        {
            if (!$this->check_sessao()) {
                //Se não existe sessão, vai para a página inicial homePage
                $this->homePage();
                return;
            }
    
            if ($this->check_profile('admin') == false) {
                return redirect()->to(site_url('users'));
            }
            if ($id_user == $this->sessao->id_user){
                return redirect()->to(site_url('users'));
            }
    
    
            // echo $id_user;
            // exit();
            $get = true;
            $data = array();
            $user[] = array(
                'id_user' => "",
                'username' => "",
                'name' => "",
                'email' => "",
                'profile' => ",,,"
            );
            $error = '';
            //foi submissão?
            $users = new UsersModel();
    
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $get = false;
                $request = \Config\Services::request();
                $dados = $request->getPost();
    
                //verificação dos dados
                $user[0]['email'] = $dados['text_email'];
                $user[0]['username'] = $dados['text_username'];
                $user[0]['name'] = $dados['text_name'];
                $user[0]['id_user'] = $id_user;
                $users->recoverUser();
                return redirect()->to(site_url('users/admin_users'));
            }
            if ($get) {
                $user = $users->getUser($id_user);
    
                if (count($user) == 0 || $user[0]['id_user'] == $this->sessao->id_user) {
    
                    return redirect()->to(site_url('/users/admin_users'));
                }
            }
            $data['user'] = $user[0];
            echo view('users/admin_recover_user', $data);
        }
    

    public function recover()
    {
        // mostra formulário para recuperação da senha
        echo view('users/recover_password');
    }
    //--------------------------------------------------------------------
    public function reset_password()
    {
        //  MÉTODO 1))))))))))))))))))))))))))))))))))))
        //reset senha
        // $request = \Config\Services::request();
        // $email = $request->getPost('text_email');
        // //verifica se há usuário com esse email
        // $users = new UsersModel();
        // $users->resetPassword($email);
        //FIM MÉTODO 1 )))))))))))))))))))))))))))))))))

        //MÉTODO 2 ===================================
        $request = \Config\Services::request();
        $email = $request->getPost('text_email');
        $users = new UsersModel();
        //checa email método 2
        $result = ($users->checkEmail($email));
        if (count($result) != 0) {
            //existe email  
            //PURL = personnal URL 
            $users->sendPulr($email, $result[0]['id_user']);
            echo 'existe email';
        } else {
            //não existe email
            echo 'email não é do ID';
        }
    }
    //--------------------------------------------------------------------
    public function redefine_password($purl)
    {
        $users = new UsersModel();
        $results = ($users->getPurl($purl));
        if (count($results) != 0) {
            //existe purl  
            //PURL = personnal URL 
            //      $users->sendPulr($email, $result[0]['id_user']);
            //   echo 'existe purl';
            //die("existe purl");
            $data['user'] = $results[0];

            echo view('users/redefine_password', $data);
        } else {
            //não existe purl   
            return redirect()->to(site_url('main'));
            //echo 'purl não é do ID';
            // die("não existe purl");
        }
    }
    //--------------------------------------------------------------------

    public function redefine_password_submit()
    {
        $request = \Config\Services::request();
        $id_user = $request->getPost('text_id_user');
        $nova_password = $request->getPost('text_nova_password');
        $nova_password_repetida = $request->getPost('text_repetir_password');
        //verifica se as senhas digitadas são iguais
        $error = '';
        if ($nova_password != $nova_password_repetida) {
            $error = "senhas não conferem";
            die($error);
        }
        if ($error == '') {
            $users = new UsersModel();
            $users->redefinePassword($id_user, $nova_password);
        }
    }
    //LIMPAR PARA DEPLOYMENT
    public function teste($value)
    {
        if ($this->check_profile($value)) {
            echo 'existe';
        } else {
            echo 'não existe';
        }
    }
}
