@extends('layouts.app')
@section('title','EditProject')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Project</div>

                <div class="card-body">

                    @include('validation_error')
                    
                    {{ Form::model($project,['url'=>'project/'.$project->id,'method'=>'PUT'])}}
                    @include('project.form')
                   {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
