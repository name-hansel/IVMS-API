<?php
class Coordinator
{
    private $conn;
    private $table = 'coordinator';

    public $user_id;
    public $email;
    public $password;
    public $phone_number;
    public $college;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function postUserCoordinator()
    {
        $query = "INSERT INTO coordinator(email, password, phone_number, college) VALUES (?,?,?,?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->password);
        $stmt->bindParam(3, $this->phone_number);
        $stmt->bindParam(4, $this->college);

        $stmt->execute();
        return $stmt;
    }

    public function getHashCoordinator()
    {
        $query = 'SELECT password FROM coordinator
        WHERE email = ?';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->email);

        $stmt->execute();
        return $stmt;
    }

    public function putCoordinatorDetails()
    {
        $query = 'UPDATE coordinator SET
        email = ?, phone_number = ?, college = ?
        WHERE user_id = ?';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->phone_number);
        $stmt->bindParam(3, $this->college);
        $stmt->execute();
        return $stmt;
    }

    public function putCoordinatorHash()
    {
        $query = 'UPDATE coordinator SET
        password = ? WHERE user_id = ?';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->password);
        $stmt->bindParam(2, $this->user_id);

        $stmt->execute();
        return $stmt;
    }

}