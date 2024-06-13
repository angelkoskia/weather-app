This is a simple PHP Weather Application made with Laravel and Laravel Blade. The functionality for this app is to consume data from a weather API and store the information (temp, humidity, weather description). The data is consumed per city every hour. Later on, that information is presented to the users.
The api I used for this application is https://rapidapi.com/worldapi/api/open-weather13.
There are two approaches, the first one is by filling a database with the api info, the second one is using the api directly to show the info.
You can show the info on the web app view or the terminal.
For the first approach if you want to show the data you can use these commands: 
    - php artisan weather:dataBaseCLIDefined or 
    - php artisan weather:dataBaseCLI {city}, the first command uses an array of cities so you can add more at once, and the second one can be used to add cities one by one.
For the second approach you can use these commands: 
    - php artisan weather:noDataBaseCLIDefined or 
    - php artisan weather:noDataBaseCLI {city}, the first command can retrieve info from the api for more predefined cities in an array and prints them in the terminal for you, and the second one can be used to show info for one but only in the terminal. 

If you want to see the blade files with the info, for the database approach you use http://localhost:8000/dataBase and for the no database approach http://localhost:8000/noDataBase/CITY_NAME/COUNTRY_CODE, for city name you can use any city like Prague, and for the code you use CZ, example would be http://localhost:8000/noDataBase/Prague/Cz

So Step 1 for running the application is downloading it, configuring your composer dependencies and migrating the database. Then you wanna serve the application and experiment with the commands I gave you.
Make sure to add your own API Key because mine has expired and cannot be used for any purposes.
