<?php

namespace App\Http\Controllers\Api\V1\Admin\ManageStudents;

use App\DTOs\StudentDTO\StudentRegistrationData;
use App\DTOs\StudentDTO\StudentUpdateData;
use App\Helpers\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminStudentCRUDRequest\StudentRegistrationRequest;
use App\Http\Requests\Admin\AdminStudentCRUDRequest\StudentUpdateRequest;
use App\Http\Resources\StudentResource\StudentResource;
use App\Models\Student;
use App\Services\Student\StudentCRUDService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AdminManagesStudent extends Controller
{
    protected $studentService;

    public function __construct(StudentCRUDService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function index(Request $request): JsonResponse
    {
        try {
            $perPage = $request->get('per_page', 15);
            $students = $this->studentService->getAll($perPage);
            return ApiResponseHelper::success(StudentResource::collection($students), 'Students retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Failed to retrieve students: ' . $e->getMessage(), 500);
        }
    }

    public function store(StudentRegistrationRequest $request): JsonResponse
    {
        try {
            $studentData = StudentRegistrationData::from($request->validated())->getData();
            $result = $this->studentService->store($studentData);
            return ApiResponseHelper::success('Student created successfully', new StudentResource($result));
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Failed to register student: ' . $e->getMessage(), 500);
        }
    }

    public function show(Student $student): JsonResponse
    {
        try {
            return ApiResponseHelper::success(new StudentResource($student), 'Student retrieved successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Failed to retrieve student: ' . $e->getMessage(), 500);
        }
    }

    public function update(StudentUpdateRequest $request, Student $student): JsonResponse
    {
        try {
            $studentData = StudentUpdateData::from($request->validated())->getData();

            $result = $this->studentService->update($student,$studentData);
            return ApiResponseHelper::success(new StudentResource($result), 'Student updated successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Failed to update student: ' . $e->getMessage(), 500);
        }
    }

    public function destroy(Student $student): JsonResponse
    {
        try {
            $student->delete();
            return ApiResponseHelper::success(null, 'Student deleted successfully');
        } catch (\Exception $e) {
            return ApiResponseHelper::error('Failed to delete student: ' . $e->getMessage(), 500);
        }
    }
}
