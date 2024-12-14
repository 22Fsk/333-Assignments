const apiUrl = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?limit=100";

async function fetchData() {
    try {
        console.log("Fetching data from:", apiUrl);
        const response = await fetch(apiUrl);

        if (!response.ok) {
            throw new Error(`HTTP Error: ${response.status} - ${response.statusText}`);
        }

        const data = await response.json();
        console.log("API Response:", data);

        if (data.results && Array.isArray(data.results)) {
            renderTable(data.results);
        } else {
            console.error("Unexpected API structure. Data:", data);
        }
    } catch (error) {
        console.error("Error fetching data:", error.message);
        alert("Error fetching data. Check the console for details.");
    }
}

function renderTable(data) {
    const tableBody = document.querySelector("#data-table tbody");
    tableBody.innerHTML = ""; // Clear existing rows

    console.log("Rendering data:", data);

    data.forEach(item => {
        const year = item.year || 'N/A';
        const semester = item.semester || 'N/A';
        const program = item.the_programs || 'N/A';
        const nationality = item.nationality || 'N/A';
        const college = item.colleges || 'N/A';
        const numberOfStudents = item.number_of_students || 'N/A';

        console.log("Row data:", { year, semester, program, nationality, college, numberOfStudents });

        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${sanitizeHTML(year)}</td>
            <td>${sanitizeHTML(semester)}</td>
            <td>${sanitizeHTML(program)}</td>
            <td>${sanitizeHTML(nationality)}</td>
            <td>${sanitizeHTML(college)}</td>
            <td>${sanitizeHTML(numberOfStudents)}</td>
        `;
        tableBody.appendChild(row);
    });
}

function sanitizeHTML(content) {
    const temp = document.createElement("div");
    temp.textContent = content;
    return temp.innerHTML;
}

document.addEventListener("DOMContentLoaded", () => {
    fetchData();
});
