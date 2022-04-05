@extends('layouts.app')
@section('title','Fakultas')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Detail Project</div>

                <div class="card-body">

                    <table class="table table-bordered">
                        <tr>
                            <td width="200">Project Name</td><td> : {{ $project->project_name }}</td>
                        </tr>
                        <tr>
                            <td>Client Name</td><td> : {{ $project->client_name }}</td>
                        </tr>
                        <tr>
                          <td>Total Budged</td><td> : Rp. {{ rupiah(\DB::select('select sum(price) as total_budged from modules where project_id='.$project->id)[0]->total_budged) }}</td>
                      </tr>
                    </table>
                    
                   <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add Module
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalFeature">
                        Add Feature
                    </button>
                    <a class="btn btn-primary" href="/project/{{ $project->id }}/pdf">Export To PDF</a>
                    <hr>
                    @include('alert')
                    <table class="table table-bordered" id="users-table">
                            <thead>
                                <tr>
                                    <th width="50">Code</th>
                                    <th>Module Name</th>
                                    <th width="340">Feature</th>
                                    <th width="80">Price</th>
                                    <th width="39">Action</th>
                                </tr>
                            </thead>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Form Module</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{ Form::open(['url'=>'module'])}}
        {{ Form::hidden('project_id',$project->id)}}
        <input type="hidden" name="module_id" class="module_id">
        <div class="modal-body">
          <table class="table table-bordered">
              <tr>
                  <td width="180">Module Code</td>
                  <td>{{ Form::text('module_code',null,['class'=>'form-control module_code','placeholder'=>'Module Code'])}}</td>
              </tr>
              <tr>  
                <td>Module name</td>
                  <td>{{ Form::text('module_name',null,['class'=>'form-control module_name','placeholder'=>'Module Name'])}}</td>
              </tr>
              <tr>
                <td>Price</td>
                <td>{{ Form::text('price',null,['class'=>'form-control price','placeholder'=>'Price'])}}</td>
            </tr>
            <tr>
              <td>Description</td>
              <td>{{ Form::textarea('description',null,['class'=>'form-control description','placeholder'=>'Description'])}}</td>
          </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Data</button>
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>



<!-- Modal -->
<div class="modal fade" id="exampleModalFeature" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Feature</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        {{ Form::open(['url'=>'feature'])}}
        {{ Form::hidden('project_id',$project->id)}}
        <input type="hidden" name="feature_id" class="feature_id">
        <div class="modal-body">
          <table class="table table-bordered">
            <tr>  
                <td>Module name</td>
                  <td>{{ Form::select('module_id',$module,null,['class'=>'form-control module_id'])}}</td>
              </tr>
              <tr>
                  <td>Feature</td>
                  <td>{{ Form::text('name',null,['class'=>'form-control feature_name','placeholder'=>'Feature Name'])}}</td>
              </tr>
            <tr>
              <td>Is Done</td>
              <td>{{ Form::select('is_done',[0=>'No',1=>'Yes'],null,['class'=>'form-control is_done'])}}</td>
          </tr>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Data</button>
        </div>
        {{ Form::close() }}
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
        ajax: '/project/{{$project->id}}',
        columns: [
            { data: 'module_code', name: 'module_code' },
            { data: 'module_name', name: 'module_name' },
            { data: 'feature', name: 'feature' },
            { data: 'price', name: 'price' },
            { data: 'action', name: 'action' }
        ]
    });
});

function editModule(id){
  console.log(id);
  $.ajax({
    url: "/module/"+id,
    type: "GET",
    success: function(response) {
      console.log(response);
      $(".module_name").val(response.module_name);
      $(".module_code").val(response.module_code);
      $(".price").val(response.price);
      $(".description").val(response.description);
      $(".module_id").val(response.id);
    }
});
}

function featureEdit(id){
  console.log(id);
  $.ajax({
    url: "/feature/"+id,
    type: "GET",
    success: function(response) {
      console.log(response);
      $(".feature_name").val(response.name);
      $(".feature_id").val(response.id);
      $(".module_id").val(response.module_id).change();
      $(".is_done").val(response.is_done).change();
    }
});
}
function featureDelete(id){
  console.log(id);
  $.ajax({
    url: "/feature/"+id,
    data: {
        "_token": "{{ csrf_token() }}"
        },
    type: "DELETE",
    success: function(response) {
      console.log(response);
      location.reload();
    }
});
}
</script>
@endpush

@push('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endpush
