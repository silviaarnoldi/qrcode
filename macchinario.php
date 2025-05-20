<?php
include "connessione.php";
error_reporting(E_ERROR | E_PARSE);

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$result = $connessione->query("SELECT * FROM macchinari WHERE id = $id");

if (!$result || $result->num_rows == 0) {
    echo "<div class='alert alert-danger m-4'><h1>Macchinario non trovato</h1></div>";
    exit;
}

$macchinario = $result->fetch_assoc();
$files = $connessione->query("SELECT * FROM file_manutenzione WHERE id_macchinario = $id");
$file_count = ($files) ? $files->num_rows : 0;
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Manutenzione - <?php echo htmlspecialchars($macchinario['nome']); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Gestione Macchinari</a>
        <div class="ms-auto">
            <a href="login.php" class="btn btn-outline-primary">Login</a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <div class="card shadow">
        <div class="card-body">
            <h1 class="card-title">Manutenzione: <?php echo htmlspecialchars($macchinario['nome']); ?></h1>
            <p class="card-text"><?php echo nl2br(htmlspecialchars($macchinario['descrizione'])); ?></p>
        </div>
    </div>

    <div class="mt-4">
        <h2>File di manutenzione</h2>

        <?php if ($file_count > 0): ?>
            <ul class="list-group mt-3">
                <?php while ($row = $files->fetch_assoc()): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo htmlspecialchars($row['nome_file']); ?>
                        <a class="btn btn-sm btn-primary" href="<?php echo htmlspecialchars($row['path_file']); ?>" target="_blank">Visualizza</a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <div class="alert alert-warning mt-3">Nessun file di manutenzione disponibile.</div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>