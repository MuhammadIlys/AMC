<?php

namespace Database\Seeders;

use App\Models\super_admin\qbank\qbank_question\QbankQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QbankQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
                // Define the number of questions to insert
        $numberOfQuestions = 200;

        // Define the qbank_id and qbank_system_ids
        $qbankId = 3;
        $systemIds = [2, 3, 4];

        // Loop to create and insert questions
        for ($i = 0; $i < $numberOfQuestions; $i++) {
            QbankQuestion::create([
                'qbank_id' => $qbankId,
                'qbank_system_id' => $systemIds[array_rand($systemIds)],
                'question_track_id'=>($i + 1),
                'question_text' => 'Dummy Question Text ' . ($i + 1),
                'option1' => 'Option 1',
                'option2' => 'Option 2',
                'option3' => 'Option 3',
                'option4' => 'Option 4',
                'option5' => 'Option 5',
                'correct_option' => rand(1, 5),
                'question_explanation' => 'Dummy Explanation for Question ' . ($i + 1),
            ]);
        }
    }
}
