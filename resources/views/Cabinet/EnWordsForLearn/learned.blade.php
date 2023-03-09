@extends('main')

@section('headers')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
    <table class="table" id="enWordsTable">
        <thead>
        <tr>
            <th scope="col">action</th>
            <th scope="col">word</th>
            <th scope="col">transcription</th>
            <th scope="col">translation</th>
        </tr>
        </thead>
        <tbody>
        @foreach($enWords as $word)
            <tr id="{{ $word->id }}" class="rows">
                <td>
                    <button type="button" class="btn btn-secondary learn">Учить</button>
                </td>
                <td class="word">{{ $word->word }}</td>
                <td class="transcription">{{ $word->transcription }}</td>
                <td class="ruWords">
                    @foreach($word->ruWords as $ruWord)
                        <a>{{ $ruWord->word }}</a>,
                    @endforeach
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $enWords->links() }}
@endsection

@vite(['resources/js/enWordsTable.js'])
