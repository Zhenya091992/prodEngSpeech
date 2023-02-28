@extends('main')

@section('content')


    <label for="delayRange" class="form-label" id="delay">2.5</label> sec
    <input type="range" class="form-range" value="2.5" min="0" max="5" step="0.5" id="delayRange">

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
