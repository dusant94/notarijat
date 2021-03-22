<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'phone',
        'fax',
        'email'
    ];
    public function workers(){
        return $this->hasMany(User::class,'office_id' , 'id');
    }
    public function accessRequests(){
        return $this->hasMany(AccessRequest::class,'office_id','id');
    }
    public function naturalClients(){
        return $this->hasMany(NaturalPeople::class,'office_id','id');
    }
    public function legalEntityClients(){
        return $this->hasMany(LegalEntity::class,'office_id','id');
    }
 }
