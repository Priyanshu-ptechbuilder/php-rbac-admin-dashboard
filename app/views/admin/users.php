<!--begin::Users List (from Metronic apps/user-management/users/list.html pattern)-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <h3 class="fw-bolder">User Management</h3>
        </div>
        <div class="card-toolbar">
            <a href="<?= BASE_URL ?>/admin/users/create" class="btn btn-primary">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"/>
                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"/>
                    </svg>
                </span>
                Add User
            </a>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body pt-0">
        <div class="table-responsive">
            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                <thead>
                    <tr class="fw-bolder text-muted bg-light">
                        <th class="ps-4 min-w-50px rounded-start">#</th>
                        <th class="min-w-200px">User</th>
                        <th class="min-w-150px">Email</th>
                        <th class="min-w-100px">Role</th>
                        <th class="min-w-100px">Status</th>
                        <th class="min-w-150px">Joined</th>
                        <th class="min-w-150px text-end rounded-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-15">
                            <div class="fs-4 fw-bold">No users found</div>
                            <div class="fs-6 text-muted mt-2">Start by adding a new user</div>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="ps-4">
                            <span class="text-muted fw-bold fs-7">#<?= $user['id'] ?></span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="symbol symbol-45px me-5">
                                    <img src="<?= BASE_URL ?>/assets/media/avatars/<?= $user['role'] === 'admin' ? '150-26.jpg' : '150-1.jpg' ?>" alt=""/>
                                </div>
                                <div class="d-flex justify-content-start flex-column">
                                    <span class="text-dark fw-bolder text-hover-primary fs-6">
                                        <?= htmlspecialchars($user['name']) ?>
                                    </span>
                                    <span class="text-muted fw-bold text-muted d-block fs-7">
                                        <?= $user['role'] === 'admin' ? 'System Administrator' : 'Regular User' ?>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="text-dark fw-bold d-block fs-6"><?= htmlspecialchars($user['email']) ?></span>
                        </td>
                        <td>
                            <?php if ($user['role'] === 'admin'): ?>
                                <span class="badge badge-light-danger fs-8 fw-bolder">Admin</span>
                            <?php else: ?>
                                <span class="badge badge-light-primary fs-8 fw-bolder">User</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($user['status'] === 'active'): ?>
                                <div class="d-flex align-items-center">
                                    <div class="bullet bullet-vertical h-20px bg-success me-2"></div>
                                    <span class="text-success fw-bold">Active</span>
                                </div>
                            <?php else: ?>
                                <div class="d-flex align-items-center">
                                    <div class="bullet bullet-vertical h-20px bg-warning me-2"></div>
                                    <span class="text-warning fw-bold">Inactive</span>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td>
                            <span class="text-muted fw-bold d-block fs-7">
                                <?= date('d M Y', strtotime($user['created_at'])) ?>
                            </span>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end flex-shrink-0">
                                <?php if ($user['role'] !== 'admin'): ?>
                                <a href="<?= BASE_URL ?>/admin/users/permissions/<?= $user['id'] ?>"
                                   class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-1"
                                   title="Manage Feature Permissions">
                                    🔒
                                </a>
                                <?php endif; ?>
                                <a href="<?= BASE_URL ?>/admin/users/edit/<?= $user['id'] ?>"
                                   class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                   title="Edit User">
                                    ✏️
                                </a>
                                <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                <a href="<?= BASE_URL ?>/admin/users/delete/<?= $user['id'] ?>"
                                   class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm"
                                   title="Delete User"
                                   onclick="return confirm('Are you sure you want to delete <?= htmlspecialchars(addslashes($user['name'])) ?>?')">
                                    🗑️
                                </a>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--end::Card body-->
</div>
<!--end::Users List-->
