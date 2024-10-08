@extends('master')
@section('content')
    <h1>Thêm mới</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger">
        {{session()->get('error')}}
    </div>
@endif
    <form action="{{ route('customers.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3 row">
            <label for="name" class="col-4 col-form-label">Name</label>
            <div class="col-8">
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" />
            </div>
        </div>

        <div class="mb-3 row">
            <label for="address" class="col-4 col-form-label">Address</label>
            <div class="col-8">
                <input type="text" class="form-control" name="address" id="address" value="{{ old('address') }}" />
            </div>
        </div>
        <div class="mb-3 row">
            <label for="email" class="col-4 col-form-label">Email</label>
            <div class="col-8">
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" />
            </div>
        </div>
        <div class="mb-3 row">
            <label for="phone" class="col-4 col-form-label">Phone</label>
            <div class="col-8">
                <input type="tel" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" />
            </div>
        </div>
        <div class="mb-3 row">
            <label for="avatar" class="col-4 col-form-label">Avatar</label>
            <div class="col-8">
                <input type="file" class="form-control" name="avatar" id="avatar" />
            </div>
        </div>
        <div class="mb-3 row">
            <label for="is_active" class="col-4 col-form-label">Is Active</label>
            <div class="col-8">
                <input type="checkbox" class="form-checkbox" value="1" name="is_active" id="is_active" />
            </div>
        </div>
        <div class="mb-3 row">
            <div class="offset-sm-4 col-sm-8">
                <button type="submit" class="btn btn-primary">
                    Thêm mới
                </button>
            </div>
        </div>



    </form>
@endsection
