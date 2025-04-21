<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../admin/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../admin/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Admin Login</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/admin/assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <link href="/admin/assets/demo/demo.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>       
      <div class="w-50 rounded px-3 py-3 mx-auto">
        <div class="card card-user">
          <div class="card-header">
            <h5 class="card-title">Admin Login</h5>
          </div>
          <div class="card-body">
            <form action="/login" method="POST">
              @csrf
              @if (Session::has('error'))
                <p style="color: red">{{ Session::get('error') }}</p>
              @endif
              @if ($errors->any())
                <ul>
                  @foreach ($errors->all() as $error)
                    <li style="color: red">{{ $error }}</li>
                  @endforeach
                </ul>
              @endif

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Email" name='email' value="{{ old('email') }}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Password" name="password">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="update ml-auto mr-auto">
                  <input type="submit" value="Login" class="btn btn-primary btn-round" />
                  <a href="/"><span class="btn btn-round btn-danger ms-3">Cancel</span></a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

    <script src="/admin/assets/js/core/jquery.min.js"></script>
    <script src="/admin/assets/js/core/popper.min.js"></script>
    <script src="/admin/assets/js/core/bootstrap.min.js"></script>
    <script src="/admin/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <script src="/admin/assets/js/plugins/chartjs.min.js"></script>
    <script src="/admin/assets/js/plugins/bootstrap-notify.js"></script>
    <script src="/admin/assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
    <script src="/admin/assets/demo/demo.js"></script>

    <script>
  // Intercept form submission
    $('form').submit(function (e) {
        e.preventDefault();

        const email = $('input[name="email"]').val();
        const password = $('input[name="password"]').val();
        const csrf_token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
        url: '/login',
        type: 'POST',
        data: {
            email: email,
            password: password,
            _token: csrf_token
        },
        success: function (data) {
            if (!data.success) {
            alert(data.message);
            return;
            }

            // Store the token in a cookie or localStorage
            localStorage.setItem('jwt_token', data.token);

            // Redirect to home or dashboard
            window.location.href = '/home';
        },
        error: function (xhr, status, error) {
            console.error(error);
            alert('Login failed. Please try again.');
        }
        });
    });
</script>


  </body>
</html>
