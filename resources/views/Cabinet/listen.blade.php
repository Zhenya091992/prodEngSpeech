@extends('main')

@section('content')
    <label for="delayRange" class="form-label" id="delay">7</label> sec
    <input type="range" class="form-range" value="7" min="4" max="10" step="0.5" id="delayRange">

    <div>
        <h3 id="word"></h3>
    </div>
    <div>
        <h3 id="transcription"></h3>
    </div>
    <div>
        <h3 id="translate"></h3>
    </div>
    <audio id="player" preload="metadata" controls>
        <source type="audio">
    </audio>

@endsection

@vite(['resources/js/audioPlayer.js'])
