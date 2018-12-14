<?php


namespace App\API\Google;


class GeoIP
{

    protected $apiKey = "AIzaSyDzRQ5EiSK2_JQmSn5IFKXRYwgpGBH5tbc";

    private function getLocation()
    {
        return google_service_curl_post("https://www.googleapis.com/geolocation/v1/geolocate?key=".$this->apiKey);
    }

    protected function getLocationByIP()
    {
        $location_by_ip = $this->getLocation();
        return json_decode($location_by_ip, true);
    }

    private function geoCoding($lat, $lng)
    {
        return google_service_curl_post("https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&key=AIzaSyDzRQ5EiSK2_JQmSn5IFKXRYwgpGBH5tbc");
    }

    protected function locateGeo($ip_location)
    {
        $latitude = number_format($ip_location['location']['lat'], 6);
        $longitude = number_format($ip_location['location']['lng'], 6);
        $geo_coding_by_coords = $this->geoCoding($latitude, $longitude);
        $geo_coords = json_decode($geo_coding_by_coords, true);
        return collect($geo_coords['results'][0]['address_components']);
    }

    private function getCity($geocoding_object)
    {
        $city_address = $geocoding_object->where('types.0',"locality")->first();
        return $city = $city_address['short_name'];
    }

    private function getState($geocoding_object)
    {
        $state_address = $geocoding_object->where('types.0',"administrative_area_level_1")->first();
        return $state = $state_address['short_name'];
    }
    private function getZip($geocoding_object)
    {
        $state_address = $geocoding_object->where('types.0',"postal_code")->first();
        return $state = $state_address['short_name'];
    }

    public function getCityStateZip()
    {
        $location_by_ip = $this->getLocationByIP();
        return [
            'city'=>$this->getCity($this->locateGeo($location_by_ip)),
            'state'=>$this->getState($this->locateGeo($location_by_ip)),
            'zip'=>$this->getZip($this->locateGeo($location_by_ip)),
        ];
    }


}