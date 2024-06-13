    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateWeatherTable extends Migration
    {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up(): void
        {
            Schema::create('weather', function (Blueprint $table) {
                $table->id();
                $table->string('city');
                $table->string('country_code');
                $table->float('temperature');
                $table->integer('humidity');
                $table->string('weather_description');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down(): void
        {
            Schema::dropIfExists('weather');
        }
    }
