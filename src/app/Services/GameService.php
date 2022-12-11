<?php

namespace App\Services;

use App\Models\Bid;
use App\Models\GamePlayer;

class GameService extends BaseService
{
    public function getGameByUri(string $uri): GamePlayer {
        if (empty($uri)) {
            throw new \Exception('ID required');
        }
        if (!is_uuid($uri)) {
            throw new \Exception('Bad ID');
        }
        $player = GamePlayer::where('uri', $uri)->first();
        if (empty($player)) {
            throw new \Exception('ID not exists');
        }
        // 604800 seconds in 7 days = 7 * 24 * 60 * 60
        if (time() - strtotime($player->created_at) > 604800) {
            throw new \Exception('ID expired');
        }
        return $player;
    }

    public function deleteGameByUri(string $uri): bool
    {
        $player = $this->getGameByUri($uri);
        if (!empty($player)) {
            Bid::where('user_id', $player->id)->delete();
            return (bool) GamePlayer::where('uri', $uri)->delete();
        }
        return false;
    }

    public function regenerateGameUri(string $uri): string
    {
        $newUri = gen_uuid();
        if (!GamePlayer::where('uri', $uri)->update(['uri' => $newUri])) return '';
        return $newUri;
    }

    public function createGame(string $username, string $phone): GamePlayer
    {
        $user = [
            'username' => $username,
            'phone' => $phone,
            'uri' => gen_uuid(),
        ];
        return GamePlayer::create($user);
    }

    public function runGame(string $uri): Bid | null
    {
        $player = $this->getGameByUri($uri);
        if (!empty($player)) {
            $value = random_int(1, 1000);
            $win = $value % 2 === 0;
            if ($win) {
                if ($value < 300) {
                    $prize = $value * 0.1;
                } else if ($value < 600) {
                    $prize = $value * 0.3;
                } else if ($value < 900) {
                    $prize = $value * 0.5;
                } else { // $value > 900
                    $prize = $value * 0.7;
                }
            } else {
                $prize = 0;
            }
            $bid = [
                'user_id' => $player->id,
                'value' => $value,
                'prize' => $prize,
                'win' => $win ? 1 : 0,
                'created_at' => now(),
            ];
            return Bid::create($bid);
        }
        return null;
    }

    public function getGameBids(string $uri, int $limit = 3): array
    {
        $player = $this->getGameByUri($uri);
        if (!empty($player)) {
            return Bid::where('user_id', $player->id)->take($limit)->get()->toArray();
        }
        return [];
    }

}
