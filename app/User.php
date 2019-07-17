<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function check_user_login($mobile,$mobile_country_code)
    {
        $collection = DB::table($this->table)
            ->Where('user_status', 'Active')
            ->Where('user_mobile', $mobile)
            ->Where('user_mobile_country_code', $mobile_country_code)
            ->Where('user_role_name','!=','Admin')
            ->get();

        return $collection->toArray();
    }
    public function check_admin_login($mobile,$mobile_country_code)
    {
        $collection = DB::table($this->table)
            ->Where('user_status', 'Active')
            ->Where('user_mobile', $mobile)
            ->Where('user_mobile_country_code', $mobile_country_code)
            ->Where('user_role_name','=','Admin')
            ->get();

        return $collection->toArray();
    }
    public function get_user_list($start, $limit)
    {
        return DB::table($this->table)
            ->select('id',
                    'user_name',
                    'user_mobile_country_code',
                    'user_mobile',
                    'user_city',
                    'user_reference_number',
                    'user_status',
                    'user_add_date',
                    'user_details_id',
                    'user_bank_name',
                    'user_bank_number',
                    'user_IFSC_code',
                    'user_bank_branch',
                    'user_phone_pay_number',
                    'user_paytm_number',
                    'user_google_pay_number',
                    'user_details_amount',
                    'user_details_payment_date',
                    'user_details_image'
                    )
            ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
            ->Where('id','<', $start)
            ->limit($limit)
            ->Where('user_role_name','!=','Admin')
            ->get();
    }
    public function get_user_details_by_user_id($user_id)
    {
        return DB::table($this->table)
            ->select('id',
                'user_name',
                'user_mobile_country_code',
                'user_mobile',
                'user_city',
                'user_reference_number',
                'user_status',
                'user_add_date',
                'user_details_id',
                'user_bank_name',
                'user_bank_number',
                'user_IFSC_code',
                'user_bank_branch',
                'user_phone_pay_number',
                'user_paytm_number',
                'user_google_pay_number',
                'user_details_amount',
                'user_details_payment_date',
                'user_details_image'
            )
            ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
            ->Where('user_role_name','!=','Admin')
            ->Where('id','=',$user_id)
            ->get();
    }
    public function check_reference_number($user_reference_number){
        return DB::table($this->table)
            ->Where('user_reference_number', $user_reference_number)
            ->Where('user_role_name','!=','Admin')
            ->value('user_reference_number');
    }
    function get_user_password_by_user_id($user_id)
    {
        $sql = "
         	SELECT
         	      id,
         	      password
         	FROM $this->table
         	WHERE $this->table.id = $user_id
       ";
        $results = DB::select(DB::raw($sql));
        return $results;
    }
}
