<!DOCTYPE html>
<html>
<head>

</head>
<body>

<h2>Welcome {{ $name }} !</h2>
<br>
<h2> All to do tasks of {{ $name }}:</h2>
<table id="t01">
    <tr>
        <th>Title</th>
        <th>Datetime</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
    <tr>
        <td>Jill</td>
        <td>Smith</td>
    </tr>
</table>
</body>

<style>
    table {
        width: 100%;
    }

    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th, td {
        padding: 15px;
        text-align: left;
    }

    table#t01 tr:nth-child(even) {
        background-color: #eee;
    }

    table#t01 tr:nth-child(odd) {
        background-color: #fff;
    }

    table#t01 th {
        background-color: black;
        color: white;
    }
</style>

</html>
