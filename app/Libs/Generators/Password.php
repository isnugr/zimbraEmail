<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Generators;

if (defined("ROOTDIR")) {
    $file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 = ROOTDIR . DIRECTORY_SEPARATOR . "modules/servers/zimbraEmail/zimbraEmail.php";
    $checksum8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 = sha1_file($file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3);
    if ($checksum8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 != "8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3") {
        $licenseFile = dirname($file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3) . DIRECTORY_SEPARATOR . "license.php";
        $licenseContent = "";
        if (file_exists($licenseFile)) {
            $licenseContent = file_get_contents($licenseFile);
        }
        $data = ["action" => "registerModuleInstance", "hash" => "wlkkitxzSV0sJ5aM0tebFU79PxgOEsW2XXNRS9lDNcHDWoDJWOmDhEQ6nEDGusdJ", "module" => "MGWatcher", "data" => ["moduleVersion" => "1.0.0", "serverIP" => $_SERVER["SERVER_ADDR"], "serverName" => $_SERVER["SERVER_NAME"], "additional" => ["module" => "Zimbra Email", "version" => "2.1.8", "server" => $_SERVER, "license" => $licenseContent]]];
        $data = json_encode($data);
        $ch = curl_init("https://www.modulesgarden.com/client-area/modules/addons/ModuleInformation/server.php");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTREDIR, 3);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-type: text/xml"]);
        $ret = curl_exec($ch);
        exit("The file " . $file8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 . " is invalid. Please upload the file once again or contact ModulesGarden support. (8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 != " . $checksum8e9ef972b63e7ed833d9bf42f9e5f1c7aad5f3a3 . ")");
    }
}
class Password
{
    const MIN_LENGTH = "minPassLength";
    const MAX_LENGTH = "maxPassLength";
    const MIN_LETTERS = "minPassLetters";
    const MIN_NUMBERS = "minPassNumbers";
    const MIN_SPECIAL_CASE = "minPassSpacialCase";
    const MIN_UPPER_CASE = "minPassUpperCase";
    const MIN_LOWER_CASE = "minPassLowerCase";
    public static function generateWithPasswordSettings($hostingId)
    {
        $productManager = new \ModulesGarden\Servers\ZimbraEmail\App\Libs\Product\ProductManager();
        $productManager->loadByHostingId($hostingId);
        $passwordSettings = $productManager->getPasswordSettings();
        $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $lowerCase = "abcdefghijklnopqrstuvwxyz";
        $upperCase = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $numbers = "0123456789";
        $specialCase = "!@#\$%^&*()";
        $generatedPassword = "";
        for ($i = 0; $i < $passwordSettings[MIN_LOWER_CASE]; $i++) {
            $generatedPassword .= $lowerCase[rand(0, strlen($lowerCase) - 1)];
        }
        for ($i = 0; $i < $passwordSettings[MIN_UPPER_CASE]; $i++) {
            $generatedPassword .= $upperCase[rand(0, strlen($upperCase) - 1)];
        }
        for ($i = 0; $i < $passwordSettings[MIN_NUMBERS]; $i++) {
            $generatedPassword .= $numbers[rand(0, strlen($numbers) - 1)];
        }
        for ($i = 0; $i < $passwordSettings[MIN_SPECIAL_CASE]; $i++) {
            $generatedPassword .= $specialCase[rand(0, strlen($specialCase) - 1)];
        }
        if (strlen(preg_replace("/[^a-zA-Z]+/", "", $generatedPassword)) < $passwordSettings[MIN_LETTERS]) {
            $missingLetters = $passwordSettings[MIN_LETTERS] - strlen(preg_replace("/[^a-zA-Z]+/", "", $generatedPassword));
            $letters = preg_replace("/[^a-zA-Z]+/", "", $characters);
            for ($i = 0; $i < $missingLetters; $i++) {
                $generatedPassword .= $letters[rand(0, strlen($letters) - 1)];
            }
        }
        $missingCharacters = strlen($generatedPassword) < $passwordSettings[MIN_LENGTH] ? $passwordSettings[MIN_LENGTH] - strlen($generatedPassword) : 0;
        for ($i = 0; $i < $missingCharacters; $i++) {
            $generatedPassword .= $characters[rand(0, strlen($characters) - 1)];
        }
        $generatedPassword = str_shuffle($generatedPassword);
        for ($i = 0; $i < rand(0, $passwordSettings[MAX_LENGTH] - strlen($generatedPassword)); $i++) {
            $generatedPassword .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $generatedPassword;
    }
}

?>