    <?php
    // ملف Migration لـ program_exercise
    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::create('program_exercise', function (Blueprint $table) {
                
                // مفتاح أساسي للتعامل مع هذا السجل كصف منفصل
                $table->id(); 
                
                // الربط بجدول البرامج
                $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
                
                // الربط بجدول التمارين (يمكن أن يكون NULL إذا كان اليوم راحة)
                $table->foreignId('exercise_id')->nullable()->constrained('exercises')->onDelete('cascade'); 
                
                // اليوم في البرنامج (من 1 إلى 7)
                $table->unsignedTinyInteger('day')->comment('اليوم في الأسبوع (1 = الأحد)'); 
                
                // نوع النشاط في هذا اليوم/التمرين
                $table->enum('type', ['workout', 'rest', 'cardio'])->default('workout')->comment('نوع النشاط'); 
                
                // تفاصيل التمرين (إذا كان Type هو 'workout' أو 'cardio')
                $table->integer('sets')->nullable()->comment('عدد الجولات');
                $table->integer('reps')->nullable()->comment('عدد التكرارات');

                // للتأكد من عدم تكرار نفس التمرين في نفس اليوم لنفس البرنامج
                // ملاحظة: قد تحتاج إلى إزالة 'exercise_id' من الـ unique constraint إذا كنت تريد تكرار نفس التمرين في نفس اليوم بترتيب مختلف.
                // لنفترض أننا نجعله فريداً لضمان عدم التكرار.
                $table->unique(['program_id', 'exercise_id', 'day']); 
                
                $table->timestamps();
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('program_exercise');
        }
    };