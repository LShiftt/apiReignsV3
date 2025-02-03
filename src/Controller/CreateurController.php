<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Createur;
use Exception;

class CreateurController extends Controller
{
    public function getAll()
    {
        $res = Createur::getInstance()->findAll();
        Controller::json($res);
    }

    public function getByMail()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $mail = trim($data['mail']);

        $criterias = [
            'ad_mail_createur' => $mail
        ];
        $res = Createur::getInstance()->findOneBy($criterias);

        Controller::json($res);
    }
    public function check()
    {

        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $mail = $data['mail'];
        $password = $data['password'];

        $criterias = [
            'ad_mail_createur' => $mail
        ];

        $res = Createur::getInstance()->findOneBy($criterias);

        if (password_verify(trim($password), $res['mdp_createur'])) {
            $res = [
                'id' => $res['id_createur'],
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
    public function isBan()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $id = (int) $data['id'];

        $criterias = [
            'id_createur' => $id
        ];

        $res = Createur::getInstance()->findOneBy($criterias);
        if ($res['banni'] === 'yes') {
            $res = [
                'banni' => true
            ];
        } else {
            $res = [
                'banni' => false
            ];
        }
        ;
        Controller::json($res);
    }

    public function getById()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $id = (int) $data['id'];


        $criterias = [
            'id_createur' => $id
        ];

        $res = Createur::getInstance()->findOneBy($criterias);
        Controller::json($res);
    }

    public function add()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        try {
            $name = trim($data['name']);
            $mail = trim($data['mail']);
            $password = password_hash(trim($data['password']), PASSWORD_BCRYPT);
            $genre = trim($data['sexe']);
            $date = trim($data['date']);

            $infos = [
                'nom_createur' => $name,
                'ad_mail_createur' => $mail,
                'mdp_createur' => $password,
                'genre' => $genre,
                'ddn' => $date
            ];

            $criterias = [
                'ad_mail_createur' => $mail
            ];

            $ver = Createur::getInstance()->findOneBy($criterias);

            if ($ver != null) {
                $res = [
                    'success' => false,
                    'reason' => "same email as someone else"
                ];
                Controller::json($res);
                die;
            }
            Createur::getInstance()->create($infos);
            $criterias = [
                'ad_mail_createur' => $mail
            ];

            $res2 = Createur::getInstance()->findOneBy($criterias);
            $res = [
                'success' => true,
                'id' => $res2["id_createur"]
            ];

        } catch (Exception $e) {
            $res = [
                'success' => false,
                'reason' => "Erreur : $e"
            ];
        }
        Controller::json($res);
    }
    
    public function edit()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        $name = trim($data['name']);
        $mail = trim($data['mail']);
        $password = password_hash(trim($data['password']), PASSWORD_BCRYPT);
        $genre = trim($data['sexe']);
        $date = trim($data['date']);

        $infos = [
            'nom_createur' => $name,
            'ad_mail_createur' => $mail,
            'mdp_createur' => $password,
            'genre' => $genre,
            'ddn' => $date
        ];

        Createur::getInstance()->edit($id, $infos);
    }

    public function delete(
    ) {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        Createur::getInstance()->del($id);
    }

    public function getNamesFromDeck()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        $res = Createur::getInstance()->getNamesFromDeck($id);

        Controller::json($res);
    }

    public function addLike()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        foreach ($data as $element) {
            $id = (int) $element['id'];
            $nbJaime = Createur::getInstance()->getLike($id) + 1;
            $infos = [
                'nb_jaime' => $nbJaime
            ];
            Createur::getInstance()->edit($id, $infos);
        }

    }
    public function ban()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];

        $infos = [
            'banni' => "yes"
        ];

        Createur::getInstance()->edit($id, $infos);
    }
}
