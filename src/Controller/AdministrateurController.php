<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Administrateur;

class AdministrateurController extends Controller
{
    public function getAll()
    {
        $res = Administrateur::getInstance()->findAll();
        Controller::json($res);
    }

    public function getByMail()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $mail = trim($data['mail']);

        $criterias = [
            'ad_mail_admin' => $mail
        ];
        $res = Administrateur::getInstance()->findOneBy($criterias);

        Controller::json($res);
    }

    public function add()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $mail = $data['mail'];
        $password = password_hash(trim($data['password']), PASSWORD_BCRYPT);


        $infos = [
            'ad_mail_admin' => $mail,
            'mdp_admin' => $password
        ];

        Administrateur::getInstance()->create($infos);
    }
    public function edit()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        $inProgress = trim($data['inProgress']);

        $infos = [
            'in_progress' => $inProgress
        ];
        Administrateur::getInstance()->edit($id, $infos);
    }

    public function check()
    {

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $mail = $data['mail'];
        $password = $data['password'];

        $criterias = [
            'ad_mail_admin' => $mail
        ];

        $res = Administrateur::getInstance()->findOneBy($criterias);
        
        if (password_verify(trim($password), $res['mdp_admin'])) {
            $res = [
                'id' => $res['id_administrateur'],
                'check' => true
            ];
        } else {
            $res = [
                'check' => false
            ];
        }
        ;
        Controller::json($res);
    }
    public function ready()
    {

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $mail = $data['mail'];
        $password = $data['password'];

        $criterias = [
            'ad_mail_admin' => $mail
        ];

        $res = Administrateur::getInstance()->findOneBy($criterias);
        Controller::json($res);
    }
}
