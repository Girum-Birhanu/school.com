<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * 
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     * 
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Get a single user by ID.
     */
    public static function getSingle($id)
    {
        return self::find($id);
    }

    /**
     * Get all admin users based on filters.
     */
    public static function getAdmin()
    {
        return self::query()
            ->when(request()->get('id'), fn($q, $id) => $q->where('id', $id))
            ->when(request()->get('is_admin'), fn($q, $isAdmin) => $q->where('is_admin', $isAdmin))
            ->when(request()->get('name'), fn($q, $name) => $q->where('name', 'like', "%$name%"))
            ->when(request()->get('email'), fn($q, $email) => $q->where('email', 'like', "%$email%"))
            ->when(request()->get('address'), fn($q, $address) => $q->where('address', 'like', "%$address%"))
            ->when(request()->get('status'), function ($q, $status) {
                if ($status == 100) $status = 0;
                $q->where('status', $status);
            })
            ->whereIn('is_admin', [1, 2])
            ->where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->paginate(12);
    }

    /**
     * Get all schools.
     */
    public static function getSchoolAll()
    {
        return self::where('is_admin', 3)
            ->where('is_delete', 0)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->get();
    }

    /**
     * Get all school users based on filters.
     */
    public static function getSchool()
    {
        return self::query()
            ->when(request()->get('id'), fn($q, $id) => $q->where('id', $id))
            ->when(request()->get('name'), fn($q, $name) => $q->where('name', 'like', "%$name%"))
            ->when(request()->get('email'), fn($q, $email) => $q->where('email', 'like', "%$email%"))
            ->when(request()->get('status'), function ($q, $status) {
                if ($status == 100) $status = 0;
                $q->where('status', $status);
            })
            ->where('is_admin', 3)
            ->where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->paginate(12);
    }

    /**
     * Get teachers based on filters.
     */
    public static function getTeacher($user_id, $user_type)
    {
        return self::query()
            ->when(request()->get('id'), fn($q, $id) => $q->where('id', $id))
            ->when(request()->get('name'), fn($q, $name) => $q->where('name', $name))
            ->when(request()->get('email'), fn($q, $email) => $q->where('email', 'like', "%$email%"))
            ->when(request()->get('Gender'), fn($q, $Gender) => $q->where('Gender', 'like', "%$Gender%"))
            ->when(request()->get('status'), function ($q, $status) {
                if ($status == 100) $status = 0;
                $q->where('status', $status);
            })
            ->when($user_type == 3, fn($q) => $q->where('created_by_id', $user_id))
            ->where('is_admin', 4)
            ->where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->paginate(12);
    }

    public static function getStudent($user_id, $user_type)
    {
        return self::query()
            ->when(request()->get('id'), fn($q, $id) => $q->where('id', $id))
            ->when(request()->get('name'), fn($q, $name) => $q->where('name', $name))
            ->when(request()->get('email'), fn($q, $email) => $q->where('email', 'like', "%$email%"))
            ->when(request()->get('Gender'), fn($q, $Gender) => $q->where('Gender', 'like', "%$Gender%"))
            ->when(request()->get('status'), function ($q, $status) {
                if ($status == 100) $status = 0;
                $q->where('status', $status);
            })
            ->when($user_type == 3, fn($q) => $q->where('created_by_id', $user_id))
            ->where('is_admin', 6)
            ->where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->paginate(12);
    }

    public static function getParent($user_id, $user_type)
    {
        return self::query()
            ->when(request()->get('id'), fn($q, $id) => $q->where('id', $id))
            ->when(request()->get('name'), fn($q, $name) => $q->where('name', $name))
            ->when(request()->get('email'), fn($q, $email) => $q->where('email', 'like', "%$email%"))
            ->when(request()->get('Gender'), fn($q, $Gender) => $q->where('Gender', 'like', "%$Gender%"))
            ->when(request()->get('status'), function ($q, $status) {
                if ($status == 100) $status = 0;
                $q->where('status', $status);
            })
            ->when($user_type == 3, fn($q) => $q->where('created_by_id', $user_id))
            ->where('is_admin', 7)
            ->where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->paginate(12);
    }

    public static function getParentMystudent($parent_id)
    {
        return self::query()
          
            ->where('parent_id','=',$parent_id)
            ->where('is_admin', 6)
            ->where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->get();
    }
    

    /**
     * Get school admin based on filters.
     */
    public static function getSchoolAdmin($user_id, $user_type)
    {
        return self::query()
            ->when(request()->get('id'), fn($q, $id) => $q->where('id', $id))
            ->when(request()->get('name'), fn($q, $name) => $q->where('name', $name))
            ->when(request()->get('email'), fn($q, $email) => $q->where('email', 'like', "%$email%"))
            ->when(request()->get('address'), fn($q, $address) => $q->where('address', 'like', "%$address%"))
            ->when(request()->get('status'), function ($q, $status) {
                if ($status == 100) $status = 0;
                $q->where('status', $status);
            })
            ->when($user_type == 3, fn($q) => $q->where('created_by_id', $user_id))
            ->where('is_admin', 4)
            ->where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->paginate(20);
    }

    
   
    /**
     * Get the creator of the user.
     */
    public function getCreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function  getParentData()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }


   

    public function getClass()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    /**
     * Get the profile picture URL.
     */
    public function getProfile()
    {
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic))
        {
            return url('upload/profile/'.$this->profile_pic);
        }
        else
        {
            return '';
        }
    }

    public function getProfileLive()
    {
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic))
        {
            return url('upload/profile/'.$this->profile_pic);
        }
        else
        {
            return url('upload/profile/avatar3.png');
        }
    }

}
