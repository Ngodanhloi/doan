<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(3);
        return view('roleadmin.user', compact('users'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'ten' => 'required|max:50',
            'email' => 'required|email|unique:user,email', // Đảm bảo rằng email là duy nhất trong bảng users
            'password' => 'required|min:8', // Đặt yêu cầu độ dài tối thiểu là 6 ký tự
        ]);

        // Tạo người dùng mới
        $user = new User;
        $user->name = $request->ten;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Mã hóa mật khẩu trước khi lưu
        $user->role = 'user'; // Có thể cho phép đặt giá trị này thông qua form nếu muốn
        $user->save();

        return redirect()->route('roleadmin.user.index')->with('success', 'Người dùng mới đã được thêm thành công.');
    }

    public function update(Request $request, $user_id)
    {
        $user = User::find($user_id);

        // Validate the input data
        $validatedData = $request->validate([
            'ten' => 'required|max:50',
            'email' => 'required|email|unique:user,email,' . $user_id . ',user_id',
            'password' => 'required|min:8',
            'role' => 'required|in:admin,user', // Chỉ chấp nhận giá trị admin hoặc user
        ]);

        // Update the user data
        $user->name = $validatedData['ten'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']);
        $user->role = $validatedData['role']; // Cập nhật quyền
        $user->save();

        return redirect()->route('roleadmin.user.index')->with('success', 'Tài khoản đã được cập nhật thành công!');
    }

    public function delete($id)
    {
        User::destroy($id);

        return redirect()->route('roleadmin.user.index')->with('success', 'Tài khoản đã được xóa thành công.');
    }

    public function reset(Request $request)
{
    // Validate request data
    $request->validate([
        'user_ids' => 'required|array',
        'user_ids.*' => 'exists:user,user_id',
    ]);

    // Loop through each user_id
    foreach ($request->user_ids as $user_id) {
        // Find the user by user_id
        $user = User::find($user_id);

        // Use the email address as the password
        $password = $user->email;

        // Hash the password
        $hashedPassword = bcrypt($password);

        // Update user's password
        $user->password = $hashedPassword;
        $user->save();
    }

    // Return a response
    return redirect()->route('roleadmin.user.index')->with('success', 'Mật khẩu đã được reset về mật khẩu giống với địa chỉ email.');
}

}
