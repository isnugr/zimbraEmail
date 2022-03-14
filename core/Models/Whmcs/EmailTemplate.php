<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs;

/**
 * Description of Email Tempaltes
 *
 * @var int id
 * @var string type
 * @var string name
 * @var string subject
 * @var string message
 * @var string attachments
 * @var string fromname
 * @var string fromemail
 * @var int disabled
 * @var int custom
 * @var string language
 * @var string copyto
 * @var int plaintext
 * @var timestamp created_at
 * @var timestamp updated_at
 *
 * @author Paweł Złamaniec <pawel.zl@modulesgarden.com>
 */
class EmailTemplate extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tblemailtemplates";
    protected $primaryKey = "id";
    /**
     * Eloquent guarded parameters
     * @var array
     */
    protected $guarded = ["id"];
    /**
     * Eloquent fillable parameters
     * @var array
     */
    protected $fillable = ["type", "name", "subject", "message", "attachments", "fromname", "fromemail", "disabled", "custom", "language", "copyto", "plaintext", "created_at", "updated_at"];
    /**
     * Indicates if the model should soft delete.
     *
     * @var bool
     */
    protected $softDelete = false;
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }
}

?>