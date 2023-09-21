<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Place;
use App\Models\ProductInventory;
use App\Models\ProductSku;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cart;
use Carbon\Carbon;
use Session;
use Exception;
use DB;
use Razorpay\Api\Api;
class OrderController extends Controller
{
    public function newAddressValidation(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'address' => 'required',
            'area' => 'required',
            'city' => 'required',
            'state' => 'required',
            'name' => 'required',
            'phone_no' => 'required|numeric|digits:10',
            'pincode' => 'required|numeric|digits:6'
        ]);
    }
    public function shippingAddressValidation(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required',
            'shipping_area' => 'required',
            'shipping_city' => 'required',
            'shipping_state' => 'required',
            'shipping_name' => 'required',
            'shipping_phone_no' => 'required|numeric|digits:10',
            'shipping_pincode' => 'required|numeric|digits:6'
        ]);
    }

    public function getBillingAddress(Request $request)
    {
       
        $city = Place::find($request->city);
        $state = Place::find($request->state);
        return [
            'email' => $request->email,
            'address' => $request->address,
            'area' => $request->area,
            'city' => $city->name,
            'state' => $state->name,
            'name' => $request->name,
            'phone_no' => $request->phone_no,
            'pincode' => $request->pincode,

        ];
    }
    public function getCustomerExistingBillingAddress($id)
    {
        $address = CustomerAddress::find($id);
    
        return [
            'email' => Auth::user()->email,
            'address' => $address->address,
            'area' => $address->area,
            'city' => $address->city->name,
            'state' => $address->state->name,
            'name' => $address->name,
            'phone_no' => $address->phone_no,
            'pincode' => $address->pincode,

        ];
    }

    public function getShippingAddress(Request $request)
    {
        $city = Place::find($request->shipping_city);
        $state = Place::find($request->shipping_state);
        return [
            'email' => $request->email,
            'address' => $request->shipping_address,
            'area' => $request->shipping_area,
            'city' => $city->name,
            'state' => $state->name,
            'name' => $request->shipping_name,
            'phone_no' => $request->shipping_phone_no,
            'pincode' => $request->shipping_pincode,

        ];
    }
    public function store(Request $request)
    {
        $error = [];
        if(Cart::instance('frontend_order')->count() == 0) {
            $error['errors']['error'] = 'Cart is empty';
            return response()->json($error, 422);
        }
        $billing_address = [];
        $shipping_address = [];
        if($request->delivery_type == 'local delivery') {

            if (!Auth::check()) {
                $this->newAddressValidation($request);
                $billing_address = $this->getBillingAddress($request);
            }
            else {
                if(isset($request->new_address) && $request->new_address == 'on') {
                    $this->newAddressValidation($request);
                    $billing_address = $this->getBillingAddress($request);
    
                }
                else {
                    
                    $request->validate([
                        'billing_address' => 'required',
                    ]);
                    $billing_address = $this->getCustomerExistingBillingAddress($request->billing_address);
                    
                }
            }
    
            if(isset($request->differentaddress) && $request->differentaddress == 'on') {
                $this->shippingAddressValidation($request);
                $shipping_address = $this->getShippingAddress($request);
    
            }
            else {
                $shipping_address = $billing_address;
            }
        }
        else {
            $request->validate([
                'customer_name' => 'required',
                'customer_phone_no' => 'required|numeric|digits:10',
                'store' => 'required'
            ]);

            $billing_address = ['name' => $request->customer_name, 'phone_no' => $request->customer_phone_no, 'email' => $request->email];
            $shipping_address = $billing_address;
        }
        // return response(['data' => $request->all()]);

        $total = Cart::instance('frontend_order')->total();
        $order_data = [
            'quantity' => Cart::instance('frontend_order')->count(),
            'payment_type' => $request->payment_type,
            'subtotal' => Cart::instance('frontend_order')->subtotal(),
            'total_amount' => Cart::instance('frontend_order')->total(),
            'payable_amount' => Cart::instance('frontend_order')->total(),
            'order_status' => 'pending',
            'payment_status' => 'pending' ,
            'order_type' => 'order',
            'payment_type' => $request->payment_type,
            'order_date' => Carbon::now(),
            'due_amount' => 0,
            'paid_amount' => 0,
            'gst_percentage' => 0,
            'gst_amount' => 0,
            'billing_address' => json_encode($billing_address),
            'shipping_address' => json_encode($shipping_address),
            'delivery_type' => $request->delivery_type
        ];

        
        $customer_id = '';
        if($request->delivery_type == 'local delivery') {
            if(Auth::check()) {

                $order_data['customer_id'] = Auth::id();
                $order_data['customer_name'] = Auth::user()->name;
                $order_data['customer_mobile'] = $billing_address['phone_no'];
            }
            else {

                $order_data['customer_name'] = $billing_address['name'];
                $order_data['customer_mobile'] = $billing_address['phone_no'];
            }
        }
        else {
            $order_data['customer_name'] = $billing_address['name'];
            $order_data['customer_mobile'] = $billing_address['phone_no'];
            $order_data['store_id'] = $request->store;
            $store = User::find($request->store);
            if(!empty($store->profule->commission) && $store->profule->commission != 0) {

                $order_data['commission'] = ($order_data['payable_amount'] * $store->profule->commission)/100;
            }
        }
        
        $order = Order::create($order_data);
        if($order) {
            $orde_zero = '00000000000000000';
            if(strlen($order->id) < 6) {
                $order_number = 'ORD-'.substr($orde_zero, 0, (strlen($order->id)-1)).$order->id;
            }
            else {
                $order_number = 'ORD-'.$order->id;
            }
            $order->order_number = $order_number;
            $order->save();
        
            $item_data = [];
            foreach (Cart::instance('frontend_order')->content() as $cart) {
                $sku = ProductSku::find($cart->id);
                if ($sku) {

                    $product_name = $sku->product->productFullName();
                    $options = $cart->options;
                    $options['additional_data'] = $sku->productAttributes;
                    $item_data = [
                        'order_id' => $order->id,
                        'sku_id' => $sku->id,
                        'sku_code' => $sku->sku ?? '',
                        'description' => $product_name,
                        'amount' => $cart->price,
                        'quantity' => $cart->qty,
                        'item_options' => $options,
                        'type' => 'product',
                        'purchase_price' => $sku->purchase_price,
                        // 'left_quantity' => $cart->qty
                    ];
                    OrderItem::insert($item_data);
                }
            }
        }

        if(strtolower($request->payment_type) == 'cod') {
            Cart::instance('frontend_order')->destroy();
        }

        return response ([
            'payment_type' => strtolower($request->payment_type),
            'order_number' => $order->order_number,
            'amount' => $order->payable_amount,
            'name' => $billing_address['name'],
            'email' => $billing_address['email'],
            'phone_no' => $billing_address['phone_no'],
            'url' => route('frontend.thanks')

        ]);


    }

    public function razorUpdate(Request $request)
    {
        $input = $request->all();
      
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        DB::beginTransaction();
        try {

			$razorStatus = ['created'=>'pending','authorized'=>'pending','captured'=>'completed','refunded'=>'canceled','failed'=>'canceled'];

            $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
          
            $order_no=$request->order_number;
            \Log::channel('payment_log')->info($order_no." order response".Carbon::now());
            \Log::channel('payment_log')->info(json_encode((array)$response));
            $order=Order::where('order_number',$order_no)->first();
            $order->razorpay_id = $input['razorpay_payment_id'];
            $order->razorpay_repsonse = json_encode((array)$response);
            if($razorStatus[strtolower($response->status)] != 'canceled') {
                $order->payment_status = 'paid';
                $order->order_status = 'confirmed';
            }
            else {
                $order->payment_status = 'failed';
                $order->order_status = 'pending';
            }
            $order->payment_method = $response->method;
            $order->save();
            DB::commit();
            Cart::instance('frontend_order')->destroy();
            return redirect( route('frontend.thanks'));
           
        } catch (Exception $e) {
            DB::rollBack();
         
          \Log::channel('payment_log')->info($order_no." exception".Carbon::now());
          \Log::channel('payment_log')->info($e->getMessage());
          return redirect( route('frontend.payment_failed'));
        }
    }


