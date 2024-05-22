<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF To JSON Extraction Results</title>
</head>
<body>

<?php 
$apiKey = "dani081001@gmail.com_ih42T74wb5P9OEiXRsiP5YzqR5I7G4v1wdo8JVu5u5Yh5uDEIL1V8h9UEfjJXsAk"; //Memakai API key punya saya. Get your own by registering at https://app.pdf.co
$pages = "0";

// Create URL
$url = "https://api.pdf.co/v1/file/upload/get-presigned-url" . 
    "?name=" . urlencode($_FILES["file"]["name"]) .
    "&contenttype=application/octet-stream";
    
// Create request
$curl = curl_init();
curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey));
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

// Execute request
$result = curl_exec($curl);

if (curl_errno($curl) == 0) {
    $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    
    if ($status_code == 200) {
        $json = json_decode($result, true);
        
        // Get URL to use for the file upload
        $uploadFileUrl = $json["presignedUrl"];
        // Get URL of uploaded file to use with later API calls
        $uploadedFileUrl = $json["url"];
        
        // 2. UPLOAD THE FILE TO CLOUD.
        
        $localFile = $_FILES["file"]["tmp_name"];
        $fileHandle = fopen($localFile, "r");
        
        curl_setopt($curl, CURLOPT_URL, $uploadFileUrl);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("content-type: application/octet-stream"));
        curl_setopt($curl, CURLOPT_PUT, true);
        curl_setopt($curl, CURLOPT_INFILE, $fileHandle);
        curl_setopt($curl, CURLOPT_INFILESIZE, filesize($localFile));

        // Execute request
        curl_exec($curl);
        
        fclose($fileHandle);
        
        if (curl_errno($curl) == 0) {
            $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            if ($status_code == 200) {
                // 3. CONVERT UPLOADED PDF FILE TO JSON
                ExtractJSON($apiKey, $uploadedFileUrl, $pages);
            } else {
                // Display request error
                echo "<p>Status code: " . $status_code . "</p>"; 
                echo "<p>" . $result . "</p>"; 
            }
        } else {
            // Display CURL error
            echo "Error: " . curl_error($curl);
        }
    } else {
        // Display service reported error
        echo "<p>Status code: " . $status_code . "</p>"; 
        echo "<p>" . $result . "</p>"; 
    }
    
    curl_close($curl);
} else {
    // Display CURL error
    echo "Error: " . curl_error($curl);
}

function ExtractJSON($apiKey, $uploadedFileUrl, $pages) {
    // Create URL
    $url = "https://api.pdf.co/v1/pdf/convert/to/json2";
    
    // Prepare request params
    $parameters = array();
    $parameters["url"] = $uploadedFileUrl;
    $parameters["pages"] = $pages;

    // Create JSON payload
    $data = json_encode($parameters);

    // Create request
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $apiKey, "Content-type: application/json"));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

    // Execute request
    $result = curl_exec($curl);
    
    if (curl_errno($curl) == 0) {
        $status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        
        if ($status_code == 200) {
            $json = json_decode($result, true);
            
            if (!isset($json["error"]) || $json["error"] == false) {
                $resultFileUrl = $json["url"];
                
                // Display link to the file with conversion results
                echo "<div><h2>Conversion Result:</h2><a href='" . $resultFileUrl . "' target='_blank'>" . $resultFileUrl . "</a></div>";
            } else {
                // Display service reported error
                echo "<p>Error: " . $json["message"] . "</p>"; 
            }
        } else {
            // Display request error
            echo "<p>Status code: " . $status_code . "</p>"; 
            echo "<p>" . $result . "</p>"; 
        }
    } else {
        // Display CURL error
        echo "Error: " . curl_error($curl);
    }
    
    // Cleanup
    curl_close($curl);
}

?>

</body>
</html>
