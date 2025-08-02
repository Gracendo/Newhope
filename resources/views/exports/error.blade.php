<!DOCTYPE html>
<html>
<head>
    <title>Export Error</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
        .error-box { 
            border: 1px solid #f5c6cb; 
            background-color: #f8d7da; 
            color: #721c24; 
            padding: 20px; 
            border-radius: 5px;
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="error-box">
        <h2>Export Error</h2>
        <p>{{ $message ?? 'An error occurred while generating the export.' }}</p>
        <p>Please try again or contact support.</p>
    </div>
</body>
</html>