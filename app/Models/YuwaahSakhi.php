<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable; // Correct namespace

class YuwaahSakhi extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

     // Define the table name if it's not the plural form of the model
     protected $table = 'yuwaah_sakhi';
     public $timestamps = true;

     protected $primaryKey = 'id';


     public function getAuthIdentifierName()
    {
        return 'contact_number';
    }

     // Define fillable fields
    protected $fillable = [
        'sakhi_id',
        
        'name',
        'contact_number',
        'email',
        'csc_id',
        'password',
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
        'xd',
        'status',
        'block_id',
        'district',
        'pincode',
        'partner_id',
        'partner_center_id',
        'center_picture',
        'profile_picture',
        'remember_token',
    ];

    
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


     /**
     * All Pater Count For Admin Panel
     */
    public static function getAllCount(){
        return self::count();
    }


    public static function getFormatedData(YuwaahSakhi $yuwaahSakhi){
        //dd($yuwaahSakhi);
        $data = [
            'id'=>$yuwaahSakhi['id'],
            'sakhiId'=>$yuwaahSakhi['sakhi_id'],
            'Name'=>$yuwaahSakhi['name'],
            'CSC_ID'=>$yuwaahSakhi['csc_id'],
            'ContactNumber'=>$yuwaahSakhi['contact_number'],
            'Email'=>$yuwaahSakhi['email'],
            'DateOfBirth'=>$yuwaahSakhi['dob'],
            'Gender'=>$yuwaahSakhi['gender'],
            'EducationLevel'=>getGlobalValue('EducationLevel',$yuwaahSakhi['education_level']),
            'SpecificQualification'=>getGlobalValue('SpecificationQualification',$yuwaahSakhi['specific_qualification']),
            'LoanTaken'=>$yuwaahSakhi['loan_taken'],
            'TypeOfLoan'=>$yuwaahSakhi['type_of_loan'],
            'LoanAmount'=>$yuwaahSakhi['loan_amount'],
            'LoanBalance'=>$yuwaahSakhi['loan_balance'],
            'EnglishProficiency'=>$yuwaahSakhi['english_proficiency'],
            'YearOfExp'=>$yuwaahSakhi['year_of_exp'],
            'KnowledgeOf'=>$yuwaahSakhi['kof'],
            'WorkHourInDay'=>$yuwaahSakhi['work_hour_in_day'],
            'InfrastructureAvailable'=>($yuwaahSakhi['infrastructure_available']==1)?"Yes":"No",
            'ServiceOffered'=>getGlobalValue('ServicesOffered',$yuwaahSakhi['service_offered']),
            'CoursesCompleted'=>$yuwaahSakhi['courses_completed'],
            'DigitalProficiency'=>getGlobalValue('DigitalProficiencyLevel',$yuwaahSakhi['digital_proficiency']),
            'State'=>$yuwaahSakhi['State']['name']  ?? 'N/A',
            'City'=>$yuwaahSakhi['city'] ?? 'N/A',
            'District'=>$yuwaahSakhi['District']['name'] ?? 'N/A',
            'Block'=>$yuwaahSakhi['Block']['name'] ?? 'N/A',
            'Pincode'=>$yuwaahSakhi['pincode'],
            'Address'=>$yuwaahSakhi['address'],
            'Partner'=>optional($yuwaahSakhi->Partner)->name ?? 'N/A',
            'PartnerCenter'=>optional($yuwaahSakhi->PartnerCenter)->center_name ?? 'N/A',
            'Status'=>($yuwaahSakhi['status']==1)?'Active':'InActive',
            'CenterPicture' => $yuwaahSakhi['center_picture'] 
            ? asset('/storage/' . $yuwaahSakhi['center_picture']) 
            : asset('/asset/images/Profilelogo.png'),
            'ProfilePicture' => $yuwaahSakhi['profile_picture'] 
            ? asset('/storage/' . $yuwaahSakhi['profile_picture']) 
            : asset('/asset/images/Profilelogo.png'),
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



    public function Partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id');
    }


    public function partnerCenter()
    {
        return $this->belongsTo(PartnerCenter::class, 'partner_center_id');
    }

    public function State()
    {
        return $this->belongsTo(State::class, 'state');
    }

    public function District()
    {
        return $this->belongsTo(District::class, 'district');
    }

    public function Block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }


    public function partnerPlacementUser()
    {
        return $this->belongsTo(PartnerPlacementUser::class, 'partner_placement_user_id');
    }

}
