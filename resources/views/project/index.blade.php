@extends('layouts.app')
@section('title','Manage Project')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Manage Project</div>

                <div class="card-body">
                    <a href="/project/create" class="btn btn-danger">Input Data Baru</a>
                    <hr>
                    @include('alert')
                    <table class="table table-bordered" id="users-table">
                            <thead>
                                <tr>
                                    <th width="300">Nama Project</th>
                                    <th>Nama Client</th>
                                    <th width="79">Action</th>
                                </tr>
                            </thead>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/project',
        columns: [
            { data: 'project_name', name: 'project_name' },
            { data: 'client_name', name: 'client_name' },
            { data: 'action', name: 'action' }
        ]
    });
});
</script>
@endpush

@push('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush
