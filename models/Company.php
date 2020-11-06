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

    public function getInfoAllCompanies()
    {
        $query = 'SELECT company_id, email, phone_number, company, description FROM company';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getHomeCompany()
    {
        $query = 'SELECT company, description FROM company';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getHashCompany()
    {
        $query = 'SELECT password FROM company
        WHERE email = ?';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->email);

        $stmt->execute();
        return $stmt;
    }

    public function putCompanyDetails()
    {
        // email, phone number, company name, description
        $query = 'UPDATE company SET
        email = ?, phone_number = ?, company = ?, description = ?
        WHERE company_id = ?';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->phone_number);
        $stmt->bindParam(3, $this->company);
        $stmt->bindParam(4, $this->description);
        $stmt->bindParam(5, $this->company_id);

        $stmt->execute();
        return $stmt;
    }

    public function putCompanyHash()
    {
        $query = 'UPDATE company SET
        password = ? WHERE company_id = ?';
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->password);
        $stmt->bindParam(2, $this->company_id);

        $stmt->execute();
        return $stmt;
    }

    public function postUserCompany()
    {
        $query = "INSERT INTO company(email, password, phone_number, company, description) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);


        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->password);
        $stmt->bindParam(3, $this->phone_number);
        $stmt->bindParam(4, $this->company);
        $stmt->bindParam(5, $this->description);

        $stmt->execute();
        return $stmt;
    }
}
