<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
        protected $db;
        public function __construct()
        {
                $this->db = db_connect();
        }
        public function verifyLogin($username, $password)
        {
                $params = array(
                        $username,
                        md5(sha1($password)),
                        0
                );
                $query = "select * from users where username = ? and senha = ? and deleted = ?";
                $results = $this->db->query($query, $params)->getResult('array');
                //$results->array_count_values->print_r();
                //echo count($results);

                if (count($results) == 0) {
                        return false;
                } else {
                        //atualiza último login no banco de dados
                        $params = array(
                                $results[0]['id_user']
                        );
                        $this->db->query("update users set last_login = NOW() where id_user = ?", $params);
                        return $results[0];
                }
        }
        //----------------------------------------------------------
        public function resetPassword($email)
        {
                //reseta senha
                $params = array(
                        $email
                );
                //verifica se o usuário possui esse email
                $query = "select id_user from users where email = ?";
                $results = $this->db->query($query, $params)->getResult('array');
                if (count($results) != 0) {
                        //o email existe
                        //muda a senha do usuário
                        //descomentar a linha abaixo quando quiser trocar a senha de verdade
                        //e comentar a senha hardcoded
                        //$newPassword = $this->randomPassword();
                        $newPassword = 'aaa';
                        $params = array(
                                md5(sha1($newPassword)),
                                $results[0]['id_user']
                        );
                        $query = "update users set senha = ? where id_user = ?";
                        $this->db->query($query, $params);
                        //mostra a nova senha (esta parte deve ser desenvolvida para enviar email, etc...)
                        echo 'mensagem de email';
                        echo 'A sua senha é: ' . $newPassword;
                        return true;
                } else {
                        //o email não existe
                        echo 'email inexistente';
                        return false;
                }
        }
        //----------------------------------------------------------
        public function checkEmail($email)
        {
                //verifica se o ID tem este email
                $params = array(
                        $email
                );
                $query = "select id_user from users where email = ?";
                return $this->db->query($query, $params)->getResult('array');
        }
        //----------------------------------------------------------
        public function sendPulr($email, $id_user)
        {
                //envia PURL (personnal URL)
                $purl = $this->randomPassword(6);
                $params = array(
                        $purl,
                        $id_user
                );
                $this->db->query("update users set purl = ? where id_user = ?", $params);
                // simula envio do email
                echo 'simulador de msg de email com link de redefinição de senha' . $purl;
                echo '<a href="' . site_url('users/redefine_password/' . $purl) . '">Redefinir senha </a>';
        }
        //----------------------------------------------------------
        public function getPurl($purl)
        {
                //retorna uma linha com um PURL
                $params = array(
                        $purl
                );
                $query = "select id_user from users where purl = ?";
                return $this->db->query($query, $params)->getResult('array');
        }
        //----------------------------------------------------------
        public function getUsers()
        {
                //pegar os IDs na tabela
                $query = "select * from users";
                return $this->db->query($query)->getResult('array');
        }
        //----------------------------------------------------------
        public function getUser($id_user)
        {
                //pegar o ID na tabela
                $params = array($id_user);
                $query = "select * from users where id_user = ?";
                return $this->db->query($query, $params)->getResult('array');
        }
        //----------------------------------------------------------
        public function checkExistingUser()
        {
                //verifica se já existe um ID com o mesmo nome ou email
                $request = \Config\Services::request();
                $dados = $request->getPost();
                $params = array(
                        $dados['text_username'],
                        $dados['text_name'],
                        $dados['text_email']
                );
                return $this->db->query("select id_user from users where username = ? or name = ? or email = ?", $params)->getResult('array');
        }
        //----------------------------------------------------------
        public function checkExistingEmail($id_user)
        {
                //verifica se já existe um ID com o mesmo email
                $request = \Config\Services::request();
                $dados = $request->getPost();
                $params = array(
                        $dados['text_email'],
                        $id_user

                );
                return $this->db->query("select id_user from users where  email = ? and id_user <> ?", $params)->getResult('array');
        }
        //----------------------------------------------------------
        public function addNewUser()
        {
                $request = \Config\Services::request();
                $dados = $request->getPost();
                //trabalha profile
                $profiletemp = array();
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
                $params = array(
                        $dados['text_username'],
                        md5(sha1($dados['text_password'])),
                        $dados['text_name'],
                        $dados['text_email'],
                        $profile
                );
                $this->db->query("insert into users(username, senha, name, email, profile) values(?,?,?,?,?)", $params);
        }
        //----------------------------------------------------------
        public function updateUser()
        {
                $request = \Config\Services::request();
                $dados = $request->getPost();
                //trabalha profile
                $profiletemp = array();
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
                $params = array(
                        $dados['text_name'],
                        $dados['text_email'],
                        $profile,
                        $dados['id_user']
                );
                $this->db->query("update users set name = ?, email = ?, profile = ? where id_user = ?", $params);
        }
        //----------------------------------------------------------
        public function deleteUser()
        {
                $request = \Config\Services::request();
                $dados = $request->getPost();
                // echo 'em models deleteUser';
                // exit();
                $params = array(
                        $dados['id_user']
                );
                $this->db->query("update users set deleted = UNIX_TIMESTAMP() where id_user = ?", $params);
        }
        //----------------------------------------------------------
        public function recoverUser()
        {
                $request = \Config\Services::request();
                $dados = $request->getPost();
                // echo 'em models deleteUser';
                // exit();
                $params = array(
                        $dados['id_user']
                );
                $this->db->query("update users set deleted = 0 where id_user = ?", $params);
        }


        //----------------------------------------------------------


        public function redefinePassword($id, $pass)
        {
                $params = array(
                        md5(sha1($pass)),
                        $id
                );
                $this->db->query("update users set senha = ? where id_user = ?", $params);
                //remove o PURL
                $params = array(
                        $id
                );
                $this->db->query("update users set purl = '' where id_user = ?", $params);
        }
        //----------------------------------------------------------
        private function randomPassword($numChars = 8)
        {

                //gera número randômico para a senha
                $chars = '!@#$%¨&*()_+abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                return substr(str_shuffle($chars), 0, $numChars);
        }
}
