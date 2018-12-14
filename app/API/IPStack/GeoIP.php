<?php

namespace App\API\IPStack;

class GeoIP
{
    protected $apiKey = "d7c8e307da7a25ce3fe5aa470ad1741e";
    protected $url = "http://api.ipstack.com/";

    protected function getLocationObject($ip)
    {
        return google_service_curl_post($this->url.$ip."?access_key=".$this->apiKey);
    }

    public function getLocationByIP()
    {
        return $this->getLocationObject(getUserIP());
    }
}