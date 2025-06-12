<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
  use HasFactory;
  protected $table = 'scholarship';

  protected $fillable = [
    'scholarshipType',
    'newOrReEntry',
    'firstName',
    'lastName',
    'emailAddress',
    'phoneNumber',
    'streetAddress',
    'city',
    'state',
    'zip',
    'programInterest',
    'admissionsAdvisor',
    'agreeSignature',
    'agreeSMS',
    'signatureTextInput',
    'dateSigned',
  ];
}
