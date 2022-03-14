<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\App\Libs\Zimbra\Components\Api\Soap\Helpers;

/**
 *
 * Created by PhpStorm.
 * User: Tomasz Bielecki ( tomasz.bi@modulesgarden.com )
 * Date: 28.08.19
 * Time: 14:42
 * Class XmlParser
 */
class XmlParser
{
    /**
     * @var array
     */
    public $stack = [];
    /**
     * @var
     */
    public $stack_ref = NULL;
    /**
     * @var array
     */
    public $arrOutput = [];
    /**
     * @var
     */
    public $resParser = NULL;
    /**
     * @var
     */
    public $strXmlData = NULL;
    public function push_pos($pos)
    {
        $this->stack[count($this->stack)] =& $pos;
        $this->stack_ref =& $pos;
    }
    public function pop_pos()
    {
        unset($this->stack[count($this->stack) - 1]);
        $this->stack[count($this->stack) - 1];
        $this->stack_ref;
        /* =& ; (=& ..?) easytoyou_error_decompile */
    }
    public function parse($strInputXML)
    {
        $this->resParser = xml_parser_create();
        xml_set_object($this->resParser, $this);
        xml_set_element_handler($this->resParser, "tagOpen", "tagClosed");
        xml_set_character_data_handler($this->resParser, "tagData");
        $this->push_pos($this->arrOutput);
        foreach (str_split($strInputXML, 16384) as $part) {
            $this->strXmlData = xml_parse($this->resParser, $part);
            if (!$this->strXmlData) {
                var_dump(sprintf("XML error: %s at line %d", xml_error_string(xml_get_error_code($this->resParser)), xml_get_current_line_number($this->resParser)));
                exit;
            }
        }
        xml_parser_free($this->resParser);
        return $this->arrOutput;
    }
    public function tagOpen($parser, $name, $attrs)
    {
        if (isset($this->stack_ref[$name])) {
            if (!isset($this->stack_ref[$name][0])) {
                $tmp = $this->stack_ref[$name];
                unset($this->stack_ref[$name]);
                $this->stack_ref[$name][0] = $tmp;
            }
            $cnt = count($this->stack_ref[$name]);
            $this->stack_ref[$name][$cnt] = [];
            if (isset($attrs)) {
                $this->stack_ref[$name][$cnt] = $attrs;
            }
            $this->push_pos($this->stack_ref[$name][$cnt]);
        } else {
            $this->stack_ref[$name] = [];
            if (isset($attrs)) {
                $this->stack_ref[$name] = $attrs;
            }
            $this->push_pos($this->stack_ref[$name]);
        }
    }
    public function tagData($parser, $tagData)
    {
        if (trim($tagData)) {
            if (isset($this->stack_ref["DATA"])) {
                $this->stack_ref["DATA"] .= $tagData;
            } else {
                $this->stack_ref["DATA"] = $tagData;
            }
        }
    }
    public function tagClosed($parser, $name)
    {
        $this->pop_pos();
    }
}

?>