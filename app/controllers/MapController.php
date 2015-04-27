<?php

class MapController extends \BaseController {

    protected function continentStringByCountry($country) {
        //TODO: Add caching.
        $country = DB::table('countries')->where('code', $country)->first();
        $continentDb = DB::table('continents')->where('code', $country->continent_code)->first();

        $continent = null;
        switch ($continentDb->name) {
            case 'Europe':
                $continent = 'europe';
                break;
            case 'North America':
                $continent = 'north_america';
                break;
            case 'South America':
                $continent = 'south_america';
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

        return $continent;
    }

    public function output () {
        $usersData = [];

        $users = User::where('role', '=', 2)->where('show_continent', '=', 1)->orderByRaw("RAND()")->get();
        foreach ($users as $user) {
            if (empty($user->userInfo->country)) {
                continue;
            }
            $continent = $this->continentStringByCountry($user->userInfo->country);

            $userInfo = array(
                'first_name' => $user->userInfo->first_name,
                'last_name' => $user->userInfo->last_name,
                'city' => $user->userInfo->city,
                'country' => $user->userInfo->country,
                'coord' => $user->userInfo->lat . ',' . $user->userInfo->long,
                'photo' => $user->userInfo->photo,
                'totalInvested' => $user->userMoney->ammount_invested,
                'totalReward' => $user->userMoney->ammount_won,
                'registered' => $user->created_at,
                'point' => $user->show_dot,
                'online' => rand(0,1) == 1
            );

            // Social links.
            $userInfo['social'] = array();
            $sites = array('facebook', 'twitter', 'pinterest', 'odnoklassniki', 'vkontacte');
            $links = json_decode($user->userInfo->links, true);
            if (empty($links)) {
                $links = array();
            }
            $links = array_pad($links, 5, null);
            // Build social links hash table.
            for ($l = 0; $l < count($links); $l++) {
                if (!empty($links[$l])) {
                    $userInfo['social'][$sites[$l]] = $links[$l];
                }
            }
            // Pass null if all links are empty.
            if (count($userInfo['social']) == 0) {
                $userInfo['social'] = null;
            }

            $usersData[$continent][] = $userInfo;
        }

        $totalInfo = [
            'users_total' => User::where('role', '=', 2)->where('registration_status', '=', 1)->count(),
            'users_invested' => User::where('role', '=', 2)->where('investor', '=', 1)->count(),
            'users_withdrew' => User::where('role', '=', 2)->where('awarded', '=', 1)->count(),

            'total_invested' => DB::table('user_money_info')->sum('ammount_invested'),
            'total_won' => DB::table('user_money_info')->sum('ammount_won'),
            'total_withdrew' => DB::table('user_money_info')->sum('ammount_withdrawn'),
        ];
        $data = json_encode($usersData);

        // Load announcements.
        $stream = AnnouncementSeries::whereName('xx1')->firstOrFail();
        $grouped = $stream->groupedByDate('d.m.Y');
        // Show last 5 days starting from yesterday.
        $grouped['data'] = array_slice($grouped['data'], 1, 5);

        return View::make('homepage')
            ->with('usersData', $data)
            ->with('totalInfo', $totalInfo)
            ->with('stream', $grouped);
    }

}
