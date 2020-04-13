<?php
/**
 * author:  LH
 * date:    2020-04-11 12:47:48
 */


/**
 * 
 * 
 */
class ApiUser
{
    use BaseTrait;

    // STATIC PROPERTIES
    // static $prop1 = "";

    // STATIC METHODS

    
    static function create ($params=[])
    {
        Form::getText("login");
        Form::getEmail("email");
        Form::getText("password");

        // ADD EXTRA CHECK
        Form::checkUnique("email", "user");
        Form::checkUnique("login", "user");

        if (Form::isValid())
        {
            // COMPLETE THE FORM
            Form::add("level", 10);     // 10 => ACTIVE 
            Form::add("creationDate", date("Y-m-d H:i:s"));
            
            // UPDATE THE DATA
            extract(Form::$tabCV);
            Form::add("password", password_hash($password, PASSWORD_DEFAULT));

            Form::insertLine("user");
            
            Response::$tabData["confirmation"] = "user $login ($email)";
        }
        else
        {
            Response::$tabData["confirmation"] = "Erreur...";
        }
        Response::$tabData["users"] = ApiUser::readList();
    }
    
    
    static function read ($params=[])
    {
        Response::$tabData["users"] = ApiUser::readList();
    }
    
    
    static function readList ($params=[])
    {
        $tabData = Model::read("user");
        return $tabData;
    }
    
    
    static function delete ($params=[])
    {
        Form::delete("user");

        Response::$tabData["users"] = ApiUser::readList();
    }
        
    static function update ($params=[])
    {
        Form::getText("login");
        Form::getEmail("email");
        Form::getInt("level");
        Form::getText("password", "", 0);   // OPTIONAL

        Form::checkUniqueUpdate("user", "login");
        Form::checkUniqueUpdate("user", "email");

        if (Form::isValid())
        {
            extract(Form::$tabCV);
            if ($password != "")
            {
                Form::add("password", password_hash($password, PASSWORD_DEFAULT));
            }
            else
            {
                // DON'T UPDATE password IN DATABASE AS NOT UPDATED BY USER
                Form::remove("password");
            }

            Form::updateLine("user");

            Response::$tabData["confirmation"] = "user updated $login ($id)";
        }
        else
        {
            Response::$tabData["confirmation"] = "Erreur...";
        }

        Response::$tabData["users"] = ApiUser::readList();
    }
    
    
    static function login ($params=[])
    {
        Form::getEmail("email");
        Form::getText("password");

        if (Form::isValid())
        {
            extract(Form::$tabCV);
            $users = Model::read("user", "email", $email);
            $passwordForm = $password;
            foreach($users as $user)
            {
                extract($user);
                $passwordCheck = password_verify($passwordForm, $password);
                if ($passwordCheck)
                {
                    Response::$tabData["confirmation"] = "Bienvenue $login";
                    $expiration = time() + 3600;
                    $token      = "$id/$level/$expiration";
                    $tokenMd5   = md5($token);
                    $secret     = App::get("secret");

                    Response::$tabData["token"]     = $token;
                    Response::$tabData["token2"]    = password_hash("$tokenMd5/$secret", PASSWORD_DEFAULT);
                    Response::$tabData["redirect"]  = "admin";
                }
                else
                {
                    Response::$tabData["confirmation"] = "Erreur password...";
                }
            }

            if(empty($users))
            {
                Response::$tabData["confirmation"] = "Erreur email..."; 
            }
        }
        else
        {
            Response::$tabData["confirmation"] = "Erreur...";
        }
    }
    
    //***/
    // STATIC METHODS END

}