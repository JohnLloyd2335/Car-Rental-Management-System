<div>
    <div class="user-table-container">
        <div class="table-button-header-container">

        </div>
        <div class="table-container">
            <table id="userTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile Number</th>
                        <th>Address</th>
                        <th>User Type</th>
                        <th>Status</th>
                        <th>Date Registered</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->mobile_number }}</td>
                            <td>{{ $user->address }}</td>
                            <td>
                                @if (!$user->is_admin)
                                    <p class="badge-primary">Customer</p>
                                @endif
                            </td>
                            <td>
                                @if ($user->is_blocked)
                                    <p class="badge-danger">Blocked</p>
                                @else
                                    <p class="badge-success">Approved</p>
                                @endif
                            </td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <div class="td-action">

                                    <a href="{{ route('manage_user.edit', $user) }}" class="btn btn-success"><i
                                            class="fas fa-edit"></i></a>

                                    <button onclick="updateUserStatus({{ $user->id }})"
                                        class="btn {{ !$user->is_blocked ? 'btn-dark' : 'btn-primary' }}"><i
                                            class="fas {{ !$user->is_blocked ? 'fa-ban' : 'fa-check' }}"></i></button>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No Record Found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div style="width: 100%;">
            {{ $users->links() }}
        </div>

    </div>
</div>
