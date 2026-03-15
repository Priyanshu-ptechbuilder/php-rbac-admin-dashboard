<!--begin::Create User (from Metronic modals/wizards/create-account.html pattern)-->
<div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header border-0 pt-6">
                <h3 class="card-title fw-bolder">Create New User</h3>
                <div class="card-toolbar">
                    <a href="<?= BASE_URL ?>/admin/users" class="btn btn-sm btn-light">
                        ← Back to Users
                    </a>
                </div>
            </div>

            <div class="card-body">

                <?php if (!empty($error)): ?>
                <div class="alert alert-danger d-flex align-items-center p-5 mb-8">
                    <span class="svg-icon svg-icon-2hx svg-icon-danger me-3">❌</span>
                    <div><?= htmlspecialchars($error) ?></div>
                </div>
                <?php endif; ?>

                <form method="POST" action="<?= BASE_URL ?>/admin/users/create">

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Full Name</label>
                        <input type="text"
                               name="name"
                               class="form-control form-control-solid mb-3 mb-lg-0"
                               placeholder="Enter full name"
                               value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                               required/>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Email Address</label>
                        <input type="email"
                               name="email"
                               class="form-control form-control-solid mb-3 mb-lg-0"
                               placeholder="user@example.com"
                               value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                               required/>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Password</label>
                        <input type="password"
                               name="password"
                               class="form-control form-control-solid mb-3 mb-lg-0"
                               placeholder="Min. 6 characters"
                               required/>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Role</label>
                        <select name="role" class="form-select form-select-solid" required>
                            <option value="user" <?= ($_POST['role'] ?? 'user') === 'user' ? 'selected' : '' ?>>
                                User (Regular)
                            </option>
                            <option value="admin" <?= ($_POST['role'] ?? '') === 'admin' ? 'selected' : '' ?>>
                                Admin
                            </option>
                        </select>
                    </div>
                    <!--end::Input group-->

                    <div class="separator my-8"></div>

                    <div class="d-flex justify-content-end">
                        <a href="<?= BASE_URL ?>/admin/users" class="btn btn-light me-3">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Create User</span>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Create User-->
