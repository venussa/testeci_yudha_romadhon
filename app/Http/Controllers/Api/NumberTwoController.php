<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;

class NumberTwoController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public function index(Request $request)
    {
        try {
            $validated = $request->validate(['number' => 'required|numeric|min:0|max:999999999999999']);
            $formattedNumber = "Rp " . number_format($request->number, 0, ',', '.');
            $convertedNumber = $this->generateFormattedNumber($request->number);
            $cleanConvertedNumber = ucwords(preg_replace('/\s+/', ' ', trim($convertedNumber)) . " Rupiah");

            return response()->json([
                'code' => 200,
                'message' => 'Formatted Number Generation Success',
                'data' => [ 'formatted_number' => $formattedNumber, 'converted_number' => $cleanConvertedNumber]
            ]);

        } catch (ValidationException $e) {
            return response()->json([
                'code' => 400,
                'message' => 'Bad Request',
                'errors' => $e->errors()
            ], 400);
        }
    }

    /**
     * Convert Formatted Number As Words
     * 
     * @param int $number
     * @return string
     */
    private function generateFormattedNumber(int $number)
    {
        /* initial number formatted */
        $wordFormated = [
            '', 'satu', 'dua', 'tiga', 'empat', 'lima',
            'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh',
            'sebelas'
        ];

        /* initial number units */
        $numberUnits = [
            20 => ['label' => 'belas', 'normalize_value' => 10],
            100 => ['label' => 'puluh', 'modulus' => 10],
            200 => ['label' => 'seratus', 'normalize_value' => 100],
            1000 => ['label' => 'ratus', 'modulus' => 100],
            2000 => ['label' => 'seribu', 'normalize_value' => 1000],
            1000000 => ['label' => 'ribu', 'modulus' => 1000],
            1000000000 => ['label' => 'juta', 'modulus' => 1000000],
            1000000000000 => ['label' => 'miliar', 'modulus' => 1000000000],
            1000000000000000 => ['label' => 'ptriliun', 'modulus' => 1000000000000]
        ];

        if ($number < 12) {
            return $wordFormated[$number];
        } else {
            foreach ($numberUnits as $key => $value) {
                $result = [];
                if ($number < $key) {
                    if (isset($value['modulus'])) {
                        $result[] = $this->generateFormattedNumber($number / $value['modulus']);
                        $result[] = $value['label'];
                        $result[] = $this->generateFormattedNumber($number % $value['modulus']);
                    } else if ($key === 20) {
                        $result[] = $this->generateFormattedNumber($number - $value['normalize_value']);
                        $result[] = ' ' . $value['label'];
                    } else if (!isset($value['modulus'])) {
                        $result[] = ' ' . $value['label'];
                        $result[] = $this->generateFormattedNumber($number - $value['normalize_value']);
                    }
                    return implode(' ', $result);
                }
            }
        }

        return null;
    }
}