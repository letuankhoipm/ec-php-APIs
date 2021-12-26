<?php
require_once PROJECT_ROOT_PATH . "/models/BaseModel.php";

class UserModel extends BaseModel
{
    public function getUsers($limit)
    {
        return $this->select("SELECT * FROM users ORDER BY user_id ASC LIMIT ?", ["i", $limit]);
    }
}
