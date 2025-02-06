@extends('siproblem.layouts.main')
@section('content')
    <div class="row row-cols-1 row-cols-md-2 mb-3 text-center">
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-body">
                    <a href="{{ route('siproblem.admin.department') }}" type="button" class="w-100 btn btn-lg btn-outline-primary">Data Department</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-body">
                    <a href="{{ route('siproblem.admin.problem') }}" type="button" class="w-100 btn btn-lg btn-outline-primary">Data Problem</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-body">
                    <a href="{{ route('siproblem.admin.user') }}" type="button" class="w-100 btn btn-lg btn-outline-primary">Data User</a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-body">
                    <a href="#" type="button" class="w-100 btn btn-lg btn-outline-primary">Data Log</a>
                </div>
            </div>
        </div>
    </div>
@endsection
