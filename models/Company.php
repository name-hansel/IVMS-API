<?php
class Company
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
        $query = 'SELECT company_id, email, phone_number, company, description FROM company';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getHomeCompanyData()
    {
        $query = 'SELECT company, description FROM company';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
