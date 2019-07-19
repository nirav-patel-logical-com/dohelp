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
                    'user_gender',
                    'user_image',
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
                'user_gender',
                'user_image',
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
                'user_details_by',
                'user_details_image'
            )
            ->leftJoin('user_details', 'users.id', '=', 'user_details.user_id')
            ->Where('user_role_name','!=','Admin')
            ->Where('id','=',$user_id)
            ->get();
    }

    public function get_user_details_for_dashboard($user_id)
    {
        return DB::table($this->table)
            ->select('id',
                'user_name',
                'user_mobile_country_code',
                'user_mobile',
                'user_city',
                'user_reference_number',
                'user_gender',
                'user_image',
                'user_add_date'
            )
            ->Where('user_role_name','!=','Admin')
            ->Where('id','=',$user_id)
            ->get();
    }
    public function get_paid_user_list($user_id){
        $sql = "
         	SELECT
         	    $this->table.`user_name`,
         	    $this->table.`id`
         	FROM $this->table
            JOIN fees_details ON $this->table.id = fees_details.fees_user_id
            LEFT JOIN paid_help ON fees_details.fees_id = paid_help.fess_id
         	WHERE $this->table.id != $user_id
		";

        $results = DB::select(DB::raw($sql));
        return $results;
    }
    public function get_help_count($user_id){
        return DB::table('get_help')
            ->Where('assign_id','=',$user_id)
            ->count();
    }
    public function paid_help_count($user_id){
        return DB::table('paid_help')
            ->Where('assign_id','=',$user_id)
            ->count();
    }

    public function get_get_user_list($user_id){
        $sql = "
         	SELECT
         	    $this->table.`user_name`,
         	    $this->table.`id`
         	FROM $this->table
            JOIN fees_details ON $this->table.id = fees_details.fees_user_id
            LEFT JOIN get_help ON fees_details.fees_id = get_help.fess_id
         	WHERE $this->table.id != $user_id
		";

        $results = DB::select(DB::raw($sql));
        return $results;
    }
    public function getUserList($start, $limit, $order, $dir, $search = ''){

        $con = "AND $this->table.user_role_name != 'Admin'";

        $search_con = '';

        if (isset($search) && !empty($search)) {
            $search_con = "AND (
            users.id LIKE '%" . $search . "%'
            OR
            users.user_name LIKE '%" . $search . "%'
            OR
            users.user_mobile LIKE '%" . $search . "%'
            OR
            users.user_city LIKE '%" . $search . "%'
            OR
            users.user_reference_number LIKE '%" . $search . "%'
            OR
            users.user_unique_id LIKE '%" . $search . "%'
            OR
            users.user_status LIKE '%" . $search . "%'
            )";
        }
        $sql = "
         	SELECT
         	    `user_name`,
         	    `id`,
                `user_mobile_country_code`,
                `user_mobile`,
                `user_unique_id`,
                `user_gender`,
                `user_image`,
                `user_city`,
                `user_reference_number`,
                `user_status`,
                `user_add_date`
         	FROM $this->table
         	WHERE 1
         	$con
         	$search_con
         	ORDER BY users.$order $dir
         	LIMIT $start, $limit
		";

        $results = DB::select(DB::raw($sql));
        return $results;
    }
    public function check_reference_number($user_reference_number){
        return DB::table($this->table)
            ->Where('user_reference_number', $user_reference_number)
            ->Where('user_role_name','!=','Admin')
            ->value('user_reference_number');
    }
    public function check_mobile_exist($user_mobile){
        return DB::table($this->table)
            ->Where('user_mobile', $user_mobile)
            ->value('id');
    }
    public function check_old_image($user_id){
        return DB::table($this->table)
            ->Where('id', $user_id)
            ->value('user_image');
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
    public function check_user_is_admin($user_mobile){
        return DB::table($this->table)
            ->Where('user_mobile', $user_mobile)
            ->Where('user_role_name','=','Admin')
            ->value('user_mobile');
    }
}
