<?php

$api_url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?limit=100";


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HTTPGET,true);
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);


$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo "Error: " . curl_error($ch);
    exit();
}
curl_close($ch);

$data = json_decode($response, true);
if ($data === null) {
    echo "Error decoding JSON data.";
    exit();
}

if (isset($data['results'])) {
    $studentsData = $data['results']; // Store the records in a variable
} else {
    echo "No records found in the response.";
    exit();
}

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
        border-collapse: collapse;
        table-layout: outo; 
        word-wrap: break-word; 
        font-family: 'Calibri', sans-serif;

    }
    th, td {
        padding: 12px;
        text-align: left;
    }
    th {
        background-color: #ffffff;
        }
    td {
        text-overflow: ellipsis;
        overflow: hidden;  
        word-wrap: break-word; 
        overflow: hidden;
    }

    /* Make the table horizontally scrollable */
    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch; /* Smooth scrolling for touch devices */
    }

    tr:nth-child(odd) {
        background-color: #f9f9f9; 
    }
    tr:nth-child(even) {
        background-color: #ffffff; 
    }

    /* Media query for smaller screens */
    @media (max-width: 768px) {
        table {
            font-size: 14px; /* Reduce font size for small screens */
        }
        th, td {
            padding: 8px; /* Reduce padding for small screens */
        }
    }
</style>

</head>
<body>
<div class="table-wrapper">
<div class="container">
    <h1>UOB Student Nationality Data</h1>

    <!-- Table to display the fetched data -->
    <table class="striped">
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
        <?php
                // Loop through each record in the 'results' array
                foreach ($studentsData as $item) :
                    // Access the fields from the current record (adjust field names based on the raw response)
                    $year = isset($item['year']) ? htmlspecialchars($item['year']) : 'N/A';
                    $semester = isset($item['semester']) ? htmlspecialchars($item['semester']) : 'N/A';
                    $program = isset($item['the_programs']) ? htmlspecialchars($item['the_programs']) : 'N/A';  // Adjusted field based on raw response
                    $nationality = isset($item['nationality']) ? htmlspecialchars($item['nationality']) : 'N/A'; // Add other fields as necessary
                    $college = isset($item['colleges']) ? htmlspecialchars($item['colleges']) : 'N/A'; // Add other fields as necessary
                    $numberOfStudents = isset($item['number_of_students']) ? htmlspecialchars($item['number_of_students']) : 'N/A';

                    // Display the data in the table rows
                    echo "<tr>";
                    echo "<td>{$year}</td>";
                    echo "<td>{$semester}</td>";
                    echo "<td>{$program}</td>";
                    echo "<td>{$nationality}</td>";
                    echo "<td>{$college}</td>";
                    echo "<td>{$numberOfStudents}</td>";
                    echo "</tr>";
                endforeach;
                ?>
        </tbody>
    </table>
</div>
</div>

</body>
</html> 
            