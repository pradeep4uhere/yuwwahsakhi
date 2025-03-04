<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YuwaahSakhi extends Model
{
    use HasFactory;

     // Define the table name if it's not the plural form of the model
     protected $table = 'yuwaah_sakhi';

     // Define fillable fields
    protected $fillable = [
        'sakhi_id',
        'name',
        'contact_number',
        'email',
        'dob',
        'gender',
        'education_level',
        'specific_qualification',
        'loan_taken',
        'type_of_loan',
        'loan_amount',
        'loan_balance',
        'english_proficiency',
        'year_of_exp',
        'kof',
        'work_hour_in_day',
        'infrastructure_available',
        'service_offered',
        'courses_completed',
        'digital_proficiency',
        'state',
        'city',
        'address',
        'status',
        'center_picture',
        'profile_picture',
    ];



     /**
     * All Pater Count For Admin Panel
     */
    public static function getAllCount(){
        return self::count();
    }


    public static function getFormatedData(YuwaahSakhi $yuwaahSakhi){
        $data = [
            'id'=>$yuwaahSakhi['id'],
            'sakhiId'=>$yuwaahSakhi['sakhi_id'],
            'Name'=>$yuwaahSakhi['name'],
            'ContactNumber'=>$yuwaahSakhi['contact_number'],
            'Email'=>$yuwaahSakhi['contact_number'],
            'DateOfBirth'=>$yuwaahSakhi['dob'],
            'Gender'=>$yuwaahSakhi['gender'],
            'EducationLevel'=>getGlobalValue('EducationLevel',$yuwaahSakhi['education_level']),
            'SpecificQualification'=>getGlobalValue('EducationLevel',$yuwaahSakhi['specific_qualification']),
            'LoanTaken'=>$yuwaahSakhi['loan_taken'],
            'TypeOfLoan'=>$yuwaahSakhi['type_of_loan'],
            'LoanAmount'=>$yuwaahSakhi['loan_amount'],
            'LoanBalance'=>$yuwaahSakhi['loan_balance'],
            'EnglishProficiency'=>$yuwaahSakhi['english_proficiency'],
            'YearOfExp'=>$yuwaahSakhi['year_of_exp'],
            'KnowledgeOf'=>$yuwaahSakhi['kof'],
            'WorkHourInDay'=>$yuwaahSakhi['work_hour_in_day'],
            'InfrastructureAvailable'=>($yuwaahSakhi['infrastructure_available']==1)?"Yes":"No",
            'ServiceOffered'=>getGlobalValue('ServiceOffered',$yuwaahSakhi['service_offered']),
            'CoursesCompleted'=>$yuwaahSakhi['courses_completed'],
            'DigitalProficiency'=>getGlobalValue('DigitalProficiency',$yuwaahSakhi['digital_proficiency']),
            'State'=>$yuwaahSakhi['state'],
            'City'=>$yuwaahSakhi['city'],
            'Address'=>$yuwaahSakhi['address'],
            'Status'=>($yuwaahSakhi['status']==1)?'Active':'InActive',
            'CenterPicture'=>asset('/storage/'.$yuwaahSakhi['center_picture']),
            'ProfilePicture'=>asset('/storage/'.$yuwaahSakhi['profile_picture'])
        ];

        return $data;

    }




    public static function getFormatedPaginationData($datawithPagination)
    {
        // Format each item in the paginated collection
        $formattedData = $datawithPagination->getCollection()->map(function ($modelobject) {
            return self::getFormatedData($modelobject);  // Call the method to format individual opportunity
        });
    
        return [
            'data' => $formattedData,
            'current_page' => $datawithPagination->currentPage(),
            'per_page' => $datawithPagination->perPage(),
            'total' => $datawithPagination->total(),
            'last_page' => $datawithPagination->lastPage(),
            'next_page_url' => $datawithPagination->nextPageUrl(),
            'prev_page_url' => $datawithPagination->previousPageUrl(),
        ];
    }



}
