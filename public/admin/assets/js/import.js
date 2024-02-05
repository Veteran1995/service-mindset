
// const inputFile = document.getElementById('excelFileInput');
// const uploadButton = document.getElementById('importCustomers');



// uploadButton.addEventListener('click', async () => {

//     const file = inputFile.files[0];
//     const excelData = await readExcelFile(file);
//     const jsonData = convertExcelToJson(excelData);


//     axios.post('/api/import-customers', {
//         data: jsonData
//     })
//     .then(response => {
//         alert(response.data.message);
//     })
//     .catch(error => {
//         console.error('Error importing data:', error);
//     });

//     fetch('/import-customers', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': window.csrf_token,
//         },
//         body: JSON.stringify({
//             data: jsonData
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
// async function readExcelFile(file) {
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
// function convertExcelToJson(excelData) {
//   // Parse Excel data using SheetJS
//   const workbook = XLSX.read(excelData, {
//       type: 'binary'
//   });
//   const sheetName = workbook.SheetNames[0];
//   const sheet = workbook.Sheets[sheetName];

//   // Find the range of the sheet
//   const range = XLSX.utils.decode_range(sheet['!ref']);

//   // Set the range to start from the second row
//   range.s.r = 1;

//   // Convert sheet data to JSON with headers, starting from the second row
//   const jsonData = XLSX.utils.sheet_to_json(sheet, {
//       header: 'A', // Use the first row as headers
//       range: range, // Set the range
//   });

//   return jsonData;
// }


// // Function to convert Excel data to JSON
// // function convertExcelToJson(excelData) {
// //   // Parse Excel data using SheetJS
// //   const workbook = XLSX.read(excelData, {
// //       type: 'binary'
// //   });
// //   const sheetName = workbook.SheetNames[0];
// //   const sheet = workbook.Sheets[sheetName];

// //   // Convert sheet data to JSON with headers
// //   const jsonData = XLSX.utils.sheet_to_json(sheet, {
// //       header: 'A', // Use the first row as headers
// //   });

// //   return jsonData;
// // }

const inputFile = document.getElementById('excelFileInput');
const uploadButton = document.getElementById('importCustomers');
const loader = document.getElementById('loader');



uploadButton.addEventListener('click', async () => {
    loader.classList.remove('d-none');
    loader.setAttribute('disabled', 'true');
    uploadButton.classList.add('d-none');

    const progressBar = document.getElementById('progress-bar');
    const file = inputFile.files[0];

    try {
        const excelData = await readExcelFile(file);

        if (excelData) {
            const jsonData = convertExcelToJson(excelData);

            const config = {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrf_token,
                },
                onUploadProgress: (progressEvent) => {
                    const percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                    // Update the Bootstrap progress bar style
                    progressBar.style.width = `${percentCompleted}%`;
                    progressBar.setAttribute('aria-valuenow', percentCompleted);
                    progressBar.innerHTML = `${percentCompleted}%`;
                },
            };

            await axios.post('/api/import-customers', { data: jsonData }, config);

            // Assuming the server provides accurate progress information,
            // you can now handle the completion of the upload
            uploadButton.classList.remove('d-none');
            loader.classList.add('d-none');
            swal('Information', 'Data Imported Successfully', 'info');
        }
    } catch (error) {
        uploadButton.classList.remove('d-none');
        loader.classList.add('d-none');
        console.error('Error processing Excel file:', error.message);
        swal('Danger', error.message, 'danger');
    }
});



// Function to read Excel file content
async function readExcelFile(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();

        reader.onload = (event) => {
            const data = event.target.result;
            resolve(data);
        };

        reader.onerror = (error) => {
            reject(error);
        };

        reader.readAsBinaryString(file);
    });
}

// Function to convert Excel data to JSON
function convertExcelToJson(excelData) {
    try {
        // Parse Excel data using SheetJS
        const workbook = XLSX.read(excelData, { type: 'binary' });
        
        // Check if there are sheet names
        if (workbook.SheetNames.length === 0) {
            throw new Error('No sheets found in the Excel file.');
        }

        const sheetName = workbook.SheetNames[0];
        const sheet = workbook.Sheets[sheetName];

        // Check if the sheet exists
        if (!sheet) {
            throw new Error(`Sheet '${sheetName}' not found.`);
        }

        // Find the range of the sheet
        const range = XLSX.utils.decode_range(sheet['!ref']);

        // Set the range to start from the second row
        range.s.r = 1;

        // Convert sheet data to JSON with headers, starting from the second row
        const jsonData = XLSX.utils.sheet_to_json(sheet, {
            header: 'A', // Use the first row as headers
            range: range, // Set the range
        });

        return jsonData;
    } catch (error) {
        console.error('Error converting Excel to JSON:', error.message);
        return null;
    }
}







