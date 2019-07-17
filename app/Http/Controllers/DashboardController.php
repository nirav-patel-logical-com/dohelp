<?php
/**
 * Created by PhpStorm.
 * User: vidhi_BSP
 * Date: 7/17/2019
 * Time: 6:12 PM
 */

namespace App\Http\Controllers;


class DashboardController extends Controller{

    public function dashboard()
    {
            return response()
                ->view('dashboard.dashboard');

    }

}