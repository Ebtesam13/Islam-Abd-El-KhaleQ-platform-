<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsScoresExport implements FromCollection, WithHeadings
{
    protected $stage;

    public function __construct($stage)
    {
        $this->stage = $stage;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $students = User::role('student')->where('current_stage', $this->stage)
            ->with(['stage', 'quizAttempts.quiz.lesson.unit.course'])
            ->get();

        return $students->map(function ($student) {
            // Check if the student has quiz attempts
            if ($student->quizAttempts->isNotEmpty()) {
                return $student->quizAttempts->map(function ($attempt) use ($student) {
                    return [
                        'Student Name' => $student->name,
                        'Student Email' => $student->email,
                        'Student Mobile' => $student->mobile,
                        'Student Stage' => optional($student->stage)->name,
                        'Quiz Name' => $attempt->quiz ? $attempt->quiz->name : "",
                        'Score' =>$attempt->quiz ? $attempt->score . "/".count($attempt->quiz->questions) : "",
                        'Attempt Date' => $attempt->created_at->format('d M Y H:i:s'),
                        "Mother's whatsapp" => $student->mom_whats_app,
                        "Father's whatsapp" => $student->dad_whats_app,
                    ];
                });
            } else {
                // Handle case where no quiz attempts exist
                return [[
                    'Student Name' => $student->name,
                    'Student Email' => $student->email,
                    'Student Mobile' => $student->mobile,
                    'Student Stage' => optional($student->stage)->name,
                    'Quiz Name' => 'No attempts',
                    'Score' => 'N/A',
                    'Attempt Date' => 'N/A',
                    "Mother's whatsapp" => $student->mom_whats_app,
                    "Father's whatsapp" => $student->dad_whats_app,
                ]];
            }
        })->collapse(); // collapse flattens the nested arrays
    }

    /**
     * Define the headings for the Excel file
     */
    public function headings(): array
    {
        return [
            'Student Name',
            'Student Email',
            'Student Mobile',
            'Student Stage',
            'Quiz Name' ,
            'Score' ,
            'Attempt Date',
            "Mother's whatsapp",
            "Father's whatsapp"
        ];
    }
}
