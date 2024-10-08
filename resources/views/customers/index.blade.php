@extends('master')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <h1>Danh sách</h1>
    <table class="table">
        <thead>

        </thead>
        <tbody>
            <a class="btn btn-primary" href="{{ route('customers.create') }}" role="button">Thêm mới</a>

            @foreach ($datas as $data)
                <tr>
                    <td> {{ $data->id }} </td>
                    <td> {{ $data->name }} </td>
                    <td>
                        @if ($data->avatar)
                            <img src="{{ Storage::url($data->avatar) }}" width="100px">
                        @endif
                    </td>
                    <td> {{ $data->phone }} </td>
                    <td> {{ $data->email }} </td>
                    <td>
                        @if ($data->is_active)
                            <button disabled class="btn btn-success">Yes</button>
                        @else
                            <button disabled class="btn btn-danger">No</button>
                        @endif
                    </td>
                    <td> {{ $data->address }} </td>
                    <td>
                        <a  class="btn btn-primary" href="{{route('customers.show',$data)}}" role="button">show</a>
                        <a  class="btn btn-primary" href="{{route('customers.edit',$data)}}" role="button">Edit</a>
                        <form action="{{route('customers.destroy',$data)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Bạn có chắc xóa không !!!')" type="submit" class="btn btn-danger">DELETE</button>
                        </form>
                        <form action="{{route('customers.forceDestroy',$data)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Bạn có chắc xóa không !!!')" type="submit" class="btn btn-danger">forceDestroy</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
