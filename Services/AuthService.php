<?php
namespace App\Http\Services;

class AuthService
{
    /**
     * Attempting User type before login
     * 
     * @param User $user
     * @param array $userData
     */
    public function userRegiter($user,$service,$userData)
    {
        $userData = $service->beforeSave($userData,'user');
        if(isset($userData['success']) && !$userData['success'])
            return $userData;
        $createdUser = $service->create($userData);
        return $createdUser;
    }

    /**
     * Attempting Company type before login
     *
     * @param User $company
     * @param array $companyData
     */
    public function companyRegiter($company,$service,$companyData)
    {
        $companyData = $service->beforeSave($companyData,'company');
        $createdCompany = $service->create($companyData);
        return $createdCompany;
    }

    /**
     * Attempting Festival type before login
     *
     * @param User $festival
     * @param array $festivalData
     */
    public function festivalRegiter($festival,$service,$festivalData)
    {
        $festivalData = $service->beforeSave($festivalData,'festival');
        $createdFestival = $service->create($festivalData);
        return $createdFestival;
    }
    /**
     * Return Countries List
     * 
     * @return array
     */
    public function getCountries()
    {
        $countries = [];
        $countries[0] = 'Select country';
        $countriesModel = \DB::table('countries')->orderBy('name','ASC')->get();
        foreach( $countriesModel as $country)
        {
            $countries[$country->id] = $country->name;
        }
        return $countries;
    }
}
