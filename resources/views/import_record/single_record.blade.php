<!DOCTYPE html>
<html>
<head>
    <title>Import Excel File in Laravel</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<br />

<div class="container">
    <h3 align="center">Single Record of each file</h3>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Record</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Name</th>
                        <th>Roll Number</th>
                        <th>Tester</th>
                    </tr>
                    @foreach($data->records as $file)
                    <tr>
                        <td>{{$file->name}}</td>
                        <td>{{$file->roll_number}}</td>
                        <td>{{$file->tester}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <a href="{{route('index')}}" type="button" class="btn btn-success">Back</a>
</div>
</body>
</html>
