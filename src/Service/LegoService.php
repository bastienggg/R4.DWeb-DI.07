<?php

// Là ou la classe est déclarée (où son fichier se trouve)
namespace App\Service;

use App\Entity\Lego;
use \PDO;

class LegoService
{
    private $pdo;

    public function __construct()
    {
        $dsn = 'mysql:host=tp-symfony-mysql;dbname=lego_store';
        $username = 'root';
        $password = 'root';
        $this->pdo = new PDO($dsn, $username, $password);
    }

        public function getLegos(): array
        {
            $stmt = $this->pdo->prepare('SELECT * FROM lego');
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $legos = [];
            foreach ($rows as $row) {
                $lego = new Lego($row['id'], $row['name'], $row['collection']);
                $lego->setDescription($row['description']);
                $lego->setPrice($row['price']);
                $lego->setPieces($row['pieces']);
                $lego->setBoxImage($row['imagebox']);
                $lego->setBackgroundImage($row['imagebg']);
                $legos[] = $lego;
            }

            return $legos;
        }
        public function getLegosByCollection(string $collection): array
        {
            $stmt = $this->pdo->prepare('SELECT * FROM lego WHERE collection = :collection');
            $stmt->bindParam(':collection', $collection);
            $stmt->execute();
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $legos = [];
            foreach ($rows as $row) {
                $lego = new Lego($row['id'], $row['name'], $row['collection']);
                $lego->setDescription($row['description']);
                $lego->setPrice($row['price']);
                $lego->setPieces($row['pieces']);
                $lego->setBoxImage($row['imagebox']);
                $lego->setBackgroundImage($row['imagebg']);
                $legos[] = $lego;
            }

            return $legos;
        }
}
?>

