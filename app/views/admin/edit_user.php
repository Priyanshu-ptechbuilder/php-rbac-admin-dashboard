<!--begin::Edit User-->
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h3 class="card-title fw-bolder">
                    Edit User — <span class="text-primary"><?= htmlspecialchars($user['name']) ?></span>
                </h3>
                <div class="card-toolbar">
                    <a href="<?= BASE_URL ?>/admin/users" class="btn btn-sm btn-light">← Back to Users</a>
                </div>
            </div>

            <div class="card-body">

                <?php if (!empty($error)): ?>
                <div class="alert alert-danger d-flex align-items-center p-5 mb-8">
                    <span class="me-3">❌</span>
                    <div><?= htmlspecialchars($error) ?></div>
                </div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>/admin/users/edit/<?= $user['hash_id'] ?>">

                    <!--begin::User Info card-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-8">
                        <div class="symbol symbol-100px symbol-lg-160px mb-7 me-7">
                            <?php if (!empty($user['avatar'])): ?>
                                <img src="<?= $user['avatar'] ?>" alt="user" />
                            <?php else: ?>
                                <div class="symbol-label fw-bold fs-1"
                                     style="background:#f1f4ff;color:#3e97ff;width:100px;height:100px;font-size:32px;display:flex;align-items:center;justify-content:center;border-radius:12px;">
                                    <?= strtoupper(substr($user['name'], 0, 1)) ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">
                                            <?= htmlspecialchars($user['name']) ?>
                                        </span>
                                    </div>
                                    <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                        <span class="d-flex align-items-center text-gray-400 me-5 mb-2">
                                            📧 <?= htmlspecialchars($user['email']) ?>
                                        </span>
                                        <span class="d-flex align-items-center text-gray-400 mb-2">
                                            👤 <?= ucfirst($user['role']) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap flex-stack">
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <div class="d-flex flex-wrap">
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <span class="fw-bold fs-6 text-gray-400">Joined</span>
                                            </div>
                                            <div class="fw-bolder fs-6"><?= date('d M Y', strtotime($user['created_at'])) ?></div>
                                        </div>
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <span class="fw-bold fs-6 text-gray-400">Status</span>
                                            </div>
                                            <div class="fw-bolder fs-6">
                                                <?= $user['status'] === 'active'
                                                    ? '<span class="text-success">Active</span>'
                                                    : '<span class="text-warning">Inactive</span>' ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::User Info card-->

                    <div class="separator my-6"></div>

                    <!--begin::Form fields-->
                    <div class="fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Full Name</label>
                        <input type="text" name="name"
                               class="form-control form-control-solid"
                               value="<?= htmlspecialchars($user['name']) ?>" required/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Email</label>
                        <input type="email" name="email"
                               class="form-control form-control-solid"
                               value="<?= htmlspecialchars($user['email']) ?>" required/>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fw-bold fs-6 mb-2">New Password <span class="text-muted">(leave blank to keep current)</span></label>
                        <div class="password-input-group">
                            <input type="password" name="password"
                                   class="form-control form-control-solid"
                                   placeholder="Enter new password to change"/>
                            <span class="password-toggle-btn">👁️‍🗨️</span>
                        </div>
                    </div>

                    <div class="row mb-7">
                        <div class="col-md-6 fv-row">
                            <label class="required fw-bold fs-6 mb-2">Role</label>
                            <select name="role" class="form-select form-select-solid">
                                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fw-bold fs-6 mb-2">Status</label>
                            <select name="status" class="form-select form-select-solid">
                                <option value="active" <?= $user['status'] === 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= $user['status'] === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <!--end::Form fields-->

                    <div class="separator my-8"></div>

                    <div class="d-flex justify-content-end">
                        <a href="<?= BASE_URL ?>/admin/users" class="btn btn-light me-3">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Edit User-->
