<?php

declare(strict_types=1);

namespace App\Model;

class Deck extends Model
{
    use TraitInstance;

    protected $tableName = 'deck';

    public function findAllValid(
    ): ?array {
        $sql = "SELECT * FROM `{$this->tableName}` WHERE valid = 'yes'";
        $sth = $this->query($sql);
        if ($sth) {
            return $sth->fetchAll();
        }
        return [];
    }

    public function edit(
        int $id,
        array $datas
    ): bool {

        $sql = 'UPDATE `' . $this->tableName . '` SET ';
        foreach (array_keys($datas) as $k) {
            $sql .= " {$k} = :{$k} ,";
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql .= ' WHERE id_deck =:id';
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
        $sql = "DELETE FROM `{$this->tableName}` WHERE id_deck = :id";
        $sth = $this->query($sql, [':id' => $id]);
        return $sth->rowCount() > 0;
    }
    public function searchByMinMax(
        int $min,
        int $max
    ): ?array {
        $sql = "SELECT * FROM `{$this->tableName}` WHERE `nb_cartes` >= :min AND `nb_cartes` <= :max AND valid = 'yes'";
        $sth = $this->query($sql, [':min' => $min, ':max' => $max]);
        if ($sth) {
            return $sth->fetchAll();
        }
        return [];
    }
    public function getLike(
        int $id
    ) {
        $sql = "SELECT nb_jaime FROM `{$this->tableName}` WHERE id_deck = :id";
        $sth = $this->query($sql, [':id' => $id]);
        $res = $sth->fetch();
        return $res['nb_jaime'];
    }
    public function noParticipation(
        int $id
    ) {
        $sql = "SELECT DISTINCT d.* FROM `{$this->tableName}` d WHERE d.id_deck NOT IN (SELECT c.id_deck FROM carte c WHERE c.id_createur = :id)";
        $sth = $this->query($sql, [':id' => $id]);
        $res = $sth->fetchAll();
        return $res;
    }
    public function participation(
        int $id
    ) {
        $sql = "SELECT DISTINCT d.* FROM `{$this->tableName}` d JOIN carte c ON d.id_deck = c.id_deck WHERE c.id_createur = :id";
        $sth = $this->query($sql, [':id' => $id]);
        $res = $sth->fetchAll();
        return $res;
    }
    public function participationAdmin(
        int $id
    ) {
        $sql = "SELECT d.* FROM `{$this->tableName}` d WHERE d.id_administrateur = :id";
        $sth = $this->query($sql, [':id' => $id]);
        $res = $sth->fetchAll();
        return $res;
    }
    public function findDeckID()
    {
        $sql = "SELECT id_deck FROM `{$this->tableName}` ORDER BY id_deck DESC LIMIT 1";
        $sth = $this->query($sql);
        $res = $sth->fetch();
        return $res ? $res : false;
    }
}

