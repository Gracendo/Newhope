
<!DOCTYPE html>
<html>
<head>
    <title>Volunteers Report - {{ $campaign->name }}</title>
    <style>
        /* Basic styling for the PDF */
        body { font-family: Arial; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th { background-color: #f2f2f2; }
        th, td { border: 1px solid #ddd; padding: 8px; }
    </style>
</head>
<body>
    <div style="display:flex;justify-content:center;height:80px;">
    <img src="assets/frontend/images/loader.svg" alt="Logo" ><span  style="margin:0px 1px;color :#FF6600; font-size:40px"> Newhope </span>
      </div>  
    <!-- <h1>Volunteers for: {{ $campaign->name }}</h1> -->
    <h1>Volunteers Report</h1>
        <p>Campaign: {{ $campaign->name }}</p>
        <p>Generated on: {{ now()->format('M d, Y H:i') }}</p>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Applied On</th>
            </tr>
        </thead>
        <tbody>
            @foreach($volunteers as $index => $volunteer)
            <tr>
                <td>{{ $index + 1 }}</td>
                <!-- Combine first + last name -->
                <td>{{ $volunteer->user->first_name }} {{ $volunteer->user->last_name }}</td>
                <td>{{ $volunteer->user->email ?? 'N/A' }}</td>
                <!-- Check both phone fields -->
                <td>{{ $volunteer->phone ?? $volunteer->user->phone ?? 'N/A' }}</td>
                <td>{{ ucfirst($volunteer->status) }}</td>
                <!-- Safe date formatting -->
                <td>{{ $volunteer->created_at->format('M d, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>