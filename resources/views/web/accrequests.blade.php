<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="Favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <title>Roadmate</title>
  </head>
  <body>
    <main class="login-form">
   
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
                @if(Session::has('message'))
                    <div class="alert alert-info">{{ Session::get('message') }}</div>
                @endif
              <div class="card-header">Do you want to delete your acount?</div>
              <div class="card-body">
                <form action="{{route('account.delete_request')}}" method="post">
                    @csrf
                  <div class="form-group row">
                    <div class="col-md-6">
                      <input type="checkbox" name="status" required> Yes
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="email_address" class="col-md-4 col-form-label text-md-right">Mobile Number</label>
                    <div class="col-md-6">
                      <input type="number"  class="form-control" name="phone_number" required autofocus>
                    </div>
                  </div>
                  <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary"> Request </button>
                  </div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      </div>
    </main>
  </body>
</html>