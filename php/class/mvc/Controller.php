<?php
/**
 * author:  LH
 * date:    2020-04-09 15:31:12
 */


/**
 * 
 * 
 */
class Controller
{
    use BaseTrait;

    // STATIC PROPERTIES
    static $userId          = null;
    static $userLevel       = null;
    static $userExpiration  = null;

    // STATIC METHODS
   
    static function processForm ()
    {
        $apiClass   = Request::getApiClass();
        $apiMethod  = Request::getApiMethod();
        if (($apiClass != "") && ($apiMethod != ""))
        {
            $apiCall    = "Api$apiClass::$apiMethod";

            if (is_callable($apiCall))
            {
                $apiCall();
            }    
        }
    }
    
    
    static function checkUserLevel ($levelSecurity)
    {
        $result = false;
        if (Controller::$userLevel == null)
        {
            Controller::$userLevel = 0;
            Controller::$userExpiration = 0;
            $token      = Request::getInput("token");
            $token2     = Request::getInput("token2");
            $tokenMd5   = md5($token);
            $secret     = App::get("secret");
            if (password_verify("$tokenMd5/$secret", $token2))
            {
                list($id, $level, $expiration) = explode("/", $token);
                Controller::$userId         = $id;
                Controller::$userLevel      = $level;
                Controller::$userExpiration = $expiration;
            }
        }
        if ($levelSecurity <= Controller::$userLevel)
        {
            $time = time();
            if ($time < Controller::$userExpiration)
            {
                $result = true;
            }
        }

        return $result;
    }
    
    //***/
    // STATIC METHODS END

}