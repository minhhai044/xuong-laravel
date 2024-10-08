@extends('master')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $item)
           <ul>
            <li>{{$item}}</li>
           </ul>
        @endforeach
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-danger">
        {{session()->get('error')}}
    </div>
@endif
    <div class="container">
        <form action="{{ route('employees.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="first_name" class="col-4 col-form-label">First_name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{old('first_name')}}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="last_name" class="col-4 col-form-label">Last_name</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{old('last_name')}}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-4 col-form-label">Email</label>
                <div class="col-8">
                    <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="phone" class="col-4 col-form-label">Phone</label>
                <div class="col-8">
                    <input type="tel" class="form-control" name="phone" id="phone" value="{{old('phone')}}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="date_of_birth" class="col-4 col-form-label">Date_of_birth</label>
                <div class="col-8">
                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{old('date_of_birth')}}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="hire_date" class="col-4 col-form-label">hire_date</label>
                <div class="col-8">
                    <input type="date" class="form-control" name="hire_date" id="hire_date" value="{{old('hire_date')}}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="is_active" class="col-4 col-form-label">Is_active</label>
                <div class="col-8">
                    <input type="checkbox" checked class="form-checkbox" name="is_active" id="is_active" value="1" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="address" class="col-4 col-form-label">Address</label>
                <div class="col-8">
                    <input type="text" class="form-control" name="address" id="address" value="{{old('address')}}" />
                </div>
            </div>
            <div class="mb-3 row">
                <label for="profile_picture" class="col-4 col-form-label">Profile_picture</label>
                <div class="col-8">
                    <input type="file" class="form-control" name="profile_picture" id="profile_picture" value="{{old('profile_picture')}}" />
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
    </div>
@endsection
