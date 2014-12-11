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
            elseif ( $user->show_dot == 1 && $user->userInfo->lat != 0 && $user->userInfo->country != NULL ) {
                $country = $user->userInfo->country;

                $country = DB::table('countries')->where('code', $country)->first();
                $continentDb = DB::table('continents')->where('code', $country->continent_code)->first();

                switch ($continentDb->name) {
                    case 'Europe':
                        $continent = 'euro';
                        break;
                    case 'North America':
                        $continent = 'america_n';
                        break;
                    case 'South America':
                        $continent = 'america_s';
                        break;
                    case 'Africa':
                        $continent = 'africa';
                        break;
                    case 'Oceania':
                        $continent = 'australia';
                        break;
                    case 'Asia':
                        $continent = 'asia';
                }

                $usersData[$continent][$i]['first_name'] = $user->userInfo->first_name;
                $usersData[$continent][$i]['last_name'] = $user->userInfo->last_name;
                $usersData[$continent][$i]['city'] = $user->userInfo->city;
                $usersData[$continent][$i]['country'] = $user->userInfo->country;
                $usersData[$continent][$i]['coord'] = $user->userInfo->lat.','.$user->userInfo->long;
                $usersData[$continent][$i]['photo'] = $user->userInfo->photo;

                // Social links.
                $usersData[$continent][$i]['social'] = array();
                $sites = array('facebook', 'twitter', 'pinterest', 'odnoklassniki', 'vkontacte');
                $links = json_decode($user->userInfo->links, true);
                $links = array_pad($links, 5, null);
                // Build social links hash table.
                for($l = 0; $l < count($links); $l++) {
                    if (!empty($links[$l])) {
                        $usersData[$continent][$i]['social'][$sites[$l]] = $links[$l];
                    }
                }
                // Pass null if all links are empty.
                if (count($usersData[$continent][$i]['social']) == 0) {
                    $usersData[$continent][$i]['social'] = null;
                }

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
            'users_total' => User::where('role', '=', 2)->where('registration_status', '=', 1)->count(),
            'users_invested' => User::where('role', '=', 2)->where('investor', '=', 1)->count(),
            'users_withdrew' => User::where('role', '=', 2)->where('awarded', '=', 1)->count(),

            'total_invested' => DB::table('user_money_info')->sum('ammount_invested'),
            'total_won' => DB::table('user_money_info')->sum('ammount_won'),
            'total_withdrew' => DB::table('user_money_info')->sum('ammount_withdrawn'),

            'allInvested' => $allInvested,
            'allUsers' => $allUsers,
        ];
        $data = json_encode($usersData);

        return View::make('homepage')->with('usersData', $data)->with('totalInfo', $totalInfo);
    }

}
