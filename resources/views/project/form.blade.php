<table class="table table-bordered">
    <tr>
        <td>Project Name</td>
        <td>
            {{ Form::text('project_name',null,['class'=>'form-control','placeholder'=>'Project Name'])}}
        </td>
    </tr>
    <tr>
        <td>Client Name</td>
        <td>
            {{ Form::text('client_name',null,['class'=>'form-control','placeholder'=>'Client Name'])}}
        </td>
    </tr>
    <tr>
        <td></td>
        <td>
            <button type="submit" class="btn btn-danger">Save</button>
            <a href="{{ url('project')}}" class="btn btn-danger">Back</a>
        </td>
    </tr>
</table>

