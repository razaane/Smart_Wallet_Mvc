<?php
use App\Core\Database;

require_once __DIR__ . '/../core/Database.php';

class Income {
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnexion();
    }

    public function all(){
        $stmt = $this->db->query("SELECT expenes.*, categories.name as category_name, users.fullname as user_name 
                                  FROM incomes
                                  LEFT JOIN categories ON incomes.category_id = categories.id
                                  LEFT JOIN users ON incomes.user_id = users.id
                                  ORDER BY la_date DESC");
        return $stmt->fetchAll();
    }

    public function add($montant, $description, $user_id, $category_id){
        $stmt = $this->db->prepare("INSERT INTO incomes(montant, descreption, user_id, category_id) VALUES(?,?,?,?)");
        return $stmt->execute([$montant, $description, $user_id, $category_id]);
    }
}
