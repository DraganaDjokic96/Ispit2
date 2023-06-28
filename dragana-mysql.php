<?php
// MySQL podaci
$servername = "localhost";
$username = "root";
$password = "lozinka";
$dbname = "ime_baze";

// Uspostavljanje veze s bazom
$conn = new mysqli($servername, $username, $password, $dbname);

// Provjera veze
if ($conn->connect_error) {
die("Greška prilikom spajanja na bazu podataka: " . $conn->connect_error);
}

// SQL upit za kupljenje podataka iz baze
$sql = "SELECT * FROM naziv_tabele";

// Izvršavanje upita
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Stvaranje CSV sadržaja
    $csvFile = fopen('podaci.csv','w');
fputcsv($csvFile,$header);
while ($row = $result->fetch_assoc()) {
        $data .= $row["kolona1"] . "," . $row["kolona2"] . "," . $row["kolona3"] . "\n";
        fputcsv($csvFile,$data);
    }
    //zatvaranje CSV datoteke
fclose($csvFile);
   

    
echo "Podaci su uspjesno prebaceni u CSV format";
} else {
echo "Nema dostupnih podataka za izvoz.";
}

// Zatvaranje veze s bazom
$conn->close();
?>
