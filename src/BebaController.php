<?php

namespace AnzilSystems\Beba;

use Illuminate\Http\Request;
use AnzilSystems\Beba\UtilController;
use App\Http\Controllers\Controller;

class BebaController extends Controller
{
   //When called this function will request an Access Token and then return just 
function get_accesstoken(){ 

    $credentials = base64_encode(env('BEBA_CLIENT_KEY').':'.env('BEBA_CLIENT_SECRET'));

    $ch = curl_init(env('BEBA_ENDPOINT_URL').'/api/v1/oauth2/token');
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials,"Content-Type: application/x-www-form-urlencoded"));
    $response = curl_exec($ch); 
    $response = json_decode($response);

    $access_token = $response->access_token;
    // The above $access_token expires after an hour, find a way to cache it to minimize requests to the server
    if(!$access_token){
        throw new Exception("Invalid access token generated");
        return FALSE;
    }
    return $access_token;

  }
  
 // get couriers
  public function getCouriers($country_code, $category_id){

    $access_token = $this->get_accesstoken();
    $endpoint_url = env('BEBA_ENDPOINT_URL').'/api/v1/get_couriers';
  
    # Parameters 
    $data = array( 
          "country_code" => $country_code, 
          "category_id" => $category_id,
        );

    $data_string = json_encode($data);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$access_token));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $curl_response = curl_exec($curl);
    echo $curl_response;
    // close curl resource to free up system resources 
    curl_close($curl);
}


// get specific courier
function getSpecificCourier($courier_id){

    $access_token = $this->get_accesstoken();
    $endpoint_url = env('BEBA_ENDPOINT_URL').'/api/v1/couriers/'.$courier_id;
  
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$access_token));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $curl_response = curl_exec($curl);
    echo $curl_response;
    // close curl resource to free up system resources 
    curl_close($curl);
}

function getSpecificDriver($driver_id){

    $access_token = $this->get_accesstoken();
    $endpoint_url = env('BEBA_ENDPOINT_URL').'/api/v1/drivers/'.$driver_id;
  
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$access_token));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $curl_response = curl_exec($curl);
    echo $curl_response;
    // close curl resource to free up system resources 
    curl_close($curl);
}
  
  

 // get couriers
 function getRates($pickup_latitude,$pickup_longitude,$delivery_latitude, $delivery_longitude){

    $access_token = $this->get_accesstoken();
    $endpoint_url = env('BEBA_ENDPOINT_URL').'/api/v1/rates';
  
    # Parameters 
    $curl_post_data = array(

        'pickup_latitude' => $pickup_latitude,
        'pickup_longitude' => $pickup_longitude,
        'delivery_latitude' =>  $delivery_latitude,
        'delivery_longitude' => $delivery_longitude,
    );

    $data_string = json_encode($curl_post_data);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$access_token));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $curl_response = curl_exec($curl);
    echo $curl_response;
    // close curl resource to free up system resources 
    curl_close($curl);
}
  

// get countries
function getCountries(){

    $access_token = $this->get_accesstoken();
    $endpoint_url = env('BEBA_ENDPOINT_URL').'/api/v1/countries';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$access_token));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $curl_response = curl_exec($curl);
    echo $curl_response;
    // close curl resource to free up system resources 
    curl_close($curl);
}


// get service categories
function getServices(){

    $access_token = $this->get_accesstoken();
    $endpoint_url = env('BEBA_ENDPOINT_URL').'/api/v1/services';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$access_token));  
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $curl_response = curl_exec($curl);
    echo $curl_response;
    // close curl resource to free up system resources 
    curl_close($curl);

}

 // get payment_options
function getPaymentOptions($country_code){

    $access_token = $this->get_accesstoken();
    $endpoint_url = env('BEBA_ENDPOINT_URL').'/api/v1/payment-options';
  
    # Parameters 
    $data = array("country_code" => $country_code);
    $data_string = json_encode($data);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$access_token));
        
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $curl_response = curl_exec($curl);
    echo $curl_response;
    // close curl resource to free up system resources 
    curl_close($curl);
}

