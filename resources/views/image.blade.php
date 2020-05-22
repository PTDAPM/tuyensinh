<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel Multi Uploading Example</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"         integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"       integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <base href="{{asset('')}}">
    <!-- Styles -->
    <style>
        .container {
            margin-top:2%;
        }
    </style>
</head>
<body>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-2"> <img src="/upload_icon.png" width="80" /></div>
            <div class="col-md-8"><h2>Laravel 5.5 Multiple File Uploading</h2></div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <form action="./multiuploads" method="post" enctype="multipart/form-data">
                    @csrf
                    <label for="Product Name">Product photos (can upload multi photos):</label>
                    <br>
                    <input type="file" class="form-control" name="photos[]" multiple />
                    <br><br>
                    <input type="submit" class="btn btn-primary" value="Upload" />
                </form>
            </div>
        </div>
    </div>
</body>
</html>