<?php
$game_url = (config('app.url') ?? 'http://localhost') . '/' . ($uri ?? '');
$username = $player['username'] ?? 'Unknown';
?>
<x-app-layout>
    @if ($error)
        <h1 class="text-3xl text-red-600 bold p-10 text-center">{{ $error }}</h1>
    @else
        <x-slot name="header">
            Greetings, {{ $username }}!
        </x-slot>

        <div class="mb-4">
            Link:
            <span
                id="url"
                class="link mr-2"
            >{{ $game_url }}</span>
            <button
                class="btn-primary"
                onclick="if(copyToClipboard('#url'))setTimeout(function(){alert('Copied link:\n'+copyToClipboard._value)},500)"
            >Copy</button>
            <button
                class="btn-red"
                onclick="if(confirm('Delete this link forever?'))location.replace('{{ route('deactivate', $uri) }}')"
            >Deactivate</button>
        </div>
        <div style="margin-left:42px;margin-right:42px;margin-bottom:21px">
            <div style="margin-bottom:21px">
                <button
                    class="btn-ok"
                    onclick="playGame()"
                >I'm feeling Lucky</button>
            </div>
            <div id="play_value" class="card text-2xl bold mb-4" style="display:none"></div>
            <div id="card_lose" class="card mb-4" style="display:none">
                <h1 class="text-3xl text-red-600 bold">Lose</h1>
            </div>
            <div id="card_win" class="card mb-4" style="display:none">
                <h1 class="text-3xl text-green-600 bold mb-4">WIN!</h1>
                <p class="text-xl text-blue-600 bold">Prize: <span id="prize_value"></span></p>
            </div>
        </div>
        <table id="game_table" style="display:none" class="text-sm text-left text-gray-500 dark:text-gray-400 mb-4">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
            <tr>
                <td colspan="3" class="py-3 px-6"><h1 class="text-xl text-black bold text-center">Last 3 results</h1></td>
            </tr>
            <tr>
                <td scope="col" class="py-3 px-6">Win/Lose</td>
                <td scope="col" class="py-3 px-6">Value</td>
                <td scope="col" class="py-3 px-6">Prize</td>
            </tr>
            </thead>
            <tbody>
            <tr class="row_0 bg-white border-b"><td class="py-4 px-6"></td><td class="py-4 px-6"></td><td class="py-4 px-6"></td></tr>
            <tr class="row_1 bg-white border-b"><td class="py-4 px-6"></td><td class="py-4 px-6"></td><td class="py-4 px-6"></td></tr>
            <tr class="row_2 bg-white border-b"><td class="py-4 px-6"></td><td class="py-4 px-6"></td><td class="py-4 px-6"></td></tr>
            </tbody>
        </table>
        <div class="mb-4">
            <button
                class="btn-light"
                onclick="gameHistory()"
            >History</button>
            <a
                href="{{ route('newgame', $uri) }}"
                class="btn-purple"
            >New Link</a>
        </div>

    @endif
</x-app-layout>
<script>
function playGame() {
    var url = '{{ route('play', $uri ?? '') }}';
    fetch(url, {
        method: 'GET',
        headers: {'Content-Type': 'application/json'},
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'include'
    })
    .then(function(res) {
        return res.json();
    })
    .then(function(res) {
        console.log('*[response]', res);
        if (!res.data) return alert('Error!');
        var el_win = document.getElementById('card_win'),
            el_lose = document.getElementById('card_lose'),
            el_value = document.getElementById('play_value');
            el_prize = document.getElementById('prize_value');
        el_value.innerText = res.data.value || '0';
        el_value.style.display = 'block';
        if (res.data.win) {
            el_lose.style.display = 'none';
            el_win.style.display = 'block';
            el_prize.innerText = res.data.prize;
        } else {
            el_win.style.display = 'none';
            el_lose.style.display = 'block';
        }
    })
    .catch(function(err) {
        console.error(err)
    });
}
function gameHistory() {
    var url = '{{ route('gamelog', $uri ?? '') }}';
    fetch(url, {
        method: 'GET',
        headers: {'Content-Type': 'application/json'},
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'include'
    })
    .then(function(res) {
        return res.json();
    })
    .then(function(res) {
        var el = document.getElementById('game_table');
        if (res.data && Array.isArray(res.data))
        for (var i=0; i<res.data.length; i++) {
            if (i > 2) break;
            var elTr = el.querySelector('.row_' + i);
            elTr.childNodes[0].innerText = res.data[i].win ? 'Win' : 'Lose';
            elTr.childNodes[1].innerText = res.data[i].value;
            elTr.childNodes[2].innerText = res.data[i].win ? res.data[i].prize : '0';
        }
        el.style.display = 'table';
    })
    .catch(function(err) {
        console.error(err)
    });
}
</script>
