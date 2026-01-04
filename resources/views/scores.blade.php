<x-base-layout>
<h1>Live Scores</h1>

@if($games->isEmpty())
    <p>Er zijn nog geen scores beschikbaar.</p>
@else
    <div class="scores-container">
        @foreach($games as $game)
            <div class="game-card">
                <div class="teams">
                    <div class="team">
                        <span class="team-name">{{ $game->team1->naam }}</span>
                        <span class="school-name">({{ $game->team1->school->naam }})</span>
                    </div>
                    <div class="score">
                        <span class="score-value">{{ $game->score1 }} - {{ $game->score2 }}</span>
                    </div>
                    <div class="team">
                        <span class="team-name">{{ $game->team2->naam }}</span>
                        <span class="school-name">({{ $game->team2->school->naam }})</span>
                    </div>
                </div>
                <div class="game-info">
                    <span class="sport">{{ $game->sport }}</span>
                    @if($game->poule)
                        <span class="poule">Poule: {{ $game->poule }}</span>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endif

<style>
    .scores-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        max-width: 800px;
        margin: 0 auto;
    }

    .game-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        background-color: #f9f9f9;
    }

    .teams {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .team {
        flex: 1;
        text-align: center;
    }

    .team:first-child {
        text-align: left;
    }

    .team:last-child {
        text-align: right;
    }

    .team-name {
        font-weight: bold;
        font-size: 1.2em;
    }

    .school-name {
        font-size: 0.9em;
        color: #666;
    }

    .score {
        flex: 0 0 100px;
        text-align: center;
    }

    .score-value {
        font-size: 2em;
        font-weight: bold;
        color: #007BFF;
    }

    .game-info {
        text-align: center;
        font-size: 0.9em;
        color: #666;
    }

    .poule {
        margin-left: 10px;
    }
</style>
</x-base-layout>