<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() ?>/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/vendor/fontawesome-free/css/fontawesome.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url() ?>/assets/vendor/fontawesome-free/css/v4-shims.css" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" href="<?= base_url() ?>/assets/vendor/landing-page/assets/images/plane.png" />

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/landing-page/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/home.css">


    <?= $this->renderSection('styles') ?>

    <title>Beranda - Sistem Persuratan Biro Humas & Hukum BPS</title>
</head>

<body>
    <div class="d-flex flex-column min-vh-100">
        <div class="container mb-auto">
            <header class="head my-3">
                <nav class="navbar navbar-expand-lg navbar-light head__custom-nav">
                    <a class="navbar-brand d-flex align-items-center" href="home">
                        <img src="<?= base_url() ?>/assets/vendor/landing-page/assets/images/plane.png" alt="website logo">
                        <span>Sistem Persuratan</span>
                    </a>
                    <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarNav">
                        <span><i class="fas fa-bars"></i></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="home">Beranda</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-primary" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
        </div>

        <div class="container">
            <div class="row custom-section d-flex align-items-center">
                <div class="col-12 col-lg-4">
                    <h2>Sistem</h2>
                    <h2>Persuratan</h2>
                    <h5>Biro Humas & Hukum BPS</h5>
                    <a href="#" data-toggle="modal" data-target="#loginModal" id="loginButton">Login &nbsp;<i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="col-12 col-lg-8">
                    <img src="<?= base_url() ?>/assets/vendor/landing-page/assets/images/send-letter.svg" alt="send letter" class="mt-5">
                </div>
            </div>
            <button id="trigger" onclick="<?php if (isset($validation)) : ?> $('#loginButton').trigger('click'); <?php endif; ?>" hidden>Trigger</button>
        </div>

        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-title text-center">
                            <h4>Login</h4>
                        </div>
                        <hr class="sidebar-divider pb-3">
                        <?php if (isset($validation)) : ?>
                            <div class="col-12">
                                <div class="alert alert-danger text-left" role="alert">
                                    <?= $validation->listErrors() ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="d-flex flex-column text-center">
                            <form class="user" method="post" action="<?= base_url('home') ?>">
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block btn-round pb-2">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="sticky-footer bg-dark mt-auto">
            <div class="container my-auto">
                <div class="copyright text-center my-auto text-white">
                    <span>Copyright &copy; Biro Humas dan Hukum BPS RI <?= Date('Y') ?> </span>
                </div>
            </div>
        </footer>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <!-- Popper JS -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#trigger').trigger('click');
        });

        $(function() {
            $('#submitLogin').on('click', function(e) {
                $('#formLogin').submit();
            });
        });
    </script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>