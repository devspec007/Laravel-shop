<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class OperationLog extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'module', 'operation', 'message', 'module_id', 'ip', 'data'];

    public static function createLog($operation, $message, $module, $module_id= null, $data = null)
    {
        
        OperationLog::create([
            'user_id' => Auth::id(),
            'operation' => $operation,
            'message' => $message,
            'module' => $module,
            'module_id' => $module_id,
            'ip' => \Request::getClientIp(true)
           
        ]);
    }
}
