<p align="center"><a href="https://www.msegat.com/" target="_blank"><img src="https://www.msegat.com/public/assets/img/logo/msegat.png" alt="Msegat" width="200"></a></p>


### About Msegat
The leading SMS providers in Saudi Arabia, Maximize your reach with reliable deliverability.

### Features
- Send SMS to multiple recipients.
- Send SMS to multiple recipients with Customized Sender Name ID.
- Send OTP.
- Calculate message cost points.
- Sender Names ID Inquiry.
- Balance Inquiry.

<br /><br />
### Installation

```bash
composer require hossammonir/msegat
```

<p>Publish repository configurations</p>

```bash
php artisan vendor:publish --provider="HossamMonir\Msegat\MsegatServiceProvider"
```

<p>This will publish msegat.php configtations to config/msegat.php</p>

<br /><br />
#### Prepare Environment

Add the following configration to **.env** file .

```bash
MSEGAT_DEFAULT_SENDER="Type your default sender name"
MSEGAT_USERNAME="Your Msegat Account Username"
MSEGAT_API_KEY="Your API Key"
```

<You can get your api Key from this URL [MSEGAT](https://www.msegat.com/index.php?action=548), after successful login.

<br /><br /><br />
### Usage

#### Sending SMS message

* Send SMS to multiple recipients with default sender name ID that you fill in .env file.

```php
    use HossamMonir\Msegat\Facades\Msegat;

    Msegat::numbers(['05xxxxxxxx', '05xxxxxxxx'])
            ->message('Hello World')
            ->sendWithDefaultSender();
```


* Send SMS to multiple recipients with **custom** sender name ID.

```php
    use HossamMonir\Msegat\Facades\Msegat;

    Msegat::numbers(['05xxxxxxxx', '05xxxxxxxx'])
            ->message('Hello World')
            ->sendWithSender('DigitalTunnel');
```

###### JSON Response Example

```json
{
    "response": {
        "code": "1",
        "message": "Success"
    }
}
```

<br /><br /><br />
#### OTP ( One Time Password )

* Send OTP Message with default sender name ID.

```php
    use HossamMonir\Msegat\Facades\Msegat;

    Msegat::numbers(['05xxxxxxxx'])
            ->sendOTP();
```

* If you would like to send free OTP using OTP sender name you can pass 'OTP' to sendOTP method.

```php
    use HossamMonir\Msegat\Facades\Msegat;

    Msegat::numbers(['05xxxxxxxx'])
            ->sendOTP('OTP');
```

###### JSON Response Example

```json
{
    "response": {
        "code": "1",
        "message": "Success"
    },
    "pin": "7693"
}
```


<br /><br /><br />
#### Inquiries

<p>Caculate message cost with Msegat</p>

```php
    use HossamMonir\Msegat\Facades\Msegat;

    Msegat::numbers(['9665xxxxxxxx', '9665xxxxxxxx', '9665xxxxxxxx'])
        ->message('Hello World')
        ->calculateCost();
```

###### JSON Response Example

```json
{
    "total_numbers": 3,
    "point_cost": 2.75,
    "message_length": 23
}
```

<br /> <br /> <br />
<p>Get All Sender Names ID</p>

```php
    use HossamMonir\Msegat\Facades\Msegat;

    Msegat::getSenders();
```

###### JSON Response Example

```json
{
    "response": [
        {
            "SenderID": "Digital",
            "Status": "Refused"
        },
        {
            "SenderID": "DigitalTunnel",
            "Status": "Activated"
        }
    ]
}
```


<br /> <br /> <br />
<p>Get Account Balance</p>

```php
    use HossamMonir\Msegat\Facades\Msegat;

    Msegat::getBalance();
```

###### JSON Response Example

```json
{
    "response": {
        "balance": 964795
    }
}
```


<br /><br /><br />
#### Error Codes
* 1 - Success
* M0000 - Success
* M0001 - Variables missing
* M0002 - Invalid login info
* M0022 - Exceed number of senders allowed
* M0023 - Sender Name is active or under activation or refused
* M0024 - Sender Name should be in English or number
* M0025 - Invalid Sender Name Length
* M0026 - Sender Name is already activated or not found
* M0027 - Activation Code is not Correct
* 1010 - Variables missing
* 1020 - Invalid login info
* 1050 - MSG body is empty
* 1060 - Balance is not enough
* 1061 - MSG duplicated
* 1064 - Free OTP , Invalid MSG content you should use "Pin Code is: xxxx" or "Verification Code: xxxx" or "رمز التحقق: 1234" , or upgrade your account and activate your sender to send any content
* 1110 - Sender name is missing or incorrect
* 1120 - Mobile numbers is not correct
* 1140 - MSG length is too long
* M0029 - Invalid Sender Name - Sender Name should contain only letters, numbers and the maximum length should be 11 characters
* M0030 - Sender Name should ended with AD
* M0031 - Maximum allowed size of uploaded file is 5 MB
* M0032 - Only pdf,png,jpg and jpeg files are allowed!
* M0033 - Sender Type should be normal or whitelist only
* M0034 - Please Use POST Method
* M0036 - There is no any sender


### License
Msegat package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
