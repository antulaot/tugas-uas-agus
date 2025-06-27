<!-- views/partials/header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= isset($pageTitle) ? $pageTitle . ' | Punya Agus' : 'Login Dulu Gaess' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body class="container mt-4">

<?php if (isset($_SESSION['user'])): ?>
    <div class="text-end">
        <span class="me-2">Halo, <?= htmlspecialchars($_SESSION['user']['username']) ?></span>
        <a href="/logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
    </div>
<?php endif; ?>
