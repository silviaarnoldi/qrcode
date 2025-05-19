<?php
include "connessione.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_macchinario = isset($_POST["id_macchinario"]) ? intval($_POST["id_macchinario"]) : 0;
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        $nome_file = $connessione->real_escape_string($_FILES["file"]["name"]);
        $tipo_file = $connessione->real_escape_string($_FILES["file"]["type"]);

        $sql = "INSERT INTO file_manutenzione (id_macchinario, nome_file, path_file, tipo_file)
                VALUES ($id_macchinario, '$nome_file', '$target_file', '$tipo_file')";
        if ($connessione->query($sql) === TRUE) {
            // Redirect alla pagina del macchinario dopo upload
            header("Location: macchinario.php?id=$id_macchinario");
            exit;
        } else {
            echo "Errore nel salvataggio nel database: " . $connessione->error;
        }
    } else {
        echo "Errore nel caricamento del file.";
    }
} else {
    echo "Metodo non consentito.";
}
?>