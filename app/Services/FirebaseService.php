<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    protected $database;
    protected $tableName = 'barang';

    public function __construct()
    {
        $factory = (new Factory)
            ->withServiceAccount(resource_path('credentials/firebase/firebase_credentials.json'))
            ->withDatabaseUri('https://thesis-project-4a56a-default-rtdb.asia-southeast1.firebasedatabase.app');

        $this->database = $factory->createDatabase();
    }

    public function getAll()
    {
        return $this->database->getReference($this->tableName)->getValue();
    }

    public function create($data)
    {
        return $this->database->getReference($this->tableName)
            ->push($data)
            ->getValue();
    }

    public function find($id)
    {
        return $this->database->getReference($this->tableName)->getChild($id)->getValue();
    }

    public function update($id, $data)
    {
        return $this->database->getReference($this->tableName)
            ->getChild($id)
            ->update($data);
    }

    public function delete($id)
    {
        return $this->database->getReference($this->tableName)->getChild($id)->remove();
    }
}
