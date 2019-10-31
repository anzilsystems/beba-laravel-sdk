# beba Shipping API

Laravel Library for implementing **PikieGlobal** Services in Kenya and Ghana

## About Anzil Software Ltd

[Anzil Software Ltd](https://www.anzilsystems.com) is a Software Company based in Westlands, Nairobi, Kenya that specializes in USSD, SMS, APIs, Web and Mobile applications. Anzil has keen interest in shipping, e-commerce, payments and custom ERP systems. We recognize that developers, ecommerce stores and courier companies need an elaborate API to facilitate pickup and delivery services.

## Introduction

BebaAPI is a product of [Anzil Software Ltd](https://www.anzilsystems.com) that provides an elaborate API to allow developers, shipping companies, an e-commerce stores integrate pickup and delivery functionality into their applications. [PikieGlobal](https://www.pikieglobal.com) implements bebaAPI to provide a reliable platform for delivering products to customers from virtually any online shop or business through our network of courier companies and riders. Pikie intends to create a network of Partners throughout Africa to expand its reach to millions of
customers intending to transport cargo within a country (inland).

## Configuration

At your project root, create a .env file and in it set the client key, client secret and endpoint url

`BEBA_CLIENT_KEY= [client key]` <br>
`BEBA_CLIENT_SECRET =[client secret]`<br>
`BEBA_ENDPOINT_URL =[endpoint url]`<br>
`BEBA_ENV=[live or sandbox]`<br>

## Installation

1. In order to install beba Library, just run `composer require anzilsystems/beba`:

2. Open your `config/app.php` and add the following to the `providers` array:

```php
      AnzilSystems\Beba\BebaServiceProvider::class,
```

3. In the same `config/app.php` and add the following to the `aliases` array:

```php
     'Beba' =>  AnzilSystems\Beba\BebaFacade::class,
```

## Usage

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Beba;

class TestController extends Controller
{
    public function getCouriers(){
        print_r(Beba::getCouriers('254','1'));
    }

    public function getRates(){
        //pickup latitude,pickup longitude,delivery latitude, delivery longitude
        print_r(Beba::getRates('-1.2173611','36.9000374','-1.2476927','36.872455'));
    }

    public function getCountries(){
        print_r(Beba::getCountries());
    }

    public function getServiceCategories(){

        print_r(Beba::getServiceCategories());

    }

    public function getPaymentOptions(){
        //parameter country code
        print_r(Beba::getPaymentOptions('233'));

    }

    public function getOrderStatus(){
        //parameter unique id UUID Version 4
        print_r(Beba::getOrderStatus('45684e0b-8c73-41be-a118-fc7ab1c17694'));

    }

    public function getNearbyDrivers(){
        //parameter radius,current latitude, current longitude
        print_r(Beba::getNearbyDrivers('5','-1.2173611','36.9000374'));

    }

    public function updateOrderStatus(){
        //parameter unique id UUID Version 4
        print_r(Beba::updateOrderStatus('45684e0b-8c73-41be-a118-fc7ab1c17694'));

    }

    public function cancelShipment(){
        //parameter unique id UUID Version 4
        print_r(Beba::cancelShipment('45684e0b-8c73-41be-a118-fc7ab1c17694'));

    }

    public function createShipment(){
        //parameter unique id UUID Version 4

        $item_detail = [
            [
                'item_name' => 'Fish fried',
                'qty_no'  => 2,
                'rate'    => 'KES 200'
            ],
            [
                'item_name' => 'Beef Stew',
                'qty_no'  => 2,
                'rate'    => 'KES 300'
            ]

        ];

        $shipment_data = [
            'order_id' => '5',
            'unique_id' => '45684e0b-8c73-41be-a118-fc7ab1c17694',
            'trans_id' => '5',
            'service_id' => '1',
            'customer_id' => '4',
            'customer_name' => 'Jane Doe',
            'customer_phone' => '254721123456',
            'customer_email' => 'janedoe@gmail.com',
            'pickup_address' => 'Safari Park Fly Over, Thika Road, Nairobi, Kenya',
            'pickup_country' => 'KENYA',
            'pickup_latitude' => '-1.2256562',
            'pickup_longitude' => '36.88495850000004',
            'customer_city' => 'Nairobi, Kenya',
            'business_id' => '1',
            'business_name' => 'ABC Hotel',
            'business_phone' => '254721174236',
            'business_email' => 'johndoe@gmail.com	',
            'delivery_address' => 'Naivas, Outer Ring Road, Nairobi, Kenya',
            'delivery_country' => 'KENYA',
            'delivery_latitude' => '-1.2476927',
            'delivery_longitude' => '36.872455',
            'business_city' => 'Nairobi , Kenya',
            'courier_id' => '12',
            'courier_type' => 'corporate',
            'customer_detail' => '', //optional
            'item_detail' => $item_detail,
            'business_detail' => '', //optional
            'business_hours' => '8.00 PM- 5 PM',
            'distance'       => '7.1',
            'order_value'  => '700',
            'shipping_rate'  => '355',
            'paybill_number' => '35323',
            'tax_pin' => '123455',
            'payment_type' => 'bank'
        ];

        print_r(Beba::createShipment($shipment_data));

    }

```

## Support

- [API QUERY <api-feedback@pikieglobal.com>][link-author]
- [Official Skype ID](basilndonga)

## Security

If you discover any security related issues, please email _api-feedback@pikieglobal.com_ instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/samerior/mobile-money.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/samerior/mobile-money/master.svg?style=flat-square
[ico-style-ci]: https://styleci.io/repos/132899622/shield?branch=master
[ico-circle-ci]: https://circleci.com/gh/samerior/mobile-money.png?style=shield
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/samerior/mobile-money.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/samerior/mobile-money.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/samerior/mobile-money.svg?style=flat-square
[link-packagist]: https://packagist.org/packages/samerior/mobile-money
[link-travis]: https://travis-ci.org/samerior/mobile-money
[link-circle-ci]: https://circleci.com/gh/samerior/mobile-money
[link-scrutinizer]: https://scrutinizer-ci.com/g/samerior/mobile-money/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/samerior/mobile-money
[link-downloads]: https://packagist.org/packages/samerior/mobile-money
[link-style-ci]: https://styleci.io/repos/132899622
[link-author]: https://github.com/samerior
[link-contributors]: ../../contributors

```

```
