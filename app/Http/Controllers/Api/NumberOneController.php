<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;

class NumberOneController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public function index(Request $request)
    {
        $allowedOption = [1, 2, 3];

        try {
            $validated = $request->validate([
                'type' => 'required|numeric|in:' . implode(',', $allowedOption),
                'repetition' => 'required|numeric|gt:0',
            ]);

            return response()->json([
                'code' => 200,
                'message' => 'Pyramid Generation Success',
                'data' => $this->generatePyramid($request->type, $request->repetition)
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
     * generate pyramid
     * 
     * @param int $type
     * @param int $repetition
     * @return string $result
     */
    private function generatePyramid(int $type, int $repetition)
    {
        $result = [];

        switch ($type) {
            /**
             * Left align or right align pypramid
             */
            case 1: case 3:
                for ($loop = 1; $loop <= $repetition; $loop++) {
                    $tmpResult = [];
                    for ($nestedLoop = 1; $nestedLoop <= $loop; $nestedLoop++) $tmpResult[] = "*";
                    $result[] = implode(" ", $tmpResult);
                }
                break;
            
            case 2:
                /**
                 * inverted left align pyramid
                 */
                for ($loop = $repetition; $loop  >= 1; $loop --) {
                    $tmpResult = [];
                    for ($nestedLoop = 1; $nestedLoop <= $loop; $nestedLoop++) $tmpResult[] = "*";
                    $result[] = implode(" ", $tmpResult);
                }
                break;
        }

        $result = implode("<br />", $result);
        $textAlign = in_array($type, [1 , 2]) ? 'left' : 'right';

        return "<p align='{$textAlign}'>{$result}</p>";
    }
}