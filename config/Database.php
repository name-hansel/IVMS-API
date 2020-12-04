<?php
class Database
{
    private $conn;
    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = (function () {
                $parts = parse_url(getenv('DATABASE_URL'));
                extract($parts);
                $path = ltrim($path, "/");
                return new PDO("pgsql:host={$host};port={$port};dbname={$path}", $user, $pass);
            })();
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error' . $e->getMessage();
        }
        return $this->conn;
    }
}
