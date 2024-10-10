@extends('master')

@section('content')
    <a name="" id="" class="btn btn-primary mt-5" href="{{ route('students.index') }}" role="button">quay lai</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Classroom</th>
                <th>Passport_number</th>
                <th>Mon hoc</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>{{ $dataStudent->name }}</td>
                    <td>{{ $dataStudent->email }}</td>
                    <td>{{ $dataStudent->classroom->name }}</td>
                    <td>{{ $dataStudent->passport->passport_number }}</td>
                    <td>
                        @foreach ($dataStudent->subjects as $item)
                            <button class="btn btn-danger">{{$item->name}}</button>
                        @endforeach
                    </td>

                </tr>
        </tbody>
    </table>
@endsection
