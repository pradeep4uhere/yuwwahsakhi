<?php
use App\Models\DigitalProficiencyLevel;
use App\Models\EducationLevel;
use App\Models\SpecificationQualification;
use App\Models\ServicesOffered;
use App\Models\LoanType;
use Illuminate\Support\Facades\Crypt;





if (!function_exists('encryptString')) {
    function encryptString($string)
    {
        return Crypt::encryptString($string);
    }
}

if (!function_exists('decryptString')) {
    function decryptString($string)
    {
        return Crypt::decryptString($string);
    }
}


/**
 * DigitalProficiencyLevels List
 */
if (!function_exists('getDigitalProficiencyLevels')) {
    function getDigitalProficiencyLevels()
    {
        // Fetch all levels from the database and return them as an array
        return DigitalProficiencyLevel::all()->toArray();
    }
}


/**
 * DigitalProficiencyLevels List Used For DropDown
 */
if (!function_exists('getDropDownDigitalProficiencyLevels')) {
    function getDropDownDigitalProficiencyLevels()
    {
        $dataList = [];
        // Call the original method to fetch the levels
        $list = getDigitalProficiencyLevels();
        foreach($list as $k=>$value){
            $dataList[] = [
                    'title'=>$value['proficiency_level'],
                    'status'=>$value['status'],
            ];
        }
        // You could add additional formatting or processing here if necessary
        return $dataList;
    }
}



/**
 * Education List From Database
 */

if (!function_exists('getEducationList')) {
    function getEducationList()
    {
        // Fetch all levels from the database and return them as an array
        return EducationLevel::all()->toArray();
    }
}


/**
 * Education List Used for List
 */
if (!function_exists('getDropDownEducationList')) {
    function getDropDownEducationList()
    {
        $dataList = [];
        // Call the original method to fetch the levels
        $list = getEducationList();
        foreach($list as $k=>$value){
            $dataList[] = [
                    'title'=>$value['level'],
                    'status'=>$value['status'],
            ];
        }
        // You could add additional formatting or processing here if necessary
        return $dataList;
    }
}




/**
 * Specification Qualification From Database
 */

 if (!function_exists('getSpecificationQualification')) {
    function getSpecificationQualification()
    {
        // Fetch all levels from the database and return them as an array
        return SpecificationQualification::all()->toArray();
    }
}


/**
 * Specification Qualification Used for List
 */
if (!function_exists('getDropDownSpecificationQualificationList')) {
    function getDropDownSpecificationQualificationList()
    {
        $dataList = [];
        // Call the original method to fetch the levels
        $list = getSpecificationQualification();
        foreach($list as $k=>$value){
            $dataList[] = [
                    'title'=>$value['qualification'],
                    'status'=>$value['status'],
            ];
        }
        // You could add additional formatting or processing here if necessary
        return $dataList;
    }
}





/**
 * Specification Qualification From Database
 */

 if (!function_exists('getServiceOffered')) {
    function getServiceOffered()
    {
        // Fetch all levels from the database and return them as an array
        return ServicesOffered::all()->toArray();
    }
}


/**
 * Specification Qualification Used for List
 */
if (!function_exists('getDropDownServiceOfferedList')) {
    function getDropDownServiceOfferedList()
    {
        $dataList = [];
        // Call the original method to fetch the levels
        $list = getServiceOffered();
        foreach($list as $k=>$value){
            $dataList[] = [
                    'title'=>$value['service_name'],
                    'status'=>$value['status'],
            ];
        }
        // You could add additional formatting or processing here if necessary
        return $dataList;
    }
}




/**
 * Specification Qualification From Database
 */

 if (!function_exists('getLoanTypeList')) {
    function getLoanTypeList()
    {
        // Fetch all levels from the database and return them as an array
        return LoanType::all()->toArray();
    }
}


/**
 * Specification Qualification Used for List
 */
if (!function_exists('getDropDownLoanTypeList')) {
    function getDropDownLoanTypeList()
    {
        $dataList = [];
       
        // Call the original method to fetch the levels
        $list = getLoanTypeList();
        foreach($list as $k=>$value){
            $dataList[] = [
                    'title'=>$value['loan_type'],
                    'status'=>$value['status'],
            ];
        }
        // You could add additional formatting or processing here if necessary
        return $dataList;
    }
}










if (! function_exists('generateRandomCar')) {
    /**
     * Generate a random string for partner_id
     *
     * @param int $length
     * @return string
     */
    function generateRandomCar($length = 5)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}





if (!function_exists('getEnglishProficiencyLevels')) {
    /**
     * Get a list of English proficiency levels.
     *
     * @return array
     */
    function getEnglishProficiencyLevels()
    {
        return [
            'Basic',
            'Intermediate',
            'Advanced',
        ];
    }
}





if (!function_exists('getSakhiRandomID')) {
    /**
     * Generate a random alphanumeric string of 10 characters.
     *
     * @return string
     */
    function getSakhiRandomID()
    {
        return strtoupper(Str::random(10));
    }
}


if (!function_exists('getGlobalValue')) {
    /**
     * Generate a random alphanumeric string of 10 characters.
     *
     * @return string
     */
    function getGlobalValue($modelType, $value)
    {
        // Map model types to corresponding attribute names
        $modelAttributes = [
            'EducationLevel' => 'level',
            'LoanType' => 'loan_type',
            'SpecificationQualification' => 'qualification',
            'ServicesOffered' => 'service_name',
            'DigitalProficiencyLevel' => 'proficiency_level',
        ];
    
        // Check if the modelType is valid
        if (array_key_exists($modelType, $modelAttributes)) {
            // Get the corresponding attribute name
            $attribute = $modelAttributes[$modelType];
    
            // Instantiate the model and find the record
            $modelClass = "App\\Models\\" . $modelType;
            $globalObj = $modelClass::find($value);
    
            // Check if the object exists and return the value of the attribute
            if ($globalObj) {
                return $globalObj->$attribute;
            } else {
                return null; // or return some default value or error message
            }
        }
    
        return null; // Return null if modelType is invalid
    }
}




if (!function_exists('getGlobalList')) {
    function getGlobalList($modelName)
    {
        // Define the model mapping
        $models = [
            'DigitalProficiencyLevel' => DigitalProficiencyLevel::class,
            'SpecificationQualification' => SpecificationQualification::class,
            'ServicesOffered' => ServicesOffered::class,
            'LoanType' => LoanType::class,
            'EducationLevel' => EducationLevel::class,
        ];

         // Map model types to corresponding attribute names
         $modelAttributes = [
            'DigitalProficiencyLevel' => 'proficiency_level',
            'SpecificationQualification' => 'qualification',
            'ServicesOffered' => 'service_name',
            'LoanType' => 'loan_type',
            'EducationLevel' => 'level',
        ];

      

        // Check if the model exists
        if (!isset($models[$modelName])) {
            return []; // Return empty if model is not found
        }
       // echo $modelAttributes[$modelName];die;
        // Fetch data using Eloquent and return as an options list
        return $models[$modelName]::where('status', 1)->pluck($modelAttributes[$modelName], 'id')->toArray();

        
    }
}


if (!function_exists('getYouTubeVideoId')) {
    function getYouTubeVideoId($url) {
        preg_match("/(?:v=|\/embed\/|\/youtu.be\/|\/v\/|\/watch\?v=|&v=)([a-zA-Z0-9_-]{11})/", $url, $matches);
        return $matches[1] ?? null;
    }
}



