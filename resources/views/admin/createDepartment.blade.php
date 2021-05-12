<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LodgeSpot - 0.0</title>
</head>
<body>
@if ($errors->any())
    <div style="background-color: rgba(200,10,20,.3)">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
    <div style="background-color: rgba(10,200,20,.3)">
        {{ session('success') }}
    </div>
@endif
<form action="/add_department" method="post">
    @csrf
    <input type="text" name="department" placeholder="Add Department">
    <input type="number" name="level" placeholder="Add Level">
    <input type="submit" value="Create LodgeSpot">
</form>

<h3>All LodgeSpot Locations</h3>
<table border="1" width="300">
    <tr>
        <th>Department</th>
        <th>Level</th>
    </tr>
    @foreach($departments as $department)
        <tr>
            <td>
                {{ $department->department }}
            </td>
            <td>
                {{ $department->level }}
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>