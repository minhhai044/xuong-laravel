@extends('master')
@section('content')
    <form action="{{ route('session.capnhat') }}" method="post">
        @csrf
        <div class="container">
            <h1>Số lượng</h1>
            <form>
                <div class="mb-3 row">
                    <label for="name" class="col-4 col-form-label">Số lượng</label>
                    <div class="col-8">
                        <input type="number" class="form-control" name="quantity" id="name" />
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <div class="offset-sm-4 col-sm-8">
                        <button type="submit" class="btn btn-primary">
                            Tiếp tục
                        </button>
                    </div>
                </div>
            </form>
        </div>

    </form>
@endsection
