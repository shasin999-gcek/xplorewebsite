<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Feedback form</title>
</head>
<body>
    <div class="container">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{ $sendData['name'] }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $sendData['email'] }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $sendData['phone'] }}</td>
                </tr>
                <tr>
                    <th>Subject</th>
                    <td>{{ $sendData['subject'] }}</td>
                </tr>
                <tr>
                    <th>Message</th>
                    <td>{{ $sendData['message'] }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>