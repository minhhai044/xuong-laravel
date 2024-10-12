@extends('master')

@section('content')
    <a name="" id="" class="btn btn-primary my-5" href="{{ route('students.index') }}" role="button">quay lại</a>
    @if (session()->has('success'))
        <div class="alert alert-success my-3">{{ session()->get('success') }}</div>
    @endif
    <form action="{{ route('search') }}" method="post">
        @csrf
        <input type="text" name="keyword">
        <button type="submit">Search</button>
    </form>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Classroom</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($search as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->classroom->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
