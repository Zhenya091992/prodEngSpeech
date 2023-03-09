@extends('main')
@section('content')
    <div class="d-grid gap-2">
        <a href="{{ route('englishWords') }}" class="btn btn-secondary btn-lg" tabindex="-1" role="button">Все слова</a>
        <a href="{{ route('EnglishWordsForLearn') }}" class="btn btn-secondary btn-lg" tabindex="-1" role="button">Слова для изучения</a>
        <a href="{{ route('learned') }}" class="btn btn-secondary btn-lg" tabindex="-1" role="button">Выученные слова</a>
        <a href="{{ route('listen') }}" class="btn btn-secondary btn-lg" tabindex="-1" role="button">Слушать</a>
    </div>

@endsection
