<?php
include "connessione.php";
// Disattiva i messaggi di warning sul browser
error_reporting(E_ERROR | E_PARSE);

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
// Verifica se esiste il macchinario
$result = $connessione->query("SELECT * FROM macchinari WHERE id = $id");
if (!$result || $result->num_rows == 0) {
    echo "<h1>Macchinario non trovato</h1>";
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
</head>
<body>
    <h1>Manutenzione: <?php echo htmlspecialchars($macchinario['nome']); ?></h1>
    <p><?php echo nl2br(htmlspecialchars($macchinario['descrizione'])); ?></p>

    <h2>File di manutenzione</h2>

    <?php if ($file_count > 0): ?>
        <ul>
            <?php while ($row = $files->fetch_assoc()): ?>
                <li><a href="<?php echo htmlspecialchars($row['path_file']); ?>" target="_blank">
                    <?php echo htmlspecialchars($row['nome_file']); ?>
                </a></li>
            <?php endwhile; ?>
        </ul>
    <?php else: ?>
        <p>Nessun file di manutenzione disponibile.</p>

        <!-- Form di caricamento -->
        <h3>Carica un file di manutenzione</h3>
        <form method="POST" enctype="multipart/form-data" action="upload.php">
            <input type="hidden" name="id_macchinario" value="<?php echo $id; ?>">
            <label for="file">Seleziona file:</label>
            <input type="file" name="file" id="file" required><br><br>
            <button type="submit">Carica</button>
        </form>
    <?php endif; ?>
</body>
</html>