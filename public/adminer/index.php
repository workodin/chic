<?php
function adminer_object() {
    // required to run any plugin
    include_once "./plugins/plugin.php";
    
    // autoloader
    foreach (glob("plugins/*.php") as $filename) {
        include_once "./$filename";
    }
    
    $plugins = array(
        // specify enabled plugins here
        // new AdminerDumpXml,
        // new AdminerTinymce,
        // new AdminerFileUpload("data/"),
        // new AdminerSlugify,
        // new AdminerTranslation,
        // new AdminerForeignSystem,
        // new AdminerLoginPasswordLess(password_hash("", PASSWORD_DEFAULT)),
    );
    
    /* It is possible to combine customization and plugins:
    class AdminerCustomization extends AdminerPlugin {
    }
    return new AdminerCustomization($plugins);
    */
    class AdminerCustomization extends AdminerPlugin {
        function login($login, $password) {
            // validate user submitted credentials
            return true;
          }
    }
    return new AdminerCustomization($plugins);
    
    // return new AdminerPlugin($plugins);
}

// include original Adminer or Adminer Editor
include "./adminer.php";
