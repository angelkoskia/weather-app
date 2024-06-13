<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
</head>
<body>
<div style="width: 400px; margin: auto;">
    <h1>Weather Information</h1>
    @if(isset($error))
        <p>{{ $error }}</p>
    @else
        <div style="border: 1px solid #ccc; padding: 20px; border-radius: 5px;">
            <h3>{{ $weatherData['name'] }}</h3>
            <hr>
            <p><strong>Temperature:</strong> {{ $weatherData['main']['temp'] }}°C</p>
            <p><strong>Humidity:</strong> {{ $weatherData['main']['humidity'] }}</p>
            <p><strong>Description:</strong> {{ $weatherData['weather'][0]['description'] }}</p>
        </div>
    @endif
</div>
</body>
</html>