// get order status
function getOrderStatus($unique_id){

    $access_token = $this->get_accesstoken();
    $endpoint_url = env('BEBA_ENDPOINT_URL').'/api/v1/order-status/'.$unique_id;
  
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$access_token));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $curl_response = curl_exec($curl);
    echo $curl_response;
    // close curl resource to free up system resources 
    curl_close($curl);

}

// get order status
function getOrderDetail($unique_id){

    $access_token = $this->get_accesstoken();
    $endpoint_url = env('BEBA_ENDPOINT_URL').'/api/v1/order-detail/'.$unique_id;
  
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$access_token));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $curl_response = curl_exec($curl);
    echo $curl_response;
    // close curl resource to free up system resources 
    curl_close($curl);

}

// get nearby drivers
function getNearbyDrivers($radius,$current_latitude,$current_longitude){

    $access_token = $this->get_accesstoken();
    $endpoint_url = env('BEBA_ENDPOINT_URL').'/api/v1/nearby-drivers';
  
    # Parameters 
    $data = array( 
          "radius"    => $radius, 
          'current_latitude' => $current_latitude,
          'current_longitude' => $current_longitude,
        );

    $data_string = json_encode($data);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$access_token));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $curl_response = curl_exec($curl);
    echo $curl_response;
    // close curl resource to free up system resources 
    curl_close($curl);

}

// get nearby drivers
function getNeabyCouriers($radius,$current_latitude,$current_longitude){

    $access_token = get_accesstoken();
    $endpoint_url = env('BEBA_ENDPOINT_URL').'/api/v1/nearby-couriers';
  
    # Parameters 
    $data = array( 
          "radius"    => $radius, 
          'current_latitude' => $current_latitude,
          'current_longitude' => $current_longitude,
        );

    $data_string = json_encode($data);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$access_token));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $curl_response = curl_exec($curl);
    echo $curl_response;
    // close curl resource to free up system resources 
    curl_close($curl);

}

function createShipment($courier_data)
{    

    $endpoint_url = env('BEBA_ENDPOINT_URL').'/api/v1/shipments';
    $access_token = $this->get_accesstoken();
    
    # Parameters 
    $shipment_data = array(

        'unique_id' => $courier_data['unique_id'],
        'service_id' => $courier_data['service_id'],
        'customer_name' => $courier_data['customer_name'],
        'customer_phone' => $courier_data['customer_phone'],
        'customer_email' => $courier_data['customer_email'],
        'customer_city' => $courier_data['customer_city'],
        'delivery_address' => $courier_data['delivery_address'],
        'delivery_country' => $courier_data['delivery_country'],
        'delivery_latitude' => $courier_data['delivery_latitude'],
        'delivery_longitude' => $courier_data['delivery_longitude'],
        'business_name' => $courier_data['business_name'],
        'business_phone' => $courier_data['business_phone'],
        'business_email' => $courier_data['business_email'],
        'pickup_address' => $courier_data['pickup_address'],
        'business_city' => $courier_data['business_city'],
        'pickup_country' => $courier_data['pickup_country'],
        'pickup_latitude' => $courier_data['pickup_latitude'],
        'pickup_longitude' => $courier_data['pickup_longitude'],
        'courier_id' => $courier_data['courier_id'],
        'driver_id' => $courier_data['driver_id'],
        'courier_type' => $courier_data['courier_type'],
        'item_detail' => $courier_data['item_detail'],
        'order_value'  => $courier_data['order_value'],
        'shipping_mode'  => $courier_data['shipping_mode'],
        'currency_code'  => $courier_data['currency_code'],
    );
   

    $data_string = json_encode($shipment_data);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint_url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    
    $curl_response = curl_exec($curl);
    echo $curl_response;
    // close curl resource to free up system resources 
    curl_close($curl);  
  }


//cancel shipment
function cancelShipment($unique_id){

    $access_token = $this->get_accesstoken();
    $endpoint_url = env('BEBA_ENDPOINT_URL').'/api/v1/shipments/'.$unique_id;
  
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint_url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Authorization: Bearer '.$access_token));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
    $curl_response = curl_exec($curl);
    echo $curl_response;
    // close curl resource to free up system resources 
    curl_close($curl);
    
    
}
}
