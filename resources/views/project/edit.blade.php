@extends('layouts.app')
@section('title','Edit Data Fakultas')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Data fakultas</div>

                <div class="card-body">
                    @include('validation_error')

                    {{ Form::model($fakultas,['url'=>'fakultas/'.$fakultas->kode_fakultas,'method'=>'PUT'])}}

                        @csrf

                        <div class="form-group row">
                            <label class="col-md-2 col-form-label text-md-right">Kode Fakultas</label>
                            <div class="col-md-6">
                                {{ Form::text('kode_fakultas',null,['class'=>'form-control','placeholder'=>'Kode fakultas','readonly'=>''])}}
                            </div>
                        </div>

                        @include('fakultas.form')

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-2">

                                {{ Form::submit('Simpan Data',['class'=>'btn btn-primary'])}}
                                <a href="/fakultas" class="btn btn-primary">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
