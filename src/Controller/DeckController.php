<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Deck;
use App\Model\Createur;
use App\Model\Carte;

class DeckController extends Controller
{
    public function getAll()
    {
        $res = Deck::getInstance()->findAll();
        foreach ($res as &$element) {
            $idDeck = (int) $element['id_deck'];
            $criterias = [
                'id_deck' => $idDeck
            ];
            $count = Carte::getInstance()->count($criterias['id_deck']);

            $element['count'] = $count['count'];
        }
        unset($element); // Attention, c'est fourbe !
        Controller::json($res);
    }
    public function getAllValid()
    {
        $res = Deck::getInstance()->findAllValid();
        Controller::json($res);
    }

    public function getById()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $id = (int) $data['id'];

        $criterias = [
            'id_deck' => $id
        ];

        $res = Deck::getInstance()->findOneBy($criterias);
        $count = Carte::getInstance()->count($criterias['id_deck']);

        $res['count'] = $count['count'];

        Controller::json($res);
    }


    public function add()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $titre = trim($data['titre']);
        $body = trim($data['body']);
        $dateDebut = trim($data['date_debut']);
        $dateFin = trim($data['date_fin']);
        $nbCarte = (int) $data['nb_cartes'];
        $nbJaime = (int) $data['nb_jaime'];
        $idAdmin = (int) $data['id_administrateur'];

        $infos = [
            'titre_deck' => $titre,
            'body_deck' => $body,
            'date_debut_deck' => $dateDebut,
            'date_fin_deck' => $dateFin,
            'nb_cartes' => $nbCarte,
            'nb_jaime' => $nbJaime,
            'id_administrateur' => $idAdmin
        ];
        Deck::getInstance()->create($infos);
    }
    public function edit()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        $titre = trim($data['titre']);
        $body = trim($data['body']);
        $dateDebut = trim($data['date_debut']);
        $dateFin = trim($data['date_fin']);
        $nbCarte = (int) $data['nb_cartes'];
        $nbJaime = (int) $data['nb_jaime'];
        $idAdmin = (int) $data['id_administrateur'];
        $valid = trim($data['valid']);

        $infos = [
            'titre_deck' => $titre,
            'body_deck' => $body,
            'date_debut_deck' => $dateDebut,
            'date_fin_deck' => $dateFin,
            'nb_cartes' => $nbCarte,
            'nb_jaime' => $nbJaime,
            'id_administrateur' => $idAdmin,
            'valid' => $valid
        ];

        Deck::getInstance()->edit($id, $infos);
    }
    public function editValid()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        $valid = trim($data['valid']);

        $infos = [
            'valid' => $valid
        ];

        Deck::getInstance()->edit($id, $infos);
    }

    public function delete(
    ) {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        Deck::getInstance()->del($id);
    }
    public function searchByMinMax()
    {
        //valid = yes
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        if (!$data['min']) {
            $min = 1;
        } else {
            $min = (int) $data['min'];
        }

        if (!$data['max']) {
            $max = 100;
        } else {
            $max = (int) $data['max'];
        }
        $res = Deck::getInstance()->searchByMinMax($min, $max);
        Controller::json($res);
    }
    public function getAllValidByAdmin()
    {
        //valid = yes
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];

        $res = Deck::getInstance()->searchByIdAdmin($id);
        Controller::json($res);
    }

    public function getValidById()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];

        $criterias = [
            'id_deck' => $id
        ];

        $res = Deck::getInstance()->findOneBy($criterias);
        Controller::json($res);
    }
    public function addLike()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        $nbJaime = Deck::getInstance()->getLike($id) + 1;
        $infos = [
            'nb_jaime' => $nbJaime
        ];

        Deck::getInstance()->edit($id, $infos);

        $listeCrea = Createur::getInstance()->getNamesFromDeck($id);

        foreach ($listeCrea as $element) {
            $id = (int) $element['id_createur'];
            $nbJaime = Createur::getInstance()->getLike($id) + 1;
            $infos = [
                'nb_jaime' => $nbJaime
            ];
            Createur::getInstance()->edit($id, $infos);
        }

    }
    public function noParticipation()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        $res = Deck::getInstance()->noParticipation($id);
        Controller::json($res);
    }

    public function participation()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        $res = Deck::getInstance()->participation($id);
        Controller::json($res);
    }
    public function participationAdmin()
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $id = (int) $data['id'];
        $res = Deck::getInstance()->participationAdmin($id);
        foreach ($res as &$element) {
            $idDeck = (int) $element['id_deck'];
            $criterias = [
                'id_deck' => $idDeck
            ];
            $count = Carte::getInstance()->count($criterias['id_deck']);

            $element['count'] = $count['count'];
        }
        unset($element); // Attention, c'est fourbe !

        Controller::json($res);
    }
    public function getAllNoValid()
    {
        $criterias = [
            'valid' => "no"
        ];

        $res = Deck::getInstance()->findAllBy($criterias);
        Controller::json($res);
    }
    public function findDeckID()
    {
        $res = Deck::getInstance()->findDeckID();
        Controller::json($res);
    }
}
