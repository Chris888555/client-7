<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Users;

class ManageUserController extends Controller
{
    public function showManageUser(Request $request)
    {
        $query = Users::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('is_approved', $request->status);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(10);

        $totalApproved = (clone $query)->where('is_approved', 1)->count();
        $totalPending = (clone $query)->where('is_approved', 0)->count();


       return view('admin.manage-users', compact('users', 'totalApproved', 'totalPending'));

    }

    public function bulkAction(Request $request)
    {
        $action = $request->input('action');
        $userIds = $request->input('user_ids');

        if (!in_array($action, ['approve', 'disapprove', 'make-admin', 'make-user', 'delete']) || !is_array($userIds)) {
            return response()->json(['success' => false, 'message' => 'Invalid request.'], 400);
        }

        $users = Users::whereIn('id', $userIds)->get();

        foreach ($users as $user) {
            switch ($action) {
                case 'approve':
                    $user->is_approved = 1;
                    break;
                case 'disapprove':
                    $user->is_approved = 0;
                    break;
                case 'make-admin':
                    $user->role = 'admin';
                    break;
                case 'make-user':
                    $user->role = 'user';
                    break;
                case 'delete':
                    $user->delete();
                    continue 2; // skip save() for deleted user
            }
            $user->save();
        }

        return response()->json(['success' => true, 'message' => 'Action applied successfully.']);
    }
}
