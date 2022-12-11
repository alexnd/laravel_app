<?php

namespace App\Http\Controllers\Pages;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Game\RegisterGamePlayerRequest;
use App\Services\GameService;
use App\Models\GamePlayer;
use App\Enums\UserRolesEnum;

class PagesController extends BaseController
{
    private GameService $gameService;

    public function __construct(
        GameService $gameService
    ) {
        parent::__construct();
        $this->gameService = $gameService;
    }

    public function index()
    {
        //dd(session()->get('errors')->keys());
        //dd(\Session::all());
        // determine admin passed to home after login, if so - redirect to /admin
        $user = Auth::user();
        $referer = request()->headers->get('referer');
        if (!empty($user) && $user->role_id === UserRolesEnum::ADMIN && preg_match('!login!', $referer)) {
            return redirect()->route('admin');
        }
        // for future stats on home page
        $res = DB::select('SELECT count(*) AS n FROM users');
        $totalUsers = $res[0]->n ?? 0;
        $res = DB::select('SELECT count(*) AS n FROM game_players');
        $totalPlayers = $res[0]->n ?? 0;
        $res = DB::select('SELECT count(*) AS n FROM bids');
        $totalBids = $res[0]->n ?? 0;
        $viewData = [
            'message' => \Session::get('message') ?? '',
            'error' => \Session::get('error') ?? '',
            'old_username' => request()->old('username') ?? '',
            'old_phone' => request()->old('phone') ?? '',
            'totalUsers' => $totalUsers,
            'totalPlayers' => $totalPlayers,
            'totalBids' => $totalBids,
        ];
        return view('home', $viewData);
    }

    public function game(string $uri)
    {
        $viewData = [
            'error' => null,
            'player' => null,
            'uri' => $uri,
        ];
        try {
            $player = $this->gameService->getGameByUri($uri);
            if (empty($player)) {
                throw new \Exception('Link not found');
            } else {
                $viewData['player'] = $player->toArray();
            }
        } catch (\Exception $e) {
            $viewData['error'] = $e->getMessage();
        }
        return view('game', $viewData);
    }

    public function creategame(RegisterGamePlayerRequest $request)
    {
        try {
            $input = $request->validated();
            $gamePlayer = $this->gameService->createGame($input['username'], $input['phone']);
            if (empty($gamePlayer)) {
                throw new \Exception('Error registering new user');
            } else {
                return redirect()->route('game', $gamePlayer->uri);
            }
        } catch (\Exception $e) {
            \Session::flash('error', $e->getMessage());
            return redirect()->route('home');
        }
    }

    // version 1, obsolete
    public function createGameV1()
    {
        $error = $uri = null;
        try {
            $_username = request()->input('username');
            $_phone = request()->input('phone');
            $username = trim($_username);
            $phone = trim($_phone);
            if (empty($username)) {
                throw new \Exception('Username required');
            }
            if (empty($phone)) {
                throw new \Exception('Phone required');
            }
            if (strlen($username) < 3) {
                throw new \Exception('Username should be above 2 symbols');
            }
            $phone = str_filter_phone($phone);
            if (!is_phone($phone)) {
                throw new \Exception('Phone should be numeric, like +380123456789');
            }
            $player = GamePlayer::where('username', $username)->first();
            if (!empty($okayer)) {
                throw new \Exception('User with such username already exists');
            }
            $player = GamePlayer::where('phone', $phone)->first();
            if (!empty($player)) {
                throw new \Exception('User with such phone already exists');
            }
            $player = $this->gameService->createGame($username, $phone);
            if (empty($player)) {
                throw new \Exception('Error registering new user');
            } else {
                $uri = $player->uri;
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }
        if (!$error && $uri) {
            return redirect()->route('game', $uri);
        }
        $viewData = [
            'error' => $error,
            'old_username' => strip_tags($_username),
            'old_phone' => strip_tags($_phone),
        ];
        return view('home', $viewData);
    }

    public function deactivate(string $uri)
    {
        $error = null;
        try {
            $player = $this->gameService->getGameByUri($uri);
            if ($player) {
                if ($this->gameService->deleteGameByUri($uri)) {
                    \Session::flash('message', 'Link was successfully deleted');
                    return redirect()->route('home');
                }
            } else {
                $error = 'Not found';
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }
        $viewData = [
            'error' => $error,
            'uri' => $uri,
        ];
        return view('game', $viewData);
    }

    public function play($uri)
    {
        $json = [
            'data' => [],
            'error' => null,
        ];
        try {
            $result = $this->gameService->runGame($uri);
            $json['data'] = empty($result) ? [] : $result->toArray();
        } catch (\Exception $e) {
            $json['error'] = $e->getMessage();
        }
        return response()->json($json);
    }

    public function gamelog($uri)
    {
        $json = [
            'data' => [],
            'error' => null,
        ];
        try {
            $json['data'] = $this->gameService->getGameBids($uri);
        } catch (\Exception $e) {
            $json['error'] = $e->getMessage();
        }
        return response()->json($json);
    }

    public function newGame(string $uri)
    {
        $error = null;
        try {
            $player = $this->gameService->getGameByUri($uri);
            if ($player) {
                $newUri = $this->gameService->regenerateGameUri($uri);
                if ($newUri) {
                    return redirect()->route('game', $newUri);
                } else {
                    $error = 'Cannot create new link';
                }
            } else {
                $error = 'Not found';
            }
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }
        $viewData = [
            'error' => $error,
            'uri' => $uri,
        ];
        return view('game', $viewData);
    }

    public function terms()
    {
        return view('terms');
    }

}
