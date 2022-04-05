<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
        }

        table,
        td,
        th {
            border: 1px solid;
            padding: 5px;
            text-align: left;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <table>
        <tr>
            <td width="350">Project Name</td>
            <td> : {{ $project->project_name }}</td>
        </tr>
        <tr>
            <td>Client Name</td>
            <td> : {{ $project->client_name }}</td>
        </tr>
        {{-- <tr>
          <td>Total Budged</td><td> : Rp. {{ rupiah(\DB::select('select sum(price) as total_budged from modules where project_id='.$project->id)[0]->total_budged) }}
        </td>
        </tr> --}}
    </table>
    <table>
        <tr>
            <th width="40">CODE</th>
            <th width="300">MODULE NAME</th>
            <th width="300">FEATURE</th>
        </tr>
        @foreach($project->module as $module)
        <tr>
            <td> {{ $module->module_code }}</td>
            <td> {{ $module->module_name }}<br> {{ $module->description }}</td>
            <td valign="top">
                @foreach($module->feature as $feature)
                <input type="checkbox">{{ $feature->name }}<br>
                @endforeach
            </td>
        </tr>
        @endforeach
    </table>
</body>

</html>