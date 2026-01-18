<?php
namespace App\Models;

use PDO;
use App\Core\Database; // assuming you have Database class in Core

class User {
    private string $fullname;
    private string $email;
    private string $password;
    private string $role;
    private PDO $db;

    public function __construct(string $email = '', string $password = '', ?string $role = null, ?string $fullname = null)
    {
        $this->db = Database::getInstance()->getConnexion();
        $this->fullname = $fullname ?? '';
        $this->email = $email ?? '';
        $this->password = $password ?? '';
        $this->role = $role ?? '';
    }

    private function checkEmail(): bool {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute([$this->email]);
        return (bool)$stmt->fetch();
    }

    public function signUp(): bool {
        if ($this->checkEmail()) return false;

        $passwordHash = password_hash($this->password, PASSWORD_DEFAULT);
        try {
            $stmt = $this->db->prepare('INSERT INTO users(fullname,email,password,role) VALUES(?,?,?,?)');
            return $stmt->execute([$this->fullname, $this->email, $passwordHash, $this->role]);
        } catch (\PDOException $e) {
            echo "Database error: " . $e->getMessage();
            return false;
        }
    }

    public function login(): ?array {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email =?");
        $stmt->execute([$this->email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($this->password, $user['password'])) {
            unset($user['password']); // remove password for security
            return $user;
        }
        return null;
    }
}
 