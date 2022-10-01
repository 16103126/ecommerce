<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{__('Ecommerce')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container mt-5">
        <div class="card shadow p-4">
            <p><span class="fw-bold">Date:</span> {{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
            <p><span class="fw-bold">Order No#:</span> {{ \Carbon\Carbon::now()->toFormattedDateString() }}</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>