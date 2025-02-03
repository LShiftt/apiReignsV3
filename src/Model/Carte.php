<?php

declare(strict_types=1);

namespace App\Model;

class Carte extends Model
{
    use TraitInstance;

    protected $tableName = 'carte';
    protected $tableNameRng = 'carte_aleatoire';

    protected $tableNameDeck = 'deck';


    public function edit(
        int $id,
        array $datas
    ): bool {

        $sql = 'UPDATE `' . $this->tableName . '` SET ';
        foreach (array_keys($datas) as $k) {
            $sql .= " {$k} = :{$k} ,";
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql .= ' WHERE id_carte =:id';
        foreach (array_keys($datas) as $k) {
            $attributes[':' . $k] = $datas[$k];
        }
        $attributes[':id'] = $id;
        $sth = $this->query($sql, $attributes);
        return $sth->rowCount() > 0;
    }

    public function del(
        int $id
    ): bool {
        $sql = "DELETE FROM `{$this->tableName}` WHERE id_carte = :id";
        $sth = $this->query($sql, [':id' => $id]);
        return $sth->rowCount() > 0;
    }

    public function getAllValidByIdDeck(
        int $id,
    ): array {
        $sql = 'SELECT DISTINCT c.* FROM `{$this->tableName}` as c, `{$this->tableNameDeck}` as d WHERE d.valid = "yes" AND c.id_deck = :id';
        $sth = $this->query($sql, [':id' => $id]);
        $res = $sth->fetchAll();
        return $res;
    }
    public function getAllByIdDeck(
        int $id,
    ): array {
        $sql = 'SELECT * FROM `{$this->tableName}`  WHERE id_deck = :id';
        $sth = $this->query($sql, [':id' => $id]);
        $res = $sth->fetchAll();
        return $res;
    }
    public function getByIdDeckAndIdDeck(
        int $idCarte,
        int $idDeck
    ) {
        $sql = 'SELECT * FROM `{$this->tableName}`  WHERE id_deck = :idDeck AND id_carte = :idCarte';
        $sth = $this->query($sql, [':idCarte' => $idCarte, ':idDeck' => $idDeck]);
        $res = $sth->fetch();
        return $res;
    }
    public function count(
        int $id
    ) {
        $sql = 'SELECT COUNT(id_carte) as count FROM `{$this->tableName}` WHERE id_deck = :id';
        $sth = $this->query($sql, [':id' => $id]);
        $res = $sth->fetch();
        return $res;
    }

    public function getCarteRng($idDeck, $idCreateur)
    {
        $sql = "SELECT num_carte FROM `{$this->tableNameRng}` WHERE id_deck = :idDeck && id_createur = :idCreateur";
        $sth = $this->query($sql, [':idDeck' => $idDeck, ':idCreateur' => $idCreateur]);
        $res = $sth->fetch();
        return $res ? $res : false;
    }
    public function getCarteRandomFromDeck($idDeck)
    {
        $sql = "SELECT * FROM `{$this->tableName}` WHERE id_deck = :idDeck ORDER BY RAND() LIMIT 1";
        $sth = $this->query($sql, [':idDeck' => $idDeck]);
        $res = $sth->fetch();
        return $res;
    }

    public function createCarteRng($idDeck, $idCreateur)
    {
        $res = $this->getCarteRandomFromDeck($idDeck);
        $idCarte = $res["id_carte"];

        $sql = "INSERT INTO `{$this->tableNameRng}` (`num_carte`, `id_deck`, `id_createur`) VALUES (:idCarte, :idDeck, :idCreateur)";
        $this->query($sql, [':idCarte' => $idCarte, ':idDeck' => $idDeck, ':idCreateur' => $idCreateur]);
        return $idCarte;
    }
    public function order($idDeck)
    {
        $sql = "SELECT MAX(ordre_soumission) AS max_ordre FROM `{$this->tableName}` WHERE id_deck = :idDeck";
        $sth = $this->query($sql, [':idDeck' => $idDeck]);
        $res = $sth->fetch();

        return $res ? $res : null;
    }
}

