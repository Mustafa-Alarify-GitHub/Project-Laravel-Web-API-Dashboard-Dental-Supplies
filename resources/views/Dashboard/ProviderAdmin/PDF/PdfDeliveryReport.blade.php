<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            text-align: left;
            direction: ltr; /* For English layout */
        }

        .header {
            text-align: center;
            background-color: #f4f4f4;
            padding: 10px;
            margin-bottom: 20px;
            border-bottom: 2px solid #ddd;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        .legend {
            margin: 10px 0;
            display: flex;
            justify-content: flex-start;
            gap: 20px;
            color: #333;
        }

        .legend-item {
            display: flex;
            align-items: center;
            font-size: 14px;
        }

        .status-box {
            width: 20px;
            height: 20px;
            margin-right: 5px;
            border: 1px solid #ddd;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }

        table td {
            padding: 10px;
            text-align: center;
            font-size: 12px;
            border: 1px solid #ddd;
        }

        .success {
            background-color: #96dc96;
        }

        .underway {
            background-color: #ffff96;
        }

        .failure {
            background-color: #ff7777;
        }

        .totals-row {
            font-weight: bold;
        }

        .totals-row th {
            background-color: #f4f4f4;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Orders Report</h1>
        <p>Summary of all orders</p>
    </div>

    <div class="legend">
        <div class="legend-item">
            <div class="status-box success"></div>
            <span>Success</span>
        </div>
        <div class="legend-item">
            <div class="status-box underway"></div>
            <span>Underway</span>
        </div>
        <div class="legend-item">
            <div class="status-box failure"></div>
            <span>Failure</span>
        </div>
    </div>

    <div class="card-body">
        <table>
            <thead>
                <tr>
                    <th>Deliver</th>
                    <th>Clinic Name</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $i)
                    <tr class="{{ $i->status == 'Success' ? 'success' : ($i->status == 'Underway' ? 'underway' : 'failure') }}">
                        <td>{{ $i->deliver_name }}</td>
                        <td>{{ $i->name }}</td>
                        <td>{{ $i->Location }}</td>
                        <td>{{ $i->status }}</td>
                        <td>{{ \Carbon\Carbon::parse($i->created_at)->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
                <tr class="totals-row">
                    <th colspan="2" class="success">Total Success: {{ $Success }}</th>
                    <th></th>
                    <th colspan="2" class="failure">Total Failures: {{ $fail }}</th>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
