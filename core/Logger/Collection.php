<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Logger;

/**
 * Description of Collection
 *
 * @author inbs
 */
class Collection
{
    /**
     * @var LoggerModel
     */
    protected $model = NULL;
    /**
     * @var Request 
     */
    protected $requestObj = NULL;
    protected $limit = 10;
    protected $search = NULL;
    protected $sort = NULL;
    public function __construct(\ModulesGarden\Servers\ZimbraEmail\Core\Http\Request $requestObj)
    {
        $this->requestObj = $requestObj;
    }
    public function loadSearch()
    {
    }
    public function all()
    {
    }
    public function getBySearch($search)
    {
    }
    public function removeByDate($date)
    {
    }
    protected function generatedEntityModel()
    {
        return ModulesGarden\Servers\ZimbraEmail\Core\Helper\sl("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Logger\\Entity");
    }
}

?>