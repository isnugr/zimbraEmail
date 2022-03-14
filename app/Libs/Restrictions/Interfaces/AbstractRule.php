<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Restrictions\Interfaces;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 07.11.19
 * Time: 10:02
 * Class AbstractRule
 */
abstract class AbstractRule implements RuleInterface
{
    /**
     * @var string
     */
    protected $message = "somethingWentWrong";
    /**
     * @var array
     */
    protected $replacements = [];
    protected function addReplacement($key, $value)
    {
        $this->replacements[$key] = $value;
        return $this;
    }
    public function getMessage()
    {
        $lang = ModulesGarden\Servers\ZimbraEmail\Core\Helper\di("lang");
        foreach ($this->replacements as $key => $repl) {
            $lang->addReplacementConstant($key, $repl);
        }
        return $lang->absoluteT("restrictions", "error", $this->message);
    }
}

?>