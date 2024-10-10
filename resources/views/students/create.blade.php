@extends('master')

@section('content')
    <div class="container">
        @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        <form action="{{route('students.store')}}" method="POST">
            @csrf
            <div class="border p-5">
                <div class="mb-3 row">
                    <label for="name" class="col-4 col-form-label">Classroom</label>
                    <div class="col-8">
                        <select class="form-select" name="student[classroom_id]" id="">
                            @foreach ($classrooms as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="name" class="col-4 col-form-label">Name</label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="student[name]" id="name" />
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-4 col-form-label">Email</label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="student[email]" id="email" />
                    </div>
                </div>


                
            </div>

            <div class="border p-5">
                <div class="mb-3 row">
                    <label for="passport_number" class="col-4 col-form-label">Passport number</label>
                    <div class="col-8">
                        <input type="text" class="form-control" name="passport[passport_number]" id="passport_number" />
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="issued_date" class="col-4 col-form-label">Issued_date</label>
                    <div class="col-8">
                        <input type="date" class="form-control" name="passport[issued_date]" id="issued_date" />
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="expiry_date" class="col-4 col-form-label">Expiry_date</label>
                    <div class="col-8">
                        <input type="date" class="form-control" name="passport[expiry_date]" id="expiry_date" />
                    </div>
                </div>

            </div>
            <div class="border p-5">
                <div class="mb-3 row">
                    <label for="passport_number" class="col-4 col-form-label">Supjects</label>
                    <div class="col-8">
                        <select class="form-select" name="subject[]" multiple id="">
                            @foreach ($supjects as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


            </div>
            <div class="mb-3 row">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-primary">
                        Them
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
