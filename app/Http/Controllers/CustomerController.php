<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Customer,CustomerRewardPoints};
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $customer = Customer::all();
        try {
            return response()->json(["status" => "suceess", "data" => $customer], 200);
        } catch (error) {
            return response()->json(["status" => "failed", "message" => error], 403);
        }
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
    public function store($code="",Request $request)
    {        

        $validate =  Validator::make($request->all(),[
            'name'=>"required",
                'email'=>'email|required|unique:customers'
           ]);

           if ($validate->fails()) {
            return $validate->errors();
           }



        $data = array(
            "name" => $request->name,
            "email" => $request->email,
            "mobile" => $request->mobile,
            "password" => bcrypt($request->password),
            "referral_code" => str::random(8)
        );

        $customer = Customer::create($data);

        if($request->code)
        {
            $referral = Customer::where("referral_code",$code)->first();

            if($referral)
            {
                CustomerRewardPoints::create(["customer_id"=>$customer->id,"referre_id"=>$referral->id,"status"=>1]);
            }
        }
 

        if ($customer) {
            return response()->json(["status" => "success", "data" => $customer]);
        } else {
            return response()->json(["status" => "failed", "message" => "Customer data not inserted successfully"]);
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
     *=
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
