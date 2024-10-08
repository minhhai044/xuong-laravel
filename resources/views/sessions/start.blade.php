@extends('master')
@section('content')
@if (session()->has('success'))
    <div class="alert alert-success">
        {{session()->get('success')}}
    </div>
@endif
    <form action="{{ route('session.khoitao') }}" method="post">
        @csrf
        <div class="container">
            <h1>Điên thông tin</h1>

            <div class="mb-3 row">
                <label for="name" class="col-4 col-form-label">Name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="name" id="name" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="age" class="col-4 col-form-label">Age</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="age" id="age" />
                </div>
            </div>

            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        Them
                    </button>
                </div>
            </div>

        </div>

    </form>
@endsection
