<?php
namespace App\Repositories;

use App\Models\Address;

class AddressRepository
{
    /**
     * Get address by location items.
     * @param $city
     * @param $district
     * @param $street
     * @return mixed
     */
    public function findAddressByLocation($city, $district, $street): mixed
    {
        return Address::where('city', $city)
            ->where('district', $district)
            ->where('street', $street)
            ->first();
    }
    
    public static function getAddressById($id)
    {
        return Address::where('id', $id)->first();
    }
}
