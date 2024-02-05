// const inputConsumptionFile = document.getElementById('excelConsumptionInput');
// const uploadConsumption = document.getElementById('importConsumption');

// uploadConsumption.addEventListener('click', async () => {
//     const file = inputConsumptionFile.files[0];
//     const excelData = await readConsumptionExcelFile(file);
//     const jsonData = convertConsumptionExcelToJson(excelData);

//    const records = jsonData.map(row => {
//     const monthlyRecords = [];
//     const additionalInfo = {
//         "GEO Community": row[1], // Assuming GEO Community is in the second column
//         "GEO Zone": row[2],
//         "Tariff Category": row[3],
//         "Tariff Class": row[4],
//         "Tariff Description": row[5],
//         "Phase": row[6],
//         "Itinerary": row[7],
//         "Service Coordinates X": row[8],
//         "Service Coordinates Y": row[9],
//         "Connection Type": row[10],
//         "Service Type": row[11],
//         "Tax Indicator": row[12],
//         "Estimated Monthly Consumption(Kwh)": row[13],
//         "Group Account": row[14],
//         "Customer Name": row[15],
//         "Customer Type": row[16],
//         "Document Number": row[17],
//         "Account Number": row[18],
//         "Contract Number": row[19],
//         "Contract Status": row[20],
//         "Account Balance": row[21],
//         "Meter Make": row[22],
//         "Meter Number": row[23]
//     };

//     // Assuming the column names start from index 24
//     for (let i = 24; i < row.length; i += 2) {
//         const columnName = row[i];
//         const amountBilled = row[i + 1];

//         // Add a check to ensure columnName is a string
//         if (typeof columnName === 'string') {
//             // Extract month and year from the column name
//             const [, month, year] = columnName.match(/(\w+)-(\d+)/) || [];

//             if (month && year) {
//                 const record = {
//                     ...additionalInfo,
//                     month,
//                     year,
//                     "Amount Billed": amountBilled,
//                     "Consumption (Kwh) billed": row[i + 1], // Assuming the consumption column immediately follows the amount billed column
//                 };

//                 monthlyRecords.push(record);
//             }
//         }
//     }

//     return monthlyRecords;
// });


//     // Send the records to the server using axios or fetch
//     axios.post('/api/import-consumptions', {
//         data: records,
//     })
//     .then(response => {
//         console.log(response.data.message);
//     })
//     .catch(error => {
//         console.error('Error importing data:', error);
//     });

//     fetch('/import-consumptions', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': window.csrf_token,
//         },
//         body: JSON.stringify({
//             data: records,
//         }),
//     })
//     .then(response => {
//         if (!response.ok) {
//             throw new Error(`HTTP error! Status: ${response.status}`);
//         }
//         return response.json();
//     })
//     .then(data => {
//         console.log(data);
//     })
//     .catch(error => {
//         console.error('Error:', error);
//     });
// });

// // Function to read Excel file content
// async function readConsumptionExcelFile(file) {
//     return new Promise((resolve, reject) => {
//         const reader = new FileReader();

//         reader.onload = (event) => {
//             const data = event.target.result;
//             resolve(data);
//         };

//         reader.onerror = (error) => {
//             reject(error);
//         };

//         reader.readAsBinaryString(file);
//     });
// }

// // Function to convert Excel data to JSON
// function convertConsumptionExcelToJson(excelData) {
//     // Parse Excel data using SheetJS
//     const workbook = XLSX.read(excelData, {
//         type: 'binary',
//     });
//     const sheetName = workbook.SheetNames[0];
//     const sheet = workbook.Sheets[sheetName];

//     // Convert sheet data to JSON with headers (using the first row as headers)
//     const jsonData = XLSX.utils.sheet_to_json(sheet, { header: 1 });

//     return jsonData;
// }
