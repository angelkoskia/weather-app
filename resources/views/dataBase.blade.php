<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <style>
        .weather-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .weather-card {
            width: calc(30% - 20px); /* Adjust the width as needed */
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div style="width: 800px; margin: auto;">
    <h1>Weather Information</h1>
    @if(isset($error))
        <p>{{ $error }}</p>
    @else
        <div class="weather-container">
            @foreach($weatherData as $weather)
                <div class="weather-card">
                    <h3>{{ $weather->city }}</h3>
                    <hr>
                    <p><strong>Temperature:</strong> {{ $weather->temperature }}°C</p>
                    <p><strong>Humidity:</strong> {{ $weather->humidity }}</p>
                    <p><strong>Description:</strong> {{ $weather->weather_description }}</p>
                </div>
            @endforeach
        </div>
    @endif
</div>
</body>
</html>
