<?php

 namespace App\Models;

 use Illuminate\Database\Eloquent\Model;

 class User extends Model{

    protected $table = 'city';
    // column sa table
    protected $fillable = [
    'Municipality', 'Barangay', 'Postal_Code',
    ];
 }