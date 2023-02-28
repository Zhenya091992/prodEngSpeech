@extends('main')

@section('header')
    @include('header')
@endsection

@section('errs')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="shadow-lg w-50 p-3 mb-5 bg-body rounded mx-auto text-center">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="input-group mb-3 row g-3 align-items-center">
                    <div class="col">
                        <label for="nameUser" class="col-form-label">Name</label>
                    </div>
                    <div class="col-6">
                        <input name="nameUser" type="text" id="nameUser" class="form-control" aria-describedby="nameUserHelp" value="{{ old('nameUser') }}">
                    </div>
                    <div class="col">
                        <span id="nameUserHelp" class="form-text">Must be 4-20 characters long.</span>
                    </div>
                </div>
                <div class="input-group mb-3 row g-3 align-items-center">
                    <div class="col">
                        <label for="emailUser" class="col-form-label">Email</label>
                    </div>
                    <div class="col-6">
                        <input name="emailUser" type="text" id="emailUser" class="form-control" aria-describedby="emailUserHelp" value="{{ old('emailUser') ?? '' }}">
                    </div>
                    <div class="col">
                        <span id="emailUserHelp" class="form-text">Must be 4-20 characters long.</span>
                    </div>
                </div>
                <div class="input-group mb-3 row g-3 align-items-center">
                    <div class="col">
                        <label for="passwordUser" class="col-form-label">Password</label>
                    </div>
                    <div class="col-6">
                        <input name="passwordUser" type="password" id="passwordUser" class="form-control" aria-describedby="passwordUserHelp">
                    </div>
                    <div class="col">
                        <span id="passwordUserHelp" class="form-text">Must be 8-20 characters long.</span>
                    </div>
                </div>
                <div class="input-group mb-3 row g-3 align-items-center">
                    <div class="col">
                        <label for="repeatPass" class="col-form-label">Repeat password</label>
                    </div>
                    <div class="col-6">
                        <input name="passwordUser_confirmation" type="password" id="repeatPass" class="form-control" aria-describedby="repeatPassHelp">
                    </div>
                    <div class="col">
                        <span id="repeatPassHelp" class="form-text">Must be 4-20 characters long.</span>
                    </div>
                </div>
                <div class="row">
                    <div class="form-switch col">
                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="remember">
                        <label class="form-check-label" for="flexSwitchCheckDefault">Remember me</label>
                    </div>
                    <div class="input-group col offset-md-6">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
