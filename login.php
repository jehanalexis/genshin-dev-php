<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>

<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box"
                style="background-image: url('img/urushi.png'); background-size: cover; background-position: center;">
                <div class="featured-image mb-3"></div>
            </div>
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4">
                        <h2>Login to Hangout Dashboard</h2>
                    </div>
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <input type="text" id="username" name="username"
                                class="form-control form-control-lg bg-light fs-6" placeholder="@username" required>
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" id="password" name="password"
                                class="form-control form-control-lg bg-light fs-6" placeholder="Password" required>
                        </div>
                        <small class="text-danger fs-7">
                            <?php
                            if (isset($_SESSION['error'])) {
                                echo htmlspecialchars($_SESSION['error']);
                                unset($_SESSION['error']);
                            }
                            ?>
                        </small>
                        <small class="text-success fs-7">
                            <?php
                            if (isset($_SESSION['success'])) {
                                echo htmlspecialchars($_SESSION['success']);
                                unset($_SESSION['success']);
                            }
                            ?>
                        </small>
                        <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck">
                                <label for="formCheck" class="form-check-label text-secondary"><small>Remember
                                        Me?</small></label>
                            </div>
                            <div class="forgot">
                                <small><a href="reset.php">Forgot Password?</a></small>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <button class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                        </div>
                    </form>

                    <div class="mb-3 d-flex gap-3">
                        <a href="<?= $googleAuthUrl ?>"
                            class="btn btn-lg btn-light fs-6 flex-grow-1 d-flex align-items-center justify-content-center"
                            style="height: 50px;">
                            <img src="img/google.png" style="width: 20px" class="me-2">
                            <small></small>
                        </a>
                        <a href="<?= $discordAuthUrl ?>"
                            class="btn btn-lg fs-6 text-white flex-grow-1 d-flex align-items-center justify-content-center"
                            style="background-color: #5865F2; height: 50px;">
                            <img src="img/discord.png" style="width: 20px" class="me-2">
                            <small></small>
                        </a>
                    </div>

                    
                    
                    <div class="row">
                        <small>Don't have an account? <a href="signup.php">Sign Up</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>