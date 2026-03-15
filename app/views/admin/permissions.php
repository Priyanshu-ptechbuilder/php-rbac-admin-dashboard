<!--begin::Permissions Page (from Metronic apps/user-management/roles/view.html pattern)-->
<div class="row justify-content-center">
    <div class="col-xl-9">

        <!--begin::User info header card-->
        <div class="card mb-6">
            <div class="card-body pt-9 pb-0">
                <div class="d-flex flex-wrap flex-sm-nowrap mb-6">
                    <div class="symbol symbol-100px symbol-fixed position-relative me-7 mb-4">
                        <div style="width:80px;height:80px;background:#f1f4ff;color:#3e97ff;font-size:32px;font-weight:700;display:flex;align-items:center;justify-content:center;border-radius:12px;">
                            <?= strtoupper(substr($user['name'], 0, 1)) ?>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2">
                                    <h2 class="text-gray-900 fs-2 fw-bolder me-1">
                                        <?= htmlspecialchars($user['name']) ?>
                                    </h2>
                                </div>
                                <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                    <span class="d-flex align-items-center text-gray-400 me-5 mb-2">
                                        📧 <?= htmlspecialchars($user['email']) ?>
                                    </span>
                                    <span class="d-flex align-items-center me-5 mb-2">
                                        <?php if ($user['status'] === 'active'): ?>
                                            <span class="badge badge-light-success">✅ Active</span>
                                        <?php else: ?>
                                            <span class="badge badge-light-warning">⚠️ Inactive</span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap my-4">
                                <a href="<?= BASE_URL ?>/admin/users/edit/<?= $user['id'] ?>"
                                   class="btn btn-sm btn-light me-2">✏️ Edit User</a>
                                <a href="<?= BASE_URL ?>/admin/users"
                                   class="btn btn-sm btn-light">← Back to Users</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::User info card-->

        <!--begin::Permissions Card-->
        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <h3 class="fw-bolder">Feature Access Permissions</h3>
                </div>
            </div>

            <div class="card-body pt-0">

                <?php if (isset($_GET['success'])): ?>
                <div class="alert alert-success d-flex align-items-center p-5 mb-8">
                    <span class="me-3">✅</span>
                    <div><?= htmlspecialchars($_GET['success']) ?></div>
                </div>
                <?php endif; ?>

                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6 mb-8">
                    <span class="svg-icon svg-icon-2tx svg-icon-primary me-4">ℹ️</span>
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-bold">
                            <h4 class="text-gray-900 fw-bolder">Manage Page Access</h4>
                            <div class="fs-6 text-gray-700">
                                Toggle which pages and features <strong><?= htmlspecialchars($user['name']) ?></strong>
                                can access in their frontend panel. Disabled features will not appear in their navigation.
                            </div>
                        </div>
                    </div>
                </div>

                <form method="POST" action="<?= BASE_URL ?>/admin/users/permissions/<?= $user['id'] ?>">

                    <div class="row g-5">
                        <?php if (empty($features)): ?>
                            <div class="col-12 text-center text-muted py-10">
                                No features configured. Check your database.
                            </div>
                        <?php else: ?>
                            <?php foreach ($features as $feature): ?>
                            <div class="col-md-6">
                                <!--begin::Feature Toggle Card-->
                                <div class="d-flex flex-stack p-5 border rounded <?= $feature['is_enabled'] ? 'border-success bg-light-success' : 'border-dashed border-gray-300' ?>">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-5">
                                            <span class="symbol-label <?= $feature['is_enabled'] ? 'bg-success' : 'bg-light-primary' ?>">
                                                <?php
                                                $icons = [
                                                    'dashboard'  => '🏠',
                                                    'reports'    => '📊',
                                                    'profile'    => '👤',
                                                    'documents'  => '📄',
                                                    'calendar'   => '📅',
                                                    'projects'   => '📁',
                                                ];
                                                echo $icons[$feature['feature_key']] ?? '⚙️';
                                                ?>
                                            </span>
                                        </div>
                                        <div class="ms-3">
                                            <div class="fw-bold fs-6 text-gray-800">
                                                <?= htmlspecialchars($feature['feature_label']) ?>
                                            </div>
                                            <div class="fs-7 text-muted">
                                                Route: <code><?= htmlspecialchars($feature['feature_route']) ?></code>
                                            </div>
                                            <?php if (!empty($feature['description'])): ?>
                                            <div class="fs-7 text-gray-500 mt-1">
                                                <?= htmlspecialchars($feature['description']) ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <div class="form-check form-switch form-check-custom form-check-solid form-check-success">
                                            <input class="form-check-input w-45px h-30px"
                                                   type="checkbox"
                                                   name="features[]"
                                                   value="<?= htmlspecialchars($feature['feature_key']) ?>"
                                                   <?= $feature['is_enabled'] ? 'checked' : '' ?>/>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Feature Toggle Card-->
                            </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="separator my-8"></div>

                    <div class="d-flex justify-content-end">
                        <a href="<?= BASE_URL ?>/admin/users" class="btn btn-light me-3">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            💾 Save Permissions
                        </button>
                    </div>

                </form>
            </div>
        </div>
        <!--end::Permissions Card-->

    </div>
</div>
<!--end::Permissions Page-->
