<?php

declare(strict_types=1);

namespace App\Model;

class Createur extends Model
{
    use TraitInstance;

    protected $tableName = 'createur';

    public function edit(
        int $id,
        array $datas
    ): bool {

        $sql = 'UPDATE `' . $this->tableName . '` SET ';
        foreach (array_keys($datas) as $k) {
            $sql .= " {$k} = :{$k} ,";
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql .= ' WHERE id_createur =:id';
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
        $sql = "DELETE FROM `{$this->tableName}` WHERE id_createur = :id";
        $sth = $this->query($sql, [':id' => $id]);
        return $sth->rowCount() > 0;
    }
    public function getNamesFromDeck(
        int $idDeck
    ) {
        $sql = "SELECT DISTINCT createur.nom_createur, carte.id_createur FROM `{$this->tableName}` RIGHT JOIN carte ON createur.id_createur = carte.id_createur WHERE carte.id_deck = :id AND carte.id_createur IS NOT NULL";
        $sth = $this->query($sql, [':id' => $idDeck]);
        $res = $sth->fetchAll();
        return $res;
    }
    public function getLike(
        int $id
    ) {
        $sql = "SELECT nb_jaime FROM `{$this->tableName}` WHERE id_createur = :id";
        $sth = $this->query($sql, [':id' => $id]);
        $res = $sth->fetch();
        return $res['nb_jaime'];
    }
}

