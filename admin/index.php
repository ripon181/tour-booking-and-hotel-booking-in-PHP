<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
  <title>Backpackers | Admin Login</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="login-page">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
              <h3 class="mb-3 d-flex justify-content-center mb-5">ADMIN LOGIN</h3>
                <div class="shadow rounded">
                    <div class="row">
                        <div class="col-md-12 pe-0">
                            <div class="form-left h-100 py-5 px-5">
                                <form action="loginAction.php" method="POST" class="row g-4">
                                        <div class="col-6">
                                            <label>Email<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                                <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <label>Password<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                                <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <input type="submit" class="btn btn-primary px-4 float-start mt-4 w-100" value="LOGIN">
                                        </div>
                                </form>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>