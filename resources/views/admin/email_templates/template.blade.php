<!DOCTYPE html>
<html>
<head>
    <title>{{$messageTemplate['subject']}}</title>
</head>
<body>
    <p>Dear, {{$recipient->first_name}}. </p>
    <p>{{ $messageTemplate['body']}}</p>
    <p>Thank you for attention {{$recipient->first_name}} {{$recipient->last_name}}. Good luck!</p>
</body>
</html>
