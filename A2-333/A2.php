<?php

// API endpoint (replace with the actual URL from the Bahrain Data Portal)
$api_url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?limit=100";


// Initialize cURL session
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

// Decode JSON response
$data = json_decode($response, true);
if ($data === null) {
    echo "Error decoding JSON data.";
    //echo "<pre>";
    exit();
}
// Check if the 'results' key exists in the response
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
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        td {
            text-overflow: ellipsis;
            overflow: auto;
            white-space: nowrap;
        }
            
    </style>
</head>
<body>

<div class="container">
    <h1>UOB Student Nationality Data</h1>

    <!-- Table to display the fetched data -->
    <table>
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

</body>
</html> 
            