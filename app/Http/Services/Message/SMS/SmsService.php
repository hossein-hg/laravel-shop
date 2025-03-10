<?php

namespace App\Http\Services\Message\SMS;

use App\Http\Interfaces\MessageInterface;
use App\Http\Services\Message\SMS\MeliPayamakService;
use Illuminate\Support\Facades\Config;
use Melipayamak\MelipayamakApi;

class SmsService implements MessageInterface{

    private $from;
    private $text;
    private $to;
    private $isFlash = true;
    private $username;
    private $password;

    public function __construct(){
        $this->username = Config::get('sms.username');
        $this->password = Config::get('sms.password');
    }


    public function fire()
    {

        $meliPayamak = new MeliPayamakService();

        try{
            $username = $this->username;
            $password = $this->password;
            $api = new MelipayamakApi($username,$password);
            $sms = $api->sms();

            $response = $sms->send($this->to,$this->from,$this->text);

            $json = json_decode($response);

            echo $json->Value; //RecId or Error Number
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function setFrom($from)
    {
        $this->from = $from;
    }


    public function getText()
    {
        return $this->text;
    }

    public function setText($text)
    {
        $this->text = $text;
    }


    public function getTo()
    {
        return $this->to;
    }

    public function setTo($to)
    {
        $this->to = $to;
    }

    public function getIsFlash()
    {
        return $this->to;
    }

    public function setIsFlash($flash)
    {
        $this->isFlash = $flash;
    }





}
