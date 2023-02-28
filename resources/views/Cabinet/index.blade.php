@extends('main')
@section('content')
    <div>
        <a href="{{ route('EnglishWords.index') }}">All english words</a>
    </div>
    <div>
        <a href="{{ route('EnglishWordsForLearn') }}">All english words for learning</a>
    </div>
    <div>
        <a href="{{ route('listen') }}">Listen</a>
    </div>
    <div>
        <a href="">All english learned words</a>
    </div>
@endsection


