@extends('master')
@section('content')
<img src="{{ url('employees.show' . $employee->id) }}" alt="Employee Photo">
@endsection
