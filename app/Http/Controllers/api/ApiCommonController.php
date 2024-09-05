<?php

namespace App\Http\Controllers\api;

use Illuminate\Routing\Controller as BaseController;

class ApiCommonController extends BaseController
{
    function processName($contactnamein){
        $contactnamein = strtolower($contactnamein);
        $contact_person_name_array=explode(' ',$contactnamein);
        $finalname="";
        foreach ($contact_person_name_array as $name) {
            $finalname=$finalname." ".ucfirst($name);
        }
        return trim($finalname); // Trim to remove any leading/trailing spaces
        }
}