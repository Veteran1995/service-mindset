<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center; font-family:'Courier New', Courier, monospace">Liberia Electricity Corporations</h1>
    <h2>Itineraries</h2>
    <h5>Date: {{ now() }}</h5>

    <table>
        <thead>
            <tr>
                <th>Itinerary</th>
                <th>Circle</th>
                <th>Number of Meters</th>
                <th>Reader</th>
                <th>Reading Circle</th>
                <th>Reading Date</th>
                <th>Status</th>
                <th>Priority</th>
                <th>Completion Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($itineraries as $itinerary)
                <tr>

                    <td>
                        {{ $itinerary->itinerary_no }}</a>
                    </td>
                    <td>{{ $itinerary->circle }}</td>
                    <td>{{ $itinerary->meters->count() }}</td>
                    <td>
                        @if ($itinerary->user)
                            {{ $itinerary->user->firstname . ' ' . $itinerary->user->lastname }}
                        @else
                            N/A
                        @endif

                    </td>
                    <td>{{ $itinerary->reading_circle }}</td>
                    <td>{{ $itinerary->created_at }}</td>
                    <td>

                        {{ $itinerary->status }}
                    </td>
                    <td>

                        {{ $itinerary->priority }}
                    </td>
                    <td>
                        {{ $itinerary->completion_date }}
                    </td>

                </tr>
            @endforeach

            <!-- Add more rows as needed -->
        </tbody>
    </table>

</body>

</html>
