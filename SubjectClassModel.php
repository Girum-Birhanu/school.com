<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectClassModel extends Model
{
    protected $table = 'subject_class';

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function checkClassSubject($created_by_id, $class_id, $subject_id)
    {
        return SubjectClassModel::where('created_by_id', '=', $created_by_id)
                                ->where('class_id', '=', $class_id)
                                ->where('subject_id', '=', $subject_id) 
                                ->where('is_delete', '=', 0)
                                ->count();
    }
    
    static public function getSelectedSubject($class_id, $created_by_id)
    {
        return SubjectClassModel::select('subject_class.*', 'subject.name as subject_name')
            ->join('subject', 'subject.id', '=', 'subject_class.subject_id')
            ->where('subject_class.created_by_id', '=', $created_by_id) 
            ->where('subject_class.class_id', '=', $class_id) 
            ->where('subject_class.is_delete', '=', 0)
            ->get();
    }
    

   

    static public function  deleteClassSubject($class_id, $created_by_id)
    {
        return SubjectClassModel::where('created_by_id', '=', $created_by_id)
                                ->where('class_id', '=', $class_id) 
                                ->delete();
    }

    public static function getRecord($user_id, $user_type)
    {
        $query = self::select('subject_class.*', 'class.name as class_name', 'subject.name as subject_name')
            ->join('class', 'class.id', '=', 'subject_class.class_id')
            ->join('subject', 'subject.id', '=', 'subject_class.subject_id')
            ->when(request()->get('id'), fn($q, $id) => $q->where('subject_class.id', $id))
            ->when(request()->get('class_name'), fn($q, $class_name) => $q->where('class.name', 'like', "%$class_name%"))
            ->when(request()->get('subject_name'), fn($q, $subject_name) => $q->where('subject.name', 'like', "%$subject_name%"))
            ->when(request()->get('status'), function ($q, $status) {
                if ($status == 100) $status = 0;
                $q->where('subject_class.status', $status);
            })
            ->where('subject_class.created_by_id', '=', $user_id)
            ->where('subject_class.is_delete', 0)
            ->orderBy('subject_class.id', 'desc');
    
        return $query->paginate(12);
    }
    
    
    
}
