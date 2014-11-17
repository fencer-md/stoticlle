<?php

class MapController extends \BaseController {

    public function output () {
        $usersData = [[]];
        $totalInfo = [];

        $i = 0;
        $totalInvested = 0;
        $totalReward = 0;
        $allInvested = 0;
        $allUsers = 0;

        $users = User::where('role', '=', 2)->get();
        foreach ($users as $user) {
            $usersData[$i]['first_name'] = $user->userInfo->first_name;
            $usersData[$i]['last_name'] = $user->userInfo->last_name;

            foreach ($user->userTransaction as $transaction) {
                if ( $transaction->transaction_direction == 'invested' && $transaction->confirmed == 1 ) {
                    $totalInvested = $transaction->ammount;
                    $allInvested += $transaction->ammount;
                }
                elseif ( $transaction->transaction_direction == 'reward' && $transaction->confirmed == 1 )
                    $totalReward += $transaction->ammount;
            }
                
            $usersData[$i]['totalInvested'] = $totalInvested;
            $usersData[$i]['totalReward'] = $totalReward;
            $usersData[$i]['registered'] = $user->created_at;
            $usersData[$i]['show_continent'] = $user->show_continent;
            $usersData[$i]['show_dot'] = $user->show_dot;
            $allUsers++;
        }

        $totalInfo = [
            'allInvested' => $allInvested,
            'allUsers' => $allUsers,
        ];
        $data = json_encode($usersData);

        return View::make('homepage')->with('usersData', $data)->with('totalInfo', $totalInfo);
    }

}