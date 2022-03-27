@extends('layouts.app')
@section('title','Create New Project')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Create New Project</div>

                <div class="card-body">

                    @include('validation_error')
                    
                    {{ Form::open(['url'=>'project'])}}
                    @include('project.form')
                   {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
