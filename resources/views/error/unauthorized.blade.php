<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forbidden</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</head>
<body>
     <div class="container">
        <div class="text-center">
            <h1 class="mb-4"><i class="bi bi-x-circle-fill text-danger animated shake"></i></h1>
            <h2 class="mb-4">Unauthorised Access!</h2>
            <p class="lead">You are not authorized to access this page.</p>
        </div>
        <div class=" d-flex justify-content-center w-100">
            <img src="{{asset ('img/error.gif')}}" class="img-fluid" style="width:500px;height:500px;">

           </div>
           <div style="text-align:center;">
            <a href="/" type="button" class="btn btn-primary">GO TO HOMEPAGE</a>
            </div>
    </div>
</body>
</html>
