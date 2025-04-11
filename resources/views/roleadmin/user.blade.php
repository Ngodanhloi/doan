<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .search-container {
            margin-bottom: 20px;
        }

        #searchInput {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #searchButton {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #searchButton:hover {
            background-color: #45a049;
        }
    </style>
</head>

<header>
    <h1>Trang chủ ADMIN</h1>
    <a href="{{url('/')}}"><i class="fa fa-home" style="color:#fff; font-size: 25px;"></i></a>
    <nav>
        <ul>
            <li><a href="{{asset('admin')}}" class="nav-link">Quản lý sản phẩm</a></li>
            <li><a href="{{asset('roleadmin/cate')}}" class="nav-link">Danh Mục</a></li>
            <li><a href="{{asset('roleadmin/user')}}" class="nav-link">Quản lý tài khoản</a></li>
        </ul>
    </nav>
</header>

<main>
    @if (session('success'))
    <div id="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <section id="accounts-section" class="admin-section">
        <h2>Quản lý tài khoản</h2>
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Tìm kiếm theo tên người dùng...">
            <button type="button" id="searchButton">Tìm kiếm</button>
        </div>
        <!-- Button to trigger the popup -->
        <button id="openPopupButton" class="btn btn-primary">Thêm tài khoản</button>
        <!-- Popup form -->
        <div id="popupForm" style="display: none;">
            <form id="addProductForm" action="{{ route('roleadmin.user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="ten">Tên người dùng:</label>
                    <input type="text" id="ten" name="ten" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
            </form>
            <button id="closePopupButton" class="btn btn-danger">Đóng</button>
        </div>


        <!-- Button to trigger the popup -->
        <button id="resetPasswordButton" class="btn btn-warning">Reset Mật Khẩu</button>

        <!-- Popup form -->
        <div id="resetPasswordPopup" style="display: none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; padding: 20px; border: 1px solid #ccc; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); z-index: 9999;">
            <form id="resetPasswordForm" action="{{ route('roleadmin.user.reset') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Chọn người dùng:</label><br>
                    @foreach ($users as $user)
                    <div class="form-check">
                        <input type="checkbox" id="user_{{ $user->user_id }}" name="user_ids[]" value="{{ $user->user_id }}" class="form-check-input">
                        <label class="form-check-label" for="user_{{ $user->user_id }}">{{ $user->name }}</label>
                    </div>
                    @endforeach
                </div>
                <button type="submit" class="btn btn-primary">Reset Mật Khẩu</button>
                <button type="button" class="btn btn-danger" onclick="closeResetPasswordPopup()" style="margin: 10px; ">Đóng</button>
            </form>
        </div>


        @isset($users)
        @if ($users->count())
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Mật Khẩu (Hash)</th>
                    <th>Quyền</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->user_id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <button class="edit-button" data-product-id="{{ $user->user_id }}">Edit</button>

                        <form action="{{ route('roleadmin.user.delete', ['user_id' => $user->user_id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Xóa</button>
                        </form>
                    </td>
                    <!-- Edit form container -->
                    <div id="editFormContainer-{{ $user->user_id }}" class="edit-form-container" style="display: none;">
                        <form action="{{ route('roleadmin.user.update', $user->user_id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="ten">Tên Người Dùng:</label>
                                <input type="text" id="ten" name="ten" class="form-control" value="{{ $user->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <textarea id="email" name="email" class="form-control" required>{{ $user->email }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <textarea id="password" name="password" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="role">Quyền:</label>
                                <select id="role" name="role" class="form-control" required>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập Nhật Tài Khoản</button>
                            <button type="button" class="btn btn-danger" onclick="closeEditForm()">Đóng</button>
                        </form>
                    </div>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>Không có tài khoản nào.</p>
        @endif
        @endisset
        {{$users->links()}}
    </section>
    <script>
        // Function to open reset password popup
        function openResetPasswordPopup() {
            document.getElementById('resetPasswordPopup').style.display = 'block';
        }

        // Function to close reset password popup
        function closeResetPasswordPopup() {
            document.getElementById('resetPasswordPopup').style.display = 'none';
        }

        // Add event listener to open popup button
        document.getElementById('resetPasswordButton').addEventListener('click', openResetPasswordPopup);

        document.addEventListener('DOMContentLoaded', function() {
            // Lắng nghe sự kiện khi người dùng click vào nút tìm kiếm
            document.getElementById('searchButton').addEventListener('click', function() {
                searchAccounts();
            });

            // Lắng nghe sự kiện khi người dùng ấn phím Enter trong ô tìm kiếm
            document.getElementById('searchInput').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchAccounts();
                }
            });
        });

        // Hàm tìm kiếm tài khoản
        function searchAccounts() {
            var searchKeyword = document.getElementById('searchInput').value.toLowerCase();
            var accounts = document.querySelectorAll('#accounts-section tbody tr');

            var found = false;
            accounts.forEach(function(account) {
                var name = account.querySelector('td:nth-child(2)').textContent.toLowerCase();
                if (name.includes(searchKeyword)) {
                    account.style.display = 'table-row';
                    found = true;
                } else {
                    account.style.display = 'none';
                }
            });

            // Hiển thị thông báo alert nếu không tìm thấy tài khoản
            if (!found) {
                alert('Không có tài khoản người dùng nào phù hợp với từ khóa tìm kiếm.');
            }
        }
    </script>

</html>
<script src="{{asset('js/admin.js')}}"></script>