<?php
/*
 * @ https://EasyToYou.eu - IonCube v11 Decoder Online
 * @ PHP 7.2
 * @ Decoder version: 1.0.4
 * @ Release: 01/09/2021
 */

namespace ModulesGarden\Servers\ZimbraEmail\Core\Models\Whmcs;

/**
 * Description of Product
 *
 * @author Paweł Złamaniec <pawel.zl@modulesgarden.com>
 */
class Ticket extends \Illuminate\Database\Eloquent\Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = "tbltickets";
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
    protected $fillable = ["tid", "did", "userid", "contactid", "name", "email", "cc", "c", "date", "title", "message", "status", "urgency", "admin", "attachment", "lastreply", "flag", "clientunread", "adminunread", "replyingadmin", "replyingtime", "service", "merged_ticket_id", "editor"];
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
    public function client()
    {
        return $this->belongsTo("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\Client", "userid");
    }
    public function clientRC()
    {
        return $this->belongsTo("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\ResellerClient", "userid", "client_id");
    }
    public function replies()
    {
        return $this->hasMany("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\TicketReply", "tid");
    }
    public function department()
    {
        return $this->belongsTo("ModulesGarden\\Servers\\ZimbraEmail\\Core\\Models\\Whmcs\\TicketDepartment", "did");
    }
    public function updateStatus($status)
    {
        $this->status = $status;
        $this->save();
    }
}

?>