<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectModel extends Model
{
    protected $table = 'subject';

    static public function getSingle($id)
    {
        return SubjectModel::find($id);
    }

    public static function getRecord($user_id, $user_type)
    {
        return self::query()
            ->when(request()->get('id'), fn($q, $id) => $q->where('id', $id))
            ->when(request()->get('name'), fn($q, $name) => $q->where('name', 'like', "%$name%"))
            ->when(request()->get('status'), function ($q, $status) {
                if ($status == 100) $status = 0;
                $q->where('status', $status);
            })
            ->where('created_by_id', '=', $user_id)
            ->where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->paginate(12);
    }
    public static function getRecordActive($user_id)
    {
        return self::select('*')
            ->where('status', '=', 1)
            ->where('created_by_id', '=', $user_id)
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'desc')
            ->get();
    }
    
}
