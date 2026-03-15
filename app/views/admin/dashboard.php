<!--begin::Admin Dashboard (based on Metronic index.html stats widgets)-->

<!--begin::Row - Stats Cards-->
<div class="row gy-5 g-xl-8 mb-8">

    <!--begin::Col - Total Users-->
    <div class="col-xl-4">
        <div class="card bg-primary card-xl-stretch">
            <div class="card-body">
                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="white"/>
                        <rect opacity="0.3" x="8" y="3" width="8" height="8" rx="4" fill="white"/>
                    </svg>
                </span>
                <div class="text-white fw-bold fs-2 mb-2 mt-5"><?= $totalUsers ?></div>
                <div class="fw-semibold text-white opacity-75">Total Users</div>
            </div>
        </div>
    </div>
    <!--end::Col-->

    <!--begin::Col - Active Users-->
    <div class="col-xl-4">
        <div class="card bg-success card-xl-stretch">
            <div class="card-body">
                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="white"/>
                        <path d="M10.4343 12.4343L8.75 10.75C8.33579 10.3358 7.66421 10.3358 7.25 10.75C6.83579 11.1642 6.83579 11.8358 7.25 12.25L10.2929 15.2929C10.6834 15.6834 11.3166 15.6834 11.7071 15.2929L17.25 9.75C17.6642 9.33579 17.6642 8.66421 17.25 8.25C16.8358 7.83579 16.1642 7.83579 15.75 8.25L11.5657 12.4343C11.2533 12.7467 10.7467 12.7467 10.4343 12.4343Z" fill="white"/>
                    </svg>
                </span>
                <div class="text-white fw-bold fs-2 mb-2 mt-5"><?= $activeUsers ?></div>
                <div class="fw-semibold text-white opacity-75">Active Users</div>
            </div>
        </div>
    </div>
    <!--end::Col-->

    <!--begin::Col - Quick Actions-->
    <div class="col-xl-4">
        <div class="card bg-warning card-xl-stretch">
            <div class="card-body">
                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="white"/>
                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="white"/>
                    </svg>
                </span>
                <div class="text-white fw-bold fs-2 mb-2 mt-5">
                    <a href="<?= BASE_URL ?>/admin/users/create" class="text-white text-hover-dark">Add User</a>
                </div>
                <div class="fw-semibold text-white opacity-75">Quick Action</div>
            </div>
        </div>
    </div>
    <!--end::Col-->

</div>
<!--end::Row-->

<!--begin::Row - Users Table (based on Metronic Tables Widget 9 from index.html)-->
<div class="row g-5 g-xxl-8">
    <div class="col-xl-12">
        <div class="card card-xl-stretch mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bolder fs-3 mb-1">All Registered Users</span>
                    <span class="text-muted mt-1 fw-bold fs-7">Total <?= count($allUsers) ?> accounts</span>
                </h3>
                <div class="card-toolbar">
                    <a href="<?= BASE_URL ?>/admin/users/create" class="btn btn-sm btn-primary">
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"/>
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"/>
                            </svg>
                        </span>
                        Add New User
                    </a>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body py-3">
                <div class="table-responsive">
                    <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                        <thead>
                            <tr class="fw-bolder text-muted">
                                <th class="min-w-50px">#ID</th>
                                <th class="min-w-150px">Name</th>
                                <th class="min-w-150px">Email</th>
                                <th class="min-w-100px">Role</th>
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-150px">Registered</th>
                                <th class="min-w-100px text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($allUsers)): ?>
                            <tr><td colspan="7" class="text-center text-muted py-10">No users found.</td></tr>
                        <?php else: ?>
                            <?php foreach ($allUsers as $user): ?>
                            <tr>
                                <td><span class="text-muted fw-bold">#<?= $user['id'] ?></span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <img src="<?= BASE_URL ?>/assets/media/avatars/<?= $user['role'] === 'admin' ? '150-26.jpg' : '150-1.jpg' ?>" alt=""/>
                                        </div>
                                        <div class="d-flex justify-content-start flex-column">
                                            <span class="text-dark fw-bolder fs-6"><?= htmlspecialchars($user['name']) ?></span>
                                            <span class="text-muted fw-bold fs-7"><?= $user['role'] === 'admin' ? 'Administrator' : 'Regular User' ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold d-block fs-6"><?= htmlspecialchars($user['email']) ?></span>
                                </td>
                                <td>
                                    <?php if ($user['role'] === 'admin'): ?>
                                        <span class="badge badge-light-danger">Admin</span>
                                    <?php else: ?>
                                        <span class="badge badge-light-primary">User</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if ($user['status'] === 'active'): ?>
                                        <span class="badge badge-light-success">Active</span>
                                    <?php else: ?>
                                        <span class="badge badge-light-warning">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="text-muted fw-bold fs-7"><?= date('d M Y', strtotime($user['created_at'])) ?></span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end flex-shrink-0">
                                        <?php if ($user['role'] !== 'admin'): ?>
                                        <a href="<?= BASE_URL ?>/admin/users/permissions/<?= $user['id'] ?>"
                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                           title="Manage Permissions">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"/>
                                                </svg>
                                            </span>
                                        </a>
                                        <?php endif; ?>
                                        <a href="<?= BASE_URL ?>/admin/users/edit/<?= $user['id'] ?>"
                                           class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                           title="Edit User">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="black"/>
                                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="black"/>
                                                </svg>
                                            </span>
                                        </a>
                                        <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                        <a href="<?= BASE_URL ?>/admin/users/delete/<?= $user['id'] ?>"
                                           class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm"
                                           title="Delete User"
                                           onclick="return confirm('Delete this user?')">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"/>
                                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"/>
                                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"/>
                                                </svg>
                                            </span>
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
            <!--end::Body-->
        </div>
    </div>
</div>
<!--end::Row-->
