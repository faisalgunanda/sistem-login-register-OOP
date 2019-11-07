<?php 

/**
 * summary
 */
class Token
{
    /**
     * summary
     */
    public static function generate()
    {
    	return  Session::set('token',md5(uniqid(rand(), true)));
    }

    public static function check($token)
    {
    	if ($token === Session::get('token')) {
    		return true;
    	}

    	return false;
    }
}


 ?>