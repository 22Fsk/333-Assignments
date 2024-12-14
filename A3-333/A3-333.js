// API URL
const apiUrl = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch data from API and populate the table
async function fetchData() {
    try {
        const response = await fetch(apiUrl);
        const data = await response.json();

        // Check if the 'records' array exists in the response
        if (!data || !data.records || data.records.length === 0) {
            console.error("No records found in the data.");
            return;
        }

        const tableBody = document.getElementById("data-table-body");

        // Iterate through the records and add them to the table
        data.records.forEach(item => {
            // Debugging: Log the item to check the structure of the response
            console.log(item); // Remove or comment out this line after debugging

            // Make sure to access the correct fields from the response
            const year = item.year || 'N/A';
            const semester = item.semester || 'N/A';
            const program = item.the_programs || 'N/A';
            const nationality = item.nationality || 'N/A';
            const college = item.colleges || 'N/A';
            const numberOfStudents = item.number_of_students || 'N/A';

            // Create a new table row
            const row = document.createElement("tr");

            // Add data into the row
            row.innerHTML = `
                <td>${year}</td>
                <td>${semester}</td>
                <td>${program}</td>
                <td>${nationality}</td>
                <td>${college}</td>
                <td>${numberOfStudents}</td>
            `;

            // Append the row to the table body
            tableBody.appendChild(row);
        });
    } catch (error) {
        console.error("Error fetching data:", error);
    }
}

// Call the fetchData function to retrieve and display the data
fetchData();

