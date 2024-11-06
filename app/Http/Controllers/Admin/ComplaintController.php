<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Complaint\ComplaintResource;
use App\Models\Complaint;
use App\Service\NotificationService;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::all();
        $complaints = ComplaintResource::collection($complaints)->resolve();
        return inertia('Admin/Complaint/Index', compact('complaints'));
    }

    public function update(Complaint $complaint): array
    {
        $complaint->update([
            'is_solved' => !$complaint->is_solved
        ]);

        NotificationService::store($complaint->message, $complaint->is_solved ? 'Решено' : 'В работе', $complaint->user_id);

        return ComplaintResource::make($complaint)->resolve();
    }
}
