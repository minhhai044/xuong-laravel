@extends('master')
@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <a name="" id="" class="btn btn-primary" href="{{ route('employees.create') }}" role="button">Thêm mới</a>
        
    <table class="table">
        <thead></thead>
        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td> {{ $employee->id }} </td>
                    <td> {{ $employee->first_name }} </td>
                    <td>
                        @if ($employee->profile_picture)
                            <img src="data:image/png;base64, {{ $employee->profile_picture}}" width="100px" alt="">
                        @endif
                    </td>
                    <td> {{ $employee->last_name }} </td>
                    <td> {{ $employee->email }} </td>
                    <td> {{ $employee->phone }} </td>
                    <td> {{ $employee->date_of_birth }} </td>
                    <td> {{ $employee->hire_date }} </td>
                    <td> {{ $employee->is_active }} </td>
                    <td> {{ $employee->address }} </td>
                    <td>
                        <a name="" id="" class="btn btn-primary" href="{{route('employees.show',$employee)}}" role="button">Show ảnh</a>
                        <a name="" id="" class="btn btn-warning" href="{{route('employees.edit',$employee)}}" role="button">Edit</a>
                        <form action="{{route('employees.destroy', $employee)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Bạn có chắc chắn xóa không !!!')" class="btn btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $employees->links() }}
@endsection
