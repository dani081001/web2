<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF to JSON Converter</title>
    <script src="build/pdf.mjs"></script>


    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #output {
            white-space: pre-wrap;
            background-color: #f3f3f3;
            padding: 10px;
            border: 1px solid #ccc;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>PDF to JSON Converter</h1>
    <input type="file" id="pdfFile" accept="application/pdf" />
    <button onclick="convertPDF()">Convert</button>
    <a id="downloadLink" style="display: none;">Download JSON</a>
    <script>
        function convertPDF() {
            const fileInput = document.getElementById('pdfFile');
            const downloadLink = document.getElementById('downloadLink');

            if (fileInput.files.length === 0) {
                alert('Please select a PDF file.');
                return;
            }

            const file = fileInput.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                const typedarray = new Uint8Array(this.result);

                pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
                    let textContent = '';
                    let promises = [];

                    for (let i = 1; i <= pdf.numPages; i++) {
                        promises.push(pdf.getPage(i).then(function(page) {
                            return page.getTextContent().then(function(text) {
                                text.items.forEach(function(item) {
                                    textContent += item.str + ' ';
                                });
                            });
                        }));
                    }

                    Promise.all(promises).then(function() {
                        const jsonOutput = JSON.stringify({ text: textContent });

                        const blob = new Blob([jsonOutput], { type: 'application/json' });
                        const url = URL.createObjectURL(blob);

                        downloadLink.href = url;
                        downloadLink.download = 'output.json';
                        downloadLink.style.display = 'block';
                        downloadLink.textContent = 'Download JSON';
                    });
                });
            };

            reader.readAsArrayBuffer(file);
        }
    </script>
</body>
</html>
