@extends('master')
@section('content')
    <form action="{{ route('session.thanhcong') }}" method="post">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Số lượng</th>
                    <th>Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$data['name']}}</td>
                    <td>{{$data['age']}}</td>
                    <td>{{$data['quantity']}}</td>
                    <td>{{$data['status']}}</td>
                </tr>
            </tbody>
        </table>
        <button class="btn btn-primary" type="submit">Xác nhận</button>
    </form>
@endsection