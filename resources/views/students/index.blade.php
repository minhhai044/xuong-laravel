@extends('master')

@section('content')
    <a name="" id="" class="btn btn-primary my-5" href="{{ route('students.create') }}" role="button">Them
        moi</a>
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataStudent as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->classroom->name }}</td>
                    <td>
                        <a name="" id="" class="btn btn-primary" href="{{ route('students.show', $item) }}"
                            role="button">Show</a>
                        <a name="" id="" class="btn btn-primary" href="{{ route('students.edit', $item) }}"
                            role="button">Edit</a>
                        <form action="{{ route('students.destroy', $item) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Ban co muon xoa khong ?')"
                                class="btn btn-danger">DELETE</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $dataStudent->links() }}
@endsection
