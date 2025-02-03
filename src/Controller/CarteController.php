<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Carte;

class CarteController extends Controller
{
    public function getAll()
    {
        $res = Carte::getInstance()->findAll();
        Controller::json($res);
    }

    public function getById()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $id = (int) $data['id'];

        $criterias = [
            'id_carte' => $id
        ];

        $res = Carte::getInstance()->findOneBy($criterias);
        Controller::json($res);
    }

    public function add()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $texte = trim($data['texte']);
        $valChoix1 = trim($data['valChoix1']);
        $valChoix2 = trim($data['valChoix2']);
        $date = trim($data['date']);
        $ordre = (int) $data['ordre'];

        if ($data['idCrea'] === null) {
            $idCrea = null;
        } else {
            $idCrea = (int) $data['idCrea'];
        }
        if ($data['idAdmin'] === null) {
            $idAdmin = null;
        } else {
            $idAdmin = (int) $data['idAdmin'];
        }
        $idDeck = (int) $data['idDeck'];

        $infos = [
            'texte_carte' => $texte,
            'valeurs_choix1' => $valChoix1,
            'valeurs_choix2' => $valChoix2,
            'date_soumission' => $date,
            'ordre_soumission' => $ordre,
            'id_createur' => $idCrea,
            'id_administrateur' => $idAdmin,
            'id_deck' => $idDeck
        ];
        Carte::getInstance()->create($infos);
    }
    public function edit()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        $texte = trim($data['texte']);
        $valChoix1 = trim($data['valChoix1']);
        $valChoix2 = trim($data['valChoix2']);
        $date = trim($data['date']);
        $ordre = (int) $data['ordre'];
        $modified = trim($data['modified']);
        $modifiedDate = trim($data['modifiedDate']);
        if ($data['idCrea'] === null) {
            $idCrea = null;
        } else {
            $idCrea = (int) $data['idCrea'];
        }
        if ($data['idAdmin'] === null) {
            $idAdmin = null;
        } else {
            $idAdmin = (int) $data['idAdmin'];
        }
        $idDeck = (int) $data['idDeck'];

        $infos = [
            'texte_carte' => $texte,
            'valeurs_choix1' => $valChoix1,
            'valeurs_choix2' => $valChoix2,
            'date_soumission' => $date,
            'ordre_soumission' => $ordre,
            'id_createur' => $idCrea,
            'id_administrateur' => $idAdmin,
            'id_deck' => $idDeck,
            'modified' => $modified,
            'modified_date' => $modifiedDate
        ];
        Carte::getInstance()->edit($id, $infos);
    }

    public function delete(
    ) {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        Carte::getInstance()->del($id);
    }
    public function getAllValidByIdDeck(
    ) {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];

        $res = Carte::getInstance()->getAllValidByIdDeck($id);
        Controller::json($res);

    }
    public function getAllByIdDeck(
    ) {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];

        $res = Carte::getInstance()->getAllByIdDeck($id);
        Controller::json($res);
    }
    public function getByIdDeckAndIdDeck(
    ) {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $idDeck = (int) $data['id_deck'];
        $idCarte = (int) $data['id_carte'];

        $res = Carte::getInstance()->getByIdDeckAndIdDeck($idCarte, $idDeck);
        Controller::json($res);
    }
    public function count(
    ) {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];

        $res = Carte::getInstance()->count($id);
        Controller::json($res);
    }

    public function getByDeckAndOrder()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        $order = (int) $data['order'];

        $res = Carte::getInstance()->getAllValidByIdDeck($id);

        $result = null;
        foreach ($res as $element) {
            if (isset($element['ordre_soumission']) && $element['ordre_soumission'] === $order) {
                $result = $element;
                break;
            }
        }

        if ($result) {
            Controller::json($result);
        }

    }
    public function order(
    ) {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];

        $res = Carte::getInstance()->order($id);
        Controller::json($res);
    }

    // gestion des cartes aléatoires
    public function getCarteRng()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $idDeck = (int) $data['id_deck'];
        $idCrea = (int) $data['id_createur'];
        $res = Carte::getInstance()->getCarteRng($idDeck, $idCrea);

        if ($res == null) {
            $res = [];
            $res['inexistant'] = true;
        }
        Controller::json($res);


    }
    public function createCarteRng()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $idDeck = (int) $data['id_deck'];
        $idCrea = (int) $data['id_createur'];

        $res = Carte::getInstance()->createCarteRng($idDeck, $idCrea);

    }
}
