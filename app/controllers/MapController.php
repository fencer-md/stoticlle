<?php

class MapController extends \BaseController {

    public function output () {
        $usersData = [];
        $totalInfo = [];

        $i = 0;
        $totalInvested = 0;
        $totalReward = 0;
        $allInvested = 0;
        $allUsers = 0;

        $users = User::where('role', '=', 2)->get();
        foreach ($users as $user) {
            if ( $user->userInfo->lat == 0 && $user->userInfo->long == 0 ) {}
            elseif ( $user->userInfo->lat != 0 && $user->userInfo->country != NULL ) {
                $country = $user->userInfo->country;

                $country = DB::table('countries')->where('code', $country)->first();
                $continentDb = DB::table('continents')->where('code', $country->continent_code)->first();
                if ( $continentDb->name == 'Europe' ) $continent = 'euro';
                elseif ( $continentDb->name == 'North America' ) $continent = 'america_n';
                elseif ( $continentDb->name == 'South America' ) $continent = 'america_s';
                elseif ( $continentDb->name == 'Africa' ) $continent = 'africa';
                elseif ( $continentDb->name == 'Oceania' ) $continent = 'australia';
                elseif ( $continentDb->name == 'Asia' ) $continent = 'asia';
                $usersData[$continent][$i]['first_name'] = $user->userInfo->first_name;
                $usersData[$continent][$i]['last_name'] = $user->userInfo->last_name;
                $usersData[$continent][$i]['city'] = $user->userInfo->city;
                $usersData[$continent][$i]['country'] = $user->userInfo->country;
                $usersData[$continent][$i]['coord'] = $user->userInfo->lat.','.$user->userInfo->long;
                $usersData[$continent][$i]['photo'] = $user->userInfo->photo;
                foreach ($user->userTransaction as $transaction) {
                    if ( $transaction->transaction_direction == 'invested' && $transaction->confirmed == 1 ) {
                        $totalInvested = $transaction->ammount;
                    }
                    elseif ( $transaction->transaction_direction == 'reward' && $transaction->confirmed == 1 )
                        $totalReward += $transaction->ammount;
                }
                    
                $usersData[$continent][$i]['totalInvested'] = $totalInvested;
                $usersData[$continent][$i]['totalReward'] = $totalReward;
                $usersData[$continent][$i]['registered'] = $user->created_at;
                $usersData[$continent][$i]['show_continent'] = $user->show_continent;
                $usersData[$continent][$i]['point'] = $user->show_dot;
                $i++;
                $totalInvested = 0;
                $totalReward = 0;
            }
                $allUsers++;

            foreach ($user->userTransaction as $transaction) {
                if ( $transaction->transaction_direction == 'invested' && $transaction->confirmed == 1 ) {
                    $allInvested += $transaction->ammount;
                }
            }
        }

        $totalInfo = [
            'allInvested' => $allInvested,
            'allUsers' => $allUsers,
        ];
        $data = json_encode($usersData);

        return View::make('homepage')->with('usersData', $data)->with('totalInfo', $totalInfo);
    }

}
