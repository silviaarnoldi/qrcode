<?php
include "connessione.php";
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php?err=Accesso negato");
    exit;
}

$macchinari = $connessione->query("SELECT * FROM macchinari");
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Area Admin - Upload Documenti</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Pannello Admin</a>
        <div class="ms-auto">
            <a href="logout.php" class="btn btn-outline-danger">Logout</a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <h1 class="mb-4">Gestione Documenti Macchinari</h1>

    <?php while ($macchinario = $macchinari->fetch_assoc()): ?>
        <div class="card mb-4 shadow-sm">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($macchinario['nome']); ?></h5>
                <p class="card-text"><?php echo nl2br(htmlspecialchars($macchinario['descrizione'])); ?></p>

                <form method="POST" enctype="multipart/form-data" action="upload.php">
                    <input type="hidden" name="id_macchinario" value="<?php echo $macchinario['id']; ?>">
                    <div class="mb-3">
                        <label for="file_<?php echo $macchinario['id']; ?>" class="form-label">Carica file di manutenzione:</label>
                        <input type="file" name="file" id="file_<?php echo $macchinario['id']; ?>" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Carica</button>
                </form>
            </div>
        </div>
    <?php endwhile; ?>
</div>
</body>
</html>