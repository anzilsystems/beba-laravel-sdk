# beba Shipping API

This is a Laravel library for implementing Pickup and Delivery Services in Kenya and Ghana on the `beba` API. The package uses REST API that is documented on this [link](https://www.pikieglobal.com/docs). This is developed on sandbox (testing) mode. To go live contact `Anzil Software Ltd` on <api-feedback@pikieglobal.com>.

### Introduction

BebaAPI is a product of [Anzil Software Ltd](https://www.anzilsystems.com) that provides an elaborate API to allow developers, shipping companies, and e-commerce stores integrate pickup and delivery functionality into their applications. [PikieGlobal](https://www.pikieglobal.com) implements bebaAPI to provide a reliable platform for delivering products to customers from virtually any online shop or business through our network of courier companies and riders. Pikie intends to create a network of Partners throughout Africa to expand its reach to millions of
customers intending to transport cargo within a country (inland).

### Configuration

At your project root, create a .env file and in it set the client key, client secret and endpoint url

`BEBA_CLIENT_KEY= [client key]` <br>
`BEBA_CLIENT_SECRET =[client secret]`<br>
`BEBA_ENDPOINT_URL =[endpoint url]`<br>
`BEBA_ENV=[live or sandbox]`<br>

### Installation

1. In order to install beba Library, just run `composer require anzilsystems/beba-laravel-sdk`:

2. Open your `config/app.php` and add the following to the to the `providers` and `aliases` array. When using Laravel 5.5+, the package will automatically register. For Laravel 5.4 and below, include the service provider and its alias within your `config/app.php`:


    ```php
    'providers' => [
        AnzilSystems\Beba\BebaServiceProvider::class,
    ],

    'aliases' => [
        'Beba' =>  AnzilSystems\Beba\BebaFacade::class,
    ],
    ```

### Usage

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Beba;

class TestController extends Controller
{
    public function getCouriers(){
        print_r(Beba::getCouriers('KEN','1')); // country_code, service_category
    }

    public function getSpecificCourier(){
        print_r(Beba::getSpecificCourier('1')); // courier_id
    }

     public function getSpecificDriver(){
        print_r(Beba::getSpecificDriver('1')); // driver_id
    }

    public function getRates(){
        //pickup latitude,pickup longitude,delivery latitude, delivery longitude
        print_r(Beba::getRates('-1.2173611','36.9000374','-1.2476927','36.872455'));
    }

    public function getCountries(){
        print_r(Beba::getCountries());
    }

    public function getServices(){

        print_r(Beba::getServices());

    }

    public function getPaymentOptions(){
        //parameter country code
        print_r(Beba::getPaymentOptions('KEN')); //country code

    }

    public function getOrderStatus(){
        //parameter unique id UUID Version 4
        print_r(Beba::getOrderStatus('45684e0b-8c73-41be-a118-fc7ab1c17694'));

    }

    public function getOrderDetail(){
        //parameter unique id UUID Version 4
        print_r(Beba::getOrderDetail('45684e0b-8c73-41be-a118-fc7ab1c17694'));

    }

    public function getNearbyDrivers(){
        //parameters radius (km),current latitude, current longitude
        print_r(Beba::getNearbyDrivers('5','-1.2173611','36.9000374'));

    }

    public function getNearbyCouriers(){
        //parameters radius (km),current latitude, current longitude
        print_r(Beba::getNearbyCouriers('5','-1.2173611','36.9000374'));

    }

    public function cancelShipment(){
        //parameter unique id UUID Version 4
        print_r(Beba::cancelShipment('45684e0b-8c73-41be-a118-fc7ab1c17694'));

    }

    public function createShipment(){
  
      # Parameters 
      $item_detail = [
        [
            'item_name' => 'Fish fried',
            'item_quantity'  => 2,
            'unit_cost'    => '200',
            'unit_weight'    => '', //optional
            'unit_volume'    => '',  //optional


        ],
        [
            'item_name' => 'Beef Stew',
            'item_quantity'  => 2,
            'unit_cost'    => '200',
            'unit_weight'    => '', //optional
            'unit_volume'    => '',  //optional
        ]

    ];
    
    $shipment_data = [

        'unique_id' => '45684e0b-8c73-41be-a118-fc7ab1c17694', //UUID Version 4
        'service_id' => '1',
        'customer_name' => 'Jane Doe',
        'customer_phone' => '254721123456',
        'customer_email' => 'janedoe@gmail.com',
        'pickup_address' => 'Safari Park Fly Over, Thika Road, Nairobi, Kenya',
        'pickup_country' => 'KENYA',
        'pickup_latitude' => '-1.2256562',
        'pickup_longitude' => '36.88495850000004',
        'customer_city' => 'Nairobi, Kenya',
        'business_name' => 'ABC Hotel',
        'business_phone' => '254721174236',
        'business_email' => 'johndoe@gmail.com	',
        'delivery_address' => 'Naivas, Outer Ring Road, Nairobi, Kenya',
        'delivery_country' => 'KENYA',
        'delivery_latitude' => '-1.2476927',
        'delivery_longitude' => '36.872455',
        'business_city' => 'Nairobi , Kenya',
        'courier_id' => '12',
        'driver_id' => '',
        'courier_type' => '1',
        'item_detail' => $item_detail,
        'business_hours' => '8.00 AM - 5.00 PM',
        'order_value'  => '700',
        'shipping_mode'  => '1', //send to one 
        'currency_code'  => 'KES'
            
    ];

    print_r(Beba::createShipment($shipment_data));

    }

```
## Reference

   [REST API Reference] (https://www.pikieglobal.com/docs)

## Support

Need support using this package:-

- _api-feedback@pikieglobal.com_ 

## Contributors

- [Basil Ndonga](https://www.linkedin.com/in/basil-ndonga-1a76ba124/)
- Dennis Mayeku

### License

This Package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

Happy coding!!!!!!!

### Security

If you discover any security related issues, please email _api-feedback@pikieglobal.com_ instead of using the issue tracker.

```
