<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NumberFourController extends Controller
{
    /**
     * @var array $allowedType
     */
    protected $allowedType = ['jabatan', 'level', 'department', 'karyawan'];

    /**
     * @var Object $model
     */
    protected $model;

    /**
     * Define Model
     */
    public function __construct()
    {
        $this->model = $this->model(request()->type);
    }

    /**
     * Get Data API
     * 
     * @param Request $request
     * @param string $type
     * @return array
     * @throws ValidationException
     */
    public function read(Request $request, $type)
    {
        try {
            $id = $request->id ?? null;
            $model = new $this->model;
            $column = $model->primaryKey;
            $with = $model->moreColumn ?? [];

            $query = is_numeric($id) ? $this->model::with($with ?? [])->where($column, $id)->get() : $this->model::with($with ?? [])->get();
            $isDataExist = count($query) > 0;
            $httpResponseCode = $isDataExist ? 200 : 404;

            return response()->json([
                'code' => $httpResponseCode,
                'message' => $isDataExist ? 'Get data '.$type.' success' : 'Data not found',
                'data' => $query
            ], $httpResponseCode);

        } catch (ValidationException $e) {
            return response()->json([
                'code' => 400,
                'message' => 'Bad Request',
                'errors' => $e->errors()
            ], 400);
        }
    }

    /**
     * Create Data
     * 
     * @param Request $request
     * @param string $type
     * @return array
     * @throws ValidationException
     */
    public function create(Request $request)
    {
        try {
            $model = new $this->model;
            $request->validate($model->validation['create']);
            $model = $this->model::create($request->all());

            return response()->json([
                'code' => 201,
                'message' => 'Data successfully created',
            ], 201);

        } catch(ValidationException $e) {
            return response()->json([
                'code' => 400,
                'message' => 'Bad Request',
                'errors' => $e->errors()
            ], 400);
        }
    }

    /**
     * Update Data
     * 
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        try {
            $model = new $this->model;
            $validation = $model->validation['update'];
            $column = $model->primaryKey;
            $id = $request->input($column);

            foreach ($validation as $key => $value) {
                if (strpos($value, '{id}')) {
                    $validation[$key] = str_replace('{id}', $id . ',' . $column, $value);
                }
            }

            $request->validate($validation);
            $model = $this->model::where($column, $id);
            $code = 404;

            if (count($model->get()) > 0) {
                $model = $model->update($request->all());
                $code = 200;
            }
            return response()->json([
                'code' => $code,
                'message' => $code === 200 ? 'Data successfully updated' : 'Data not found',
            ], $code);

        } catch(ValidationException $e) {
            return response()->json([
                'code' => 400,
                'message' => 'Bad Request',
                'errors' => $e->errors()
            ], 400);
        }
    }

    /**
     * Delete Data
     * 
     * @param Request $request
     * @return array
     * @throws ValidationException
     */
    public function delete(Request $request)
    {
        try {
            $id = $request->id ?? null;
            $model = new $this->model;
            $column = $model->primaryKey;

            $query = $this->model::where($column, $id);
            if (count($query->get()) > 0) {
                $query->delete();
                $delete = true;
            }

            return response()->json([
                'code' => isset($delete) ? 200 : 404,
                'message' => isset($delete) ? 'Data successfully deleted' : 'Data not found'
            ], isset($delete) ? 200 : 404);

        } catch(ValidationException $e) {
            return response()->json([
                'code' => 400,
                'message' => 'Bad Request',
                'errors' => $e->errors()
            ], 400);
        }
    }

    /**
     * Define active model by type
     * 
     * @param string $type
     * @return mixed
     */
    private function model($type) 
    {
        switch ($type) {
            case 'jabatan': return \App\Models\Jabatan::class;
            case 'department': return \App\Models\Department::class;
            case 'level': return \App\Models\Level::class;
            case 'karyawan': return \App\Models\Karyawan::class;
        }

        header('Content-Type: application/json');
        http_response_code(400);
        echo json_encode([
            'code' => 400,
            'message' => 'Bad Request',
            'errors' => 'Invalid paramater type',
        ]);
        exit;
    }
}