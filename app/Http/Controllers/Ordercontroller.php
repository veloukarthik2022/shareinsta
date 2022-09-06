<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Order, Customer, CustomerRewardPoints, CustomerWallet};

class Ordercontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $data = array(
            "customer_id" => $request->customer_id,
            "product_id" => $request->product_id,
            "price" => $request->price
        );

        $orderscount = Order::where("customer_id", $request->customer_id)->count();

        if($orderscount==1)
        {
            $orderscount = Order::where("customer_id", $request->customer_id)->count();

            if ($orderscount>0 || $orderscount >= 1) {

                // return $orderscount;
                $get_referral_id = CustomerRewardPoints::where("customer_id", $request->customer_id)->orderByDesc("id")->first();

                $updateWallet = CustomerRewardPoints::where("customer_id", $get_referral_id->referre_id)->first();

                // return $updateWallet;

                if ($updateWallet) {
                    $updateWallet->update(["points" => 500]);

                    $totalPoints =  CustomerRewardPoints::where("customer_id", $get_referral_id->referre_id)->sum('points');

                    return $totalPoints;

                    $updateWallet = CustomerWallet::where("customer_id", $get_referral_id->referre_id)->first();

                    if($updateWallet)
                    {
                        $updateWallet->update(["wallet" => $totalPoints,"status"=>1]);
                    }
                    else
                    {
                        $updateWallets = CustomerWallet::create(["customer_id"=>$get_referral_id->referre_id,"wallet"=>$totalPoints,"status"=>1]);

                        return $updateWallets;
                    }

                    // return $updateWallet;

                    return "wallet update";
                } else {
                    CustomerRewardPoints::create([
                        "customer_id" => $get_referral_id->referre_id,
                        "points" => 500,
                        "status" => 1
                    ]);

                    $totalPoints =  CustomerRewardPoints::where("customer_id", $get_referral_id->referre_id)->sum('points');

                    $updateWallet = CustomerWallet::where("customer_id", $get_referral_id->referre_id)->first();

                    if($updateWallet)
                    {
                        $updateWallet->update(["wallet" => $totalPoints,"status"=>1]);
                    }
                    else
                    {
                        CustomerWallet::create(["customer_id"=>$get_referral_id->referre_id,"wallet"=>$totalPoints,"status"=>1]);
                    }
                    return "wallet insert and update";
                }

        }

        $orders =  Order::create($data);

        if ($orders) {
            
            } else {
                return "wallet not update";
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
