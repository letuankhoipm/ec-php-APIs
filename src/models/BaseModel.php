<?php
class BaseModel
{
    protected $connection_string = null;

    public function __construct()
    {
        try {
            $this->connection_string = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }
    }

    public function select($query = "", $params = [])
    {
        try {
            $stmt = $this->connection_string->prepare($query, $params);
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $stmt->close();

            return $result;
        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }
        return false;
    }

    private function execStatement($query = "", $params)
    {
        try {
            $stmt = $this->connection_string->prepare(($query));

            if ($stmt === false) {
                throw new Exception("Unable to do prepared statement: " . $query);
            }

            if ($params) {
                $stmt->bind_param($params[0], $params[1]);
            }

            $stmt->execute();
        } catch (Exception $err) {
            throw new Exception($err->getMessage());
        }
    }
}
