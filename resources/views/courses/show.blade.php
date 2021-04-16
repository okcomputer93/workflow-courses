<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Such an ugly view for a course</title>
</head>
<body>
    <h1>{{ $course->title }}</h1>
    <p>{{ $course->description }}</p>
    <span>{{ $course->rate }}</span>
</body>
</html>
