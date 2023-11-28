<?php

namespace Arkcode\Addchat\Http\Controllers;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Crypt;

use App\Http\Controllers\Controller; 

use Illuminate\Http\Request;
use Facades\Arkcode\Addchat\Addchat;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use Arkcode\Addchat\Http\Controllers\AddchatController;

class UserGroupController extends AddchatController
{
    public function __construct()
    {
	    Parent::__construct();
    }
    
    

}