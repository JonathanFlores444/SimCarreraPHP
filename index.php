<!DOCTYPE html>
<html>
<head>
    <title>Simulación de Carrera</title>
</head>
<body>
    <h1>Simulación de Carrera</h1>
    <form method="POST">
        <label for="numCorr">Número de Corredores:</label>
        <input type="number" id="numCorr" name="numCorr" required>
        <br><br>
        <label for="distancia">Distancia (km):</label>
        <input type="number" step="0.01" id="distancia" name="distancia" required>
        <br><br>
        <input type="submit" value="Iniciar Carrera">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $numCorr = $_POST['numCorr'];
        $distancia = $_POST['distancia'];

        $url = "http://localhost:3000/carrera?numCorr=$numCorr&distancia=$distancia";
        $response = file_get_contents($url);
        $data = json_decode($response, true);

        echo "<h2>Resultados de la Carrera</h2>";
        echo "<p>Horas: " . $data['horas'] . "</p>";
        echo "<h3>Progreso por Hora</h3>";
        foreach ($data['progresoPorHora'] as $hora) {
            echo "<h4>Hora: " . $hora['hora'] . "</h4>";
            foreach ($hora['progreso'] as $progreso) {
                echo "<p>Corredor ID: " . $progreso['corredorId'] . ", Velocidad: " . $progreso['velocidad'] . " km/h, Distancia Recorrida: " . $progreso['distanciaRecorrida'] . " km</p>";
            }
        }
    }
    ?>
</body>
</html>
