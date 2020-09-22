<?php
class Companies
{
    private $conn;
    private $table = 'company';

    public $company_id;
    public $email;
    public $password;
    public $phone_number;
    public $company;
    public $description;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllCompanies()
    {
        $query = 'SELECT * FROM company'; 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->company_id);
        $stmt->execute();

        return $stmt;
    }
}