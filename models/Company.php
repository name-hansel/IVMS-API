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
        $query = 'SELECT company FROM company LIMIT 4';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getHashCompany()
    {
        $query = 'SELECT company_id, password FROM company
        WHERE email = ?';

        $stmt = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));
        $stmt->bindParam(1, $this->email);

        $stmt->execute();
        return $stmt;
    }

    public function getHashCompanyID()
    {
        $query = 'SELECT password FROM company
        WHERE company_id = ?';

        $stmt = $this->conn->prepare($query);
        $this->company_id = htmlspecialchars(strip_tags($this->company_id));
        $stmt->bindParam(1, $this->company_id);

        $stmt->execute();
        return $stmt;
    }

    public function putCompanyDetails()
    {
        // email, phone number, company name, description
        $query = 'UPDATE company SET
        phone_number = ?, company = ?, description = ?
        WHERE company_id = ?';
        $stmt = $this->conn->prepare($query);

        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->company = htmlspecialchars(strip_tags($this->company));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->company_id = htmlspecialchars(strip_tags($this->company_id));

        $stmt->bindParam(1, $this->phone_number);
        $stmt->bindParam(2, $this->company);
        $stmt->bindParam(3, $this->description);
        $stmt->bindParam(4, $this->company_id);

        $stmt->execute();
        return $stmt;
    }

    public function putCompanyHash()
    {
        $query = 'UPDATE company SET
        password = ? WHERE company_id = ?';
        $stmt = $this->conn->prepare($query);

        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->company_id = htmlspecialchars(strip_tags($this->company_id));
        $stmt->bindParam(1, $this->password);
        $stmt->bindParam(2, $this->company_id);

        $stmt->execute();
        return $stmt;
    }

    public function postUserCompany()
    {
        $query = "INSERT INTO company(email, password, phone_number, company, description) VALUES (?,?,?,?,?)";
        $stmt = $this->conn->prepare($query);

        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));
        $this->company = htmlspecialchars(strip_tags($this->company));
        $this->description = htmlspecialchars(strip_tags($this->description));

        $stmt->bindParam(1, $this->email);
        $stmt->bindParam(2, $this->password);
        $stmt->bindParam(3, $this->phone_number);
        $stmt->bindParam(4, $this->company);
        $stmt->bindParam(5, $this->description);

        $stmt->execute();
        return $stmt;
    }

    public function getCompanyInfo()
    {
        $query = 'SELECT company, phone_number, description FROM company WHERE company_id=?';
        $stmt = $this->conn->prepare($query);
        $this->company_id = htmlspecialchars(strip_tags($this->company_id));
        $stmt->bindParam(1, $this->company_id);

        $stmt->execute();
        return $stmt;
    }

    public function getCompanyEmailExist()
    {
        $query = 'SELECT email FROM company WHERE email = ?';
        $stmt = $this->conn->prepare($query);
        $this->email = htmlspecialchars(strip_tags($this->email));

        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        return $stmt;
    }
}
