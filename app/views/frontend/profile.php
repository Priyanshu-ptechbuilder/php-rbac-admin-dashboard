<!--begin::Profile (from Metronic account/overview.html + account/settings.html pattern)-->

<!--begin::Profile Card-->
<div class="card mb-6">
    <div class="card-body pt-9 pb-0">
        <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="<?= BASE_URL ?>/assets/media/avatars/150-1.jpg" alt="image" />
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <div class="d-flex flex-column">
                        <h2 class="text-gray-900 fs-2 fw-bolder me-1 mb-2">
                            <?= htmlspecialchars($user['name']) ?>
                        </h2>
                        <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                            <span class="d-flex align-items-center text-gray-400 me-5 mb-2">
                                📧 <?= htmlspecialchars($user['email']) ?>
                            </span>
                            <span class="d-flex align-items-center text-gray-400 mb-2">
                                👤 Regular User
                            </span>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap flex-stack">
                    <div class="d-flex flex-column flex-grow-1 pe-8">
                        <div class="d-flex flex-wrap">
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="fs-2 fw-bolder"><?= is_array($features) ? count($features) : 0 ?></div>
                                <div class="fw-bold fs-6 text-gray-400">Features Enabled</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="fs-2 fw-bolder text-success">Active</div>
                                </div>
                                <div class="fw-bold fs-6 text-gray-400">Account Status</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Profile Card-->

<!--begin::Settings Card-->
<div class="card">
    <div class="card-header border-0 cursor-pointer">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Update Profile</h3>
        </div>
    </div>
    <div class="card-body border-top p-9">

        <?php if (!empty($error)): ?>
        <div class="alert alert-danger d-flex align-items-center p-5 mb-8">
            <span class="me-3">❌</span>
            <div><?= htmlspecialchars($error) ?></div>
        </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
        <div class="alert alert-success d-flex align-items-center p-5 mb-8">
            <span class="me-3">✅</span>
            <div><?= htmlspecialchars($success) ?></div>
        </div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?><?= ($user['role'] ?? '') === 'admin' ? '/admin/profile/update' : '/profile/update' ?>">
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-bold fs-6">Full Name</label>
                <div class="col-lg-8 fv-row">
                    <input type="text" name="name"
                           class="form-control form-control-lg form-control-solid"
                           value="<?= htmlspecialchars($user['name']) ?>" required/>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-bold fs-6">Email Address</label>
                <div class="col-lg-8 fv-row">
                    <input type="email" name="email"
                           class="form-control form-control-lg form-control-solid"
                           value="<?= htmlspecialchars($user['email']) ?>" required/>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-6">Save Changes</button>
            </div>
        </form>
    </div>
</div>
<!--end::Settings Card-->
