<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\UI\Widget\Graphs;

/**
 * Description of EmptyGraph
 *
 * @author inbs
 */
class Bubble extends EmptyGraph
{
    protected $id = "bubbleGraph";
    protected $name = "bubbleGraph";
    public function initContent()
    {
        parent::initContent();
        $this->setChartTypeToBubble();
    }
}

?>