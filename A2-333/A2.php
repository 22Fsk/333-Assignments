<?php

// API endpoint (replace with the actual URL from the Bahrain Data Portal)
<<<<<<< HEAD
$api_url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?limit=100";

// Optional: Add your API key here if necessary
///$headers = [
   // "Authorization: Bearer your-api-key"  // Replace with your actual API key if required
///];
=======
$api_url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Optional: Add your API key here if necessary
$headers = [
    "Authorization: Bearer your-api-key"  // Replace with your actual API key if required
];
>>>>>>> 0126c35bef60f4451bf01a2b4e39279eabf97558

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
<<<<<<< HEAD
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPGET,true);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
//curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($ch, CURLOPT_TIMEOUT, 30);
//curl_setopt($ch, CURLOPT_HEADER, 1);
=======
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
>>>>>>> 0126c35bef60f4451bf01a2b4e39279eabf97558

$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo "Error: " . curl_error($ch);
    exit();
}
curl_close($ch);

// Decode JSON response
$data = json_decode($response, true);
if ($data === null) {
    echo "Error decoding JSON data.";
<<<<<<< HEAD
    //echo "<pre>";
    exit();
}
var_dump($data);
//exit();

// Display data in a table
//echo "<h2>UOB Student Nationality Data</h2>";
//echo "<table border='1' cellpadding='5'>";
//echo "<tr><th>Year</th><th>Semester</th><th>Program</th><th>Nationality</th><th>College</th><th>Number of Students</th></tr>";

//foreach ($data as $item) {
    //echo "<tr>";
    //echo "<td>" . htmlspecialchars($item['year']) . "</td>";
    //echo "<td>" . htmlspecialchars($item['semester']) . "</td>";
    //echo "<td>" . htmlspecialchars($item['program']) . "</td>";
    //echo "<td>" . htmlspecialchars($item['nationality']) . "</td>";
    //echo "<td>" . htmlspecialchars($item['college']) . "</td>";
    //echo "<td>" . htmlspecialchars($item['number_of_students']) . "</td>";
    //echo "</tr>";
//}
=======
    exit();
}

// Display data in a table
echo "<h2>UOB Student Nationality Data</h2>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Year</th><th>Semester</th><th>Program</th><th>Nationality</th><th>College</th><th>Number of Students</th></tr>";

foreach ($data as $item) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($item['year']) . "</td>";
    echo "<td>" . htmlspecialchars($item['semester']) . "</td>";
    echo "<td>" . htmlspecialchars($item['program']) . "</td>";
    echo "<td>" . htmlspecialchars($item['nationality']) . "</td>";
    echo "<td>" . htmlspecialchars($item['college']) . "</td>";
    echo "<td>" . htmlspecialchars($item['number_of_students']) . "</td>";
    echo "</tr>";
}
>>>>>>> 0126c35bef60f4451bf01a2b4e39279eabf97558

echo "</table>";

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UOB Student Nationality Data</title>
    <!-- Link to Pico CSS -->
    <link rel="stylesheet" href="https://unpkg.com/picocss@1.5.1/dist/pico.min.css">
    <style>
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>UOB Student Nationality Data</h1>

    <!-- Table to display the fetched data -->
<<<<<<< HEAD
    <table class="striped">
=======
    <table>
>>>>>>> 0126c35bef60f4451bf01a2b4e39279eabf97558
        <thead>
            <tr>
                <th>Year</th>
                <th>Semester</th>
                <th>Program</th>
                <th>Nationality</th>
                <th>College</th>
                <th>Number of Students</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['year']); ?></td>
                <td><?php echo htmlspecialchars($item['semester']); ?></td>
                <td><?php echo htmlspecialchars($item['program']); ?></td>
                <td><?php echo htmlspecialchars($item['nationality']); ?></td>
                <td><?php echo htmlspecialchars($item['college']); ?></td>
                <td><?php echo htmlspecialchars($item['number_of_students']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>