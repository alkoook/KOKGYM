<?php

namespace App\Services;

use App\Models\Program;
use PhpOffice\PhpWord\TemplateProcessor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class ProgramExporter
{
    protected string $templatePath;

    public function __construct()
    {
        $this->templatePath = storage_path('app/public/templates/Template.docx');
    }

    /**
     * توليد ملف Word من برنامج وتمارينه وإرسال رسالة Telegram
     */
    public function exportProgram(Program $program): string
    {
        $template = new TemplateProcessor($this->templatePath);

        $trainer = $program->creator?->name ?? '-';
        $player  = $program->assignedUser?->name ?? '-';

        $template->setValue('trainer', $trainer);
        $template->setValue('player', $player);
        $template->setValue('date', Carbon::today()->format('Y-m-d'));

        $exercises = $program->programExercises()->with('exercise')
            ->orderBy('day')
            ->orderBy('type')
            ->get();

        $daysNames = [
            1 => 'الأحد',
            2 => 'الاثنين',
            3 => 'الثلاثاء',
            4 => 'الأربعاء',
            5 => 'الخميس',
            6 => 'الجمعة',
            7 => 'السبت',
        ];

        $typeNames = [
            'workout' => 'تمرين',
            'cardio'  => 'كارديو',
            'rest'    => 'راحة',
        ];

        $message = "📋 *برنامج تدريبي جديد*\n";
        $message .= "*المدرب : * $trainer\n";
        $message .= "*اللاعب : * $player\n";
        $message .= "*التاريخ : * " . Carbon::today()->format('Y-m-d') . "\n\n";
        $message .= "🗓️ *الجدول الأسبوعي :*\n\n";

        if ($exercises->count() > 0) {
            $template->cloneRow('day', $exercises->count());

            $lastDay = null;
            $lastType = null;

            $dayCounter = [];
            foreach ($exercises as $index => $ex) {
                $i = $index + 1;

                // اليوم يظهر مرة واحدة فقط لكل مجموعة متتالية
                $dayName = ($lastDay !== $ex->day) ? ($daysNames[$ex->day] ?? '-') : '';
                $lastDay = $ex->day;

                // النوع يظهر مرة واحدة فقط لكل مجموعة متتالية
                $typeName = ($lastType !== $ex->type) ? ($typeNames[$ex->type] ?? '-') : '';
                $lastType = $ex->type;

                $template->setValue("day#{$i}", $dayName);
                $template->setValue("type#{$i}", $typeName);
                $template->setValue("exercise#{$i}", $ex->exercise?->name ?? 'راحة');
                $template->setValue("sets#{$i}", $ex->sets ?? '-');
                $template->setValue("reps#{$i}", $ex->reps ?? '-');

                // بناء نص الرسالة
                if (!isset($dayCounter[$ex->day])) {
                    $dayCounter[$ex->day] = 1;
                    $message .= "📅 *اليوم : * $dayName    النوع : $typeName\n\n";
                } else {
                    $dayCounter[$ex->day]++;
                }

                $message .= " التمرين  {$dayCounter[$ex->day]} : " 
                            . ($ex->exercise?->name ?? 'راحة') 
                            . " | " 
                            . ($ex->sets ?? '-') . " × " . ($ex->reps ?? '-') . "\n\n";

                // إذا آخر تمرين لهذا اليوم، أضف خط فاصل
                $nextEx = $exercises->get($index + 1);
                if (!$nextEx || $nextEx->day !== $ex->day) {
                    $message .= "------------------------------------------------------------------------------------------------------\n";
                }
            }
            $message .= 'تم إعداد هذا التطبيق بواسطة المهندس أحمد عمر كوكة 
 للتواصل : 0956571037 ';
        }

        // حفظ ملف الـ Word
        $filename = 'program_' . $player.'_' . now('Asia/Damascus')->format('Y-m-d_H-i-s') . '.docx';
        $filePath = storage_path('app/public/exports/' . $filename);

        if (!file_exists(dirname($filePath))) {
            mkdir(dirname($filePath), 0755, true);
        }

        $template->saveAs($filePath);

        // إرسال رسالة Telegram
        $this->sendTelegramMessage($message);

        return $filePath;
    }

    protected function sendTelegramMessage(string $message)
    {
        $token = '8298692270:AAH7jP2SeLp4p4a6HfBDbnWvb4ovmVJOe98'; // حط توكن البوت
        $chatId = '@PrisonersBot_bot';

        Http::withOptions(['verify' => false])
            ->post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown'
            ]);
    }
}