//     public function courier($order_id) {
//         $order = Order::find($order_id);
//                  $username = 'info@fikry.in';
//        $password = 'ManiSaledepot@123';
//        $data = ['email' => $username, 'password' => $password];


//        $ch = curl_init('https://apiv2.shiprocket.in/v1/external/auth/login');
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
       
//        $response = curl_exec($ch);
       
//        curl_close($ch);
//         \Log::channel('courier_log')->info($order->order_no." authentication");
//         \Log::channel('courier_log')->info($response);
//        $response = json_decode($response);
      
//        $token = 'Bearer '.$response->token;
//        $order_items = OrderItem::where('order_id', $order->id)->where('type', 'product')
//        ->select('description as name', 'sku_code as sku', 'quantity as units', 'purchase_price as selling_price')->get();
//         $billing_address = json_decode($order->billing_address, true);
        
     
//        $courier_data = [
//                      "order_id" => $order->order_number,
//                      "order_date" => Carbon::parse($order->created_at)->format('Y-m-d H:i'),
//                      "pickup_location" => "Primary",
//                      "channel_id" => "",
//                      "comment" => "order",
//                      "billing_customer_name" => $billing_address['name'],
//                      "billing_last_name" => "",
//                      "billing_address" => $billing_address['address'],
//                      "billing_address_2" => $billing_address['area'],
//                      "billing_city" => $billing_address['city'],
//                      "billing_pincode" => $billing_address['pincode'],
//                      "billing_state" => $billing_address['state'],
//                      "billing_country" => "india",
//                      "billing_email" => $billing_address['email'],
//                      "billing_phone" => $billing_address['phone_no'],
//                      "shipping_is_billing" => 1,
//                      "shipping_customer_name" => "",
//                      "shipping_last_name" => "",
//                      "shipping_address" => "",
//                      "shipping_address_2" => "",
//                      "shipping_city" => "",
//                      "shipping_pincode" => "",
//                      "shipping_country" => "",
//                      "shipping_state" => "",
//                      "shipping_email" => "",
//                      "shipping_phone" => "",
//                      "order_items" => $order_items,
//                      "payment_method" =>strtolower($order->payment_type) == 'cod' ? 'COD' : "Prepaid",
//                      "shipping_charges" => "",
//                      "giftwrap_charges" => "",
//                      "transaction_charges" => "",
//                      "total_discount" => "",
//                      "sub_total" => $order->final_price,
//                      "length" => "10",
//                      "breadth" => "10",
//                      "height" => "10",
//                      "weight" => "1.5"
//                    ];
//                    print_r(json_encode($courier_data));die;
       

           
//            $ch = curl_init('https://apiv2.shiprocket.in/v1/external/orders/create/adhoc');
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $courier_data);
//            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization:'.$token));
//            $order_response = curl_exec($ch);
//            curl_close($ch);
//            print_r($order_response);
//              \Log::channel('courier_log')->info( $order->order_no." create order");
//            \Log::channel('courier_log')->info($order_response);
//           $order_response = json_decode($order_response);
//          if($order_response->status == 1) {
//              $order->shipment_id = $order_response->shipment_id;
//              $order->save();
//          }
//    }
}
