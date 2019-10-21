<?php 

/**
 * summary
 */
class User
{
    /**
     * summary
     */
    
    private $_db;

    public function __construct()
    {
    	$this->_db = Database::getInstance();
    }

    public function register_user($fields = array())
    {
    	if ($this->_db->insert('users', $fields)) return true;
    	else return false;
    }

    public function login_user($username, $password){
        die($password);
        $data = $this->_db->get_info('users', 'username', $username);

        if(password_verify($password, $data['password']) )
            return true;
        else return false;
    }

}


?>