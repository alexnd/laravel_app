<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Helpers\FlagsConfig;
use App\Enums\UserRolesEnum;
use App\Models\User;
use App\Models\GamePlayer;
use App\Models\Bid;

class AdminController extends BaseController
{
    public function index()
    {
		$viewData = [
            'sid' => gen_uuid()
        ];
        $res = DB::select('SELECT count(*) AS n FROM users');
        $viewData['totalUsers'] = $res[0]->n ?? 0;
		$res = DB::select('SELECT count(*) AS n FROM bids');
        $viewData['totalBids'] = $res[0]->n ?? 0;
        return view('admin.index', $viewData);
    }

    public function gamePlayers()
    {
        $users = GamePlayer::all();
        $viewData = [
            'usersCount' => $users->count() ?? 0,
            'users' => $users->toArray() ?? []
        ];
        return view('admin.gameplayers', $viewData);
    }

    public function gamePlayerEdit($id)
    {
        $user = GamePlayer::where('id', $id)->first() ?? null;
        $viewData = [
            'id' => $id,
            'data' => empty($user) ? [] : $user->toArray(),
        ];
        return view('admin.gameplayer_edit', $viewData);
    }

    public function gamePlayerUpdate()
    {
        $id = request()->input('id');
        $username = request()->input('username');
        $phone = request()->input('phone');
        $uri = request()->input('uri');
        $user = GamePlayer::where('id', $id)->update([
            'username' => $username,
            'phone' => $phone,
            'uri' => $uri,
        ]);
        if (empty($user)) {
            $viewData = [
                'error' => 'Error updating player',
                'username' => $username,
                'phone' => $phone,
                'uri' => $uri,
                'id' => $id,
            ];
            return view('admin.gameplayer_edit', $viewData);
        }
        return redirect()->route('admin.gameplayers');
    }

    public function gamePlayerAdd()
    {
        $viewData = [
            'uri' => gen_uuid(),
        ];
        return view('admin.gameplayeradd', $viewData);
    }

    public function gamePlayerCreate()
    {
        $username = request()->input('username');
        $phone = request()->input('phone');
        $uri = request()->input('uri');
        $user = GamePlayer::create([
            'username' => $username,
            'phone' => $phone,
            'uri' => $uri,
        ]);
        if (empty($user)) {
            $viewData = [
                'error' => 'Error creating player',
                'username' => $username,
                'phone' => $phone,
                'uri' => $uri,
            ];
            return view('admin.gameplayer_add', $viewData);
        }
        return redirect()->route('admin.gameplayers');
    }

    public function gamePlayerDelete()
    {
        $id = request()->input('id');
        GamePlayer::where('id', $id)->delete();
        return redirect()->route('admin.gameplayers');
    }

    public function gamePlayerBids($id)
    {
        $user = GamePlayer::where('id', $id)->first() ?? null;
        if (!empty($user)) {
            $bids = Bid::where('user_id', $user->id)->get();
            $error = '';
        } else {
            $bids = null;
            $error = 'User not found';
        }
        $viewData = [
            'error' => $error,
            'bids' => empty($bids) ? [] : $bids->toArray(),
            'gamePlayer' => empty($user) ? null : $user->toArray(),
        ];
        return view('admin.gameplayer_bids', $viewData);
    }

    public function bids()
    {
        $viewData = [
            'bids' => Bid::all(),
        ];
        return view('admin.bids', $viewData);
    }

    public function users()
    {
		$users = User::all();
        $viewData = [
			'usersCount' => $users->count() ?? 0,
            'users' => $users->toArray() ?? []
        ];
        return view('admin.users', $viewData);
    }

    public function editUser($id)
    {
        $user = User::where('id', $id)->first() ?? null;
        $viewData = [
            'id' => $id,
            'data' => empty($user) ? [] : $user->toArray(),
        ];
        return view('admin.user_edit', $viewData);
    }

	public function resetUser()
    {
		$id = request()->input('id');
		$user = User::where('id', $id)->first() ?? null;
		if ($user) {
			$user->role_id = request()->input('role') ?? UserRolesEnum::USER;
			$user->save();
		}
        return redirect()->route('admin.users');
    }

    public function updateUser()
    {
        $data = request()->except(['_token', '_method', 'id']);
        $id = request()->input('id');
        User::where('id', $id)->update($data);
        \Session::flash('message', 'User Successfully Updated');
        return redirect()->route('admin.users');
    }

    public function deleteUser()
    {
        $id = request()->input('id');
        User::where('id', $id)->delete();
        return redirect()->route('admin.users');
    }

    public function flags()
    {
        return view('admin.flags')->with(['flags' => ff_all()]);
    }

    public function flagsUpdate()
    {
        $form = request()->except(['_token', '_method']);
        if (count($form)) {
            FlagsConfig::syncWithDefault();
            foreach ($form as $k => $v) {
                FlagsConfig::set($k, boolval($v));
            }
            FlagsConfig::save();
            \Session::flash('message', 'Feature Flags Successfully Updated');
        }
        return redirect()->route('admin.flags');
    }
}
