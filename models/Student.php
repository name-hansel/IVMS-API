<?php
    class studentDetails{
        private $conn;
        private $table = 'student';
        public $student_id ;
        public $user_id ;
        public $name;
        public $email;
        public $phone_number;
        public $branch;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        function postStudentDetails()
        {
       
            $query = "INSERT INTO student(student_id, user_id, name, email, phone_number, branch) VALUES (?,?,?,?,?,?)";
            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1, $this->student_id);
            $stmt->bindParam(2, $this->user_id);
            $stmt->bindParam(3, $this->name);
            $stmt->bindParam(4, $this->email);
            $stmt->bindParam(5, $this->phone_number);
            $stmt->bindParam(6, $this->branch);
            $stmt->execute();
            return $stmt;
        }
    }


?>