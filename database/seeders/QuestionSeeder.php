<?php

namespace Database\Seeders;

use App\Models\super_admin\mocks\question\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 147; $i++) {
            Question::create([
                'question_track_id' => $i,
                'subject_id' => 1,
                'speciality_id' => 1,
                'topic_id' => 13,
                'test_id' => 4,
                'question_text' => "Question text $i",
                'option1' => "Option 1 for question $i",
                'option2' => "Option 2 for question $i",
                'option3' => "Option 3 for question $i",
                'option4' => "Option 4 for question $i",
                'option5' => "Option 5 for question $i",
                'correct_option' => 1,
                'question_type' => rand(1, 3),
                'question_explanation' => "Explanation for question $i",
            ]);
        }
    }
}
