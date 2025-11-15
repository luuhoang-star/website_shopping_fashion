<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard(Request $request) {
        $data['TotalOrder'] = Order::getTotalOrder();
        $data['TotalTodayOrder'] = Order::getTotalTodayOrder();
        $data['TotalAmount'] = Order::getTotalAmount();
        $data['TotalTodayAmount'] = Order::getTotalTodayAmount();   
        $data['TotalCustomer'] = User::getTotalCustomer();
        $data['TotalTodayCustomer'] = User::getTotalTodayCustomer();
        $data['getLatestOrder'] = Order::getLatestOrder();  
        
        if(!empty($request->year)) {
            $year = $request->year;
        } else {
            $year = date('Y');
        }

        $getTotalOrderMonth = '';
        $getTotalOrderAmountMonth = '';
        $getTotalCustomerMonth = '';

        $totalAmount = 0;

        for($month = 1; $month <= 12; $month++) {
            $startDate = new \DateTime("$year-$month-01");
                $endDate = new \DateTime("$year-$month-01");
                $endDate->modify('last day of this month');

                $start_date = $startDate->format('Y-m-d');
                $end_date = $endDate->format('Y-m-d');

                $customer = User::getTotalCustomerMonth($start_date, $end_date);
                $getTotalCustomerMonth .= $customer . ',';

                $order = Order::getTotalOrderMonth($start_date, $end_date);
                $getTotalOrderMonth .= $order . ',';

                $orderpayment = Order::getTotalOrderAmountMonth($start_date, $end_date);
                $getTotalOrderAmountMonth .= $orderpayment . ',';

                $totalAmount = $totalAmount + $orderpayment;




        }
        $data['getTotalCustomerMonth'] = rtrim($getTotalCustomerMonth, ",");
        $data['getTotalOrderMonth'] = rtrim($getTotalOrderMonth, ",");
        $data['getTotalOrderAmountMonth'] = rtrim($getTotalOrderAmountMonth, ",");
        $data['year'] = $year;
        $data['getTotalAmount'] = $totalAmount;
        $data['header_title'] = "Dashboard";
        return view('admin.dashboard', $data);
    }
        
}
