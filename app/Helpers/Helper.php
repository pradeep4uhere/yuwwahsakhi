<?php
use App\Models\DigitalProficiencyLevel;
use App\Models\EducationLevel;
use App\Models\SpecificationQualification;
use App\Models\ServicesOffered;
use App\Models\LoanType;
use App\Models\State;
use App\Models\District;
use App\Models\Block;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth; 
    
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
        return $models[$modelName]::where('status', 1)->orWhere('status', 'active')->pluck($modelAttributes[$modelName], 'id')->toArray();

        
    }
}


if (!function_exists('getYouTubeVideoIds')) {
    function getYouTubeVideoIds($url) {
        preg_match("/(?:v=|\/embed\/|\/youtu.be\/|\/v\/|\/watch\?v=|&v=)([a-zA-Z0-9_-]{11})/", $url, $matches);
        return $matches[1] ?? null;
    }
}

if (!function_exists('getYouTubeVideoId')) {
    function getYouTubeVideoId($url) {
        // Check if URL is empty
        if (!$url) return '';
    
        // Match video ID from different YouTube URL formats
        preg_match('/(youtu\.be\/|youtube\.com\/(watch\?v=|embed\/|v\/|shorts\/|user\/.*?v=))([^?&]+)/', $url, $matches);
    
        // If a match is found, return the embed URL
        return isset($matches[3]) ? "https://www.youtube.com/embed/" . $matches[3] : '';
    }
}


if (!function_exists('getYuwaahSakhiID')) {
    function getYuwaahSakhiID($id, $partnerId, $partnerCenterId) {
        return 'YS'.$id.$partnerId.$partnerCenterId;
        
    }
}



/**
 * All Yuwaah Sakhi auth user details
 */
if (!function_exists('getYuwaahSakhiAuthID')) {
    function getYuwaahSakhiAuthID() {
        return Auth::guard('web')->user()->sakhi_id;
    }
}

if (!function_exists('getYuwaahSakhiAuthCenterName')) {
    function getYuwaahSakhiAuthCenterName() {
        $user = Auth::guard('web')->user();

        if (!$user) {
            return null; // or 'Guest'
        }

        // Check if PartnerCenter relationship is defined and not null
        if (method_exists($user, 'PartnerCenter') && $user->PartnerCenter) {
            return $user->PartnerCenter->center_name;
        }

        // Alternatively, fetch manually if foreign key exists (e.g. partner_center_id)
        if (isset($user->partner_center_id)) {
            return \App\Models\PartnerCenter::find($user->partner_center_id)?->center_name ?? null;
        }

        return null;
    }
}


if (!function_exists('getYuwaahSakhiAuthOnBoardedDate')) {
    function getYuwaahSakhiAuthOnBoardedDate() {
        return Auth::guard('web')->user()->onboard_date;
    }
}


if (!function_exists('getYuwaahSakhiAuthProfileImage')) {
    function getYuwaahSakhiAuthProfileImage() {
        $profile_picture =  Auth::guard('web')->user()->profile_picture;
        return $profile_picture;
    }
}



if (!function_exists('getdateformate')) {
    function getdateformate($date) {
        return date('d M, Y',strtotime($date));
    }
}

if (!function_exists('getUserId')) {
    function getUserId() {
        return Auth::user()->id;
    }
}



if (!function_exists('getSakhiID')) {
    function getSakhiID() {
        return Auth::user()->sakhi_id;
    }
}

if (!function_exists('getStateList')) {
    function getStateList($name = 'state_id', $selected = null, $class = 'form-control', $onChange = '')
    {
        $states = State::all()->pluck('name', 'id')->toArray();

        // Handle optional onchange attribute
        $onChangeAttr = $onChange ? "onchange=\"$onChange\"" : "";

        $html = "<select name=\"{$name}\" id=\"{$name}\" class=\"{$class}\" {$onChangeAttr}>";
        $html .= "<option value=\"\">Select State</option>";

        foreach ($states as $id => $stateName) {
            $isSelected = $selected == $id ? 'selected' : '';
            $html .= "<option value=\"{$id}\" {$isSelected}>{$stateName}</option>";
        }

        $html .= "</select>";

        return $html;
    }
}



if (!function_exists('getDistrict')) {
    /**
     * Returns an HTML <select> dropdown of districts for the given state ID.
     *
     * @param int|null $stateId
     * @param string $name
     * @param int|null $selected
     * @param string $class
     * @param string|null $onchange JS function name (e.g. getBlockList(this.value))
     * @return string
     */
    function getDistrict($stateId = null, $name = 'district_id', $selected = null, $class = 'form-control', $onchange = null)
    {
        $onchangeAttr = $onchange ? "onchange=\"{$onchange}\"" : '';

        if (!$stateId) {
            return "<select name=\"{$name}\" class=\"{$class}\" id='district_id' {$onchangeAttr}><option value=\"\">Select State First</option></select>";
        }

        $districts = District::where('state_id', $stateId)->pluck('name', 'id')->toArray();

        $html = "<select name=\"{$name}\" class=\"{$class}\" id='district_id' {$onchangeAttr}>";
        $html .= "<option value=\"\">Select District</option>";

        foreach ($districts as $id => $districtName) {
            $isSelected = $selected == $id ? 'selected' : '';
            $html .= "<option value=\"{$id}\" {$isSelected}>{$districtName}</option>";
        }

        $html .= "</select>";

        return $html;
    }
}


if (!function_exists('getBlock')) {
    /**
     * Returns an HTML <select> dropdown of blocks for the given district ID.
     *
     * @param int|null $districtId
     * @param string $name
     * @param int|null $selected
     * @param string $class
     * @return string
     */
    function getBlock($districtId = null, $name = 'block_id', $selected = null, $class = 'form-control')
    {
        if (!$districtId) {
            return "<select name=\"{$name}\" class=\"{$class}\" id=\"block_id\"><option value=\"\">Select District First</option></select>";
        }

        $blocks = \App\Models\Block::where('district_id', $districtId)->pluck('name', 'id')->toArray();

        $html = "<select name=\"{$name}\" class=\"{$class}\" id=\"block_id\">";
        $html .= "<option value=\"\">Select Block</option>";

        foreach ($blocks as $id => $blockName) {
            $isSelected = $selected == $id ? 'selected' : '';
            $html .= "<option value=\"{$id}\" {$isSelected}>{$blockName}</option>";
        }

        $html .= "</select>";

        return $html;
    }
}



if (!function_exists('getformateDate')) {
    /**
     * Format a date string to a given format.
     *
     * @param string $date
     * @param string $format (optional, default: 'd M, Y h:i A')
     * @return string|null
     */
    function getformateDate($date, $format = 'd M, Y h:i A') {
        if (!$date || strtotime($date) === false) {
            return null; // or return ''; if you prefer
        }

        return date($format, strtotime($date));
    }
}







