<?php
/**
 * Created by PhpStorm.
 * User: BSP-Developer1
 * Date: 05-Jan-18
 * Time: 12:27
 */
namespace App\Http\Controllers;

use App\HealthCheckup;
use App\Service;
use App\ServiceCategory;
use App\ServicePriceMinute;
use App\SiteSetting;
use App\SiteSettings;
use App\User;
use App\Http\Controllers;
use App\Http\Controllers\BSPController;
use App\VersionCodeList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;

class SiteSettingController extends  Controller {

    public function site_setting()
    {
        $site_settings = DB::table('site_setting')->orderBy('ss_id','desc')->get();

        return response()->view('site-setting.site-setting',[
            'site_settings'=>$site_settings[0]]);
    }

    public function site_setting_update()
    {
        $success = DB::table('site_setting')->insertGetId([
            'ss_total_amount' => $_POST['ss_total_amount'],
            'ss_entry_fees' => $_POST['ss_entry_fees'],
            'ss_donation' => $_POST['ss_donation'],
            'ss_discount' => $_POST['ss_discount'],
            'ss_discount_amount' => $_POST['ss_discount_amount'],
            'ss_add_date' => time(),
        ]);

        if(isset($success)&& !empty($success)) {
            Session::put('SUCCESS','TRUE');
            Session::put('MESSAGE', 'Site Setting Updated successfully.');
        }
        else{
            Session::put('SUCCESS','TRUE');
            Session::put('MESSAGE', 'Error while Updating.');
        }
        return redirect()->back();
    }

}