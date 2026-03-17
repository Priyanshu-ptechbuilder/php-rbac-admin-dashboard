<?php
$avatar = !empty($user['avatar']) ? $user['avatar'] : BASE_URL . '/assets/media/avatars/150-1.jpg';
?>
<!--begin::Profile View (Refactored to match provided UI design)-->
<div class="mb-5">
    <h1 class="text-dark fw-bolder mb-1 fs-2">User Profile</h1>
    <div class="text-muted fw-bold fs-6">Central Hub for Personal Customization</div>
</div>

<div class="card shadow-sm mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Personal Info</h3>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body p-0">
        
        <?php if (!empty($error)): ?>
        <div class="alert alert-danger mx-9 mt-5"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
        <div class="alert alert-success mx-9 mt-5"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>

        <!--begin::Info rows-->
        <div class="border-top">
            <!-- PHOTO ROW -->
            <div class="d-flex align-items-center py-5 px-9 border-bottom">
                <div class="fw-bold fs-6 text-gray-800 w-200px">Photo</div>
                <div class="flex-grow-1 text-muted fs-6">150x150px JPEG, PNG Image</div>
                
                <form id="kt_avatar_form" method="POST" action="<?= BASE_URL ?><?= ($user['role'] ?? '') === 'admin' ? '/admin/profile/update-avatar' : '/profile/update-avatar' ?>" enctype="multipart/form-data">
                    <div class="symbol symbol-100px symbol-circle position-relative border border-success border-2 p-1">
                        <?php if (!empty($user['avatar'])): ?>
                            <img src="<?= $user['avatar'] ?>" alt="user" id="avatar_preview" />
                        <?php else: ?>
                            <div class="symbol-label fs-1 bg-light-primary text-primary fw-bolder" style="width:100px; height:100px;">
                                <?= strtoupper(substr($user['name'], 0, 1)) ?>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Upload label overlay -->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow position-absolute translate-middle bottom-0 start-50 mb-n3 cursor-pointer">
                            <i class="bi bi-camera-fill fs-8"></i>
                            <input type="file" name="avatar" class="d-none" onchange="document.getElementById('kt_avatar_form').submit()" />
                        </label>
                    </div>
                </form>
            </div>

            <!-- NAME ROW -->
            <div class="d-flex align-items-center py-5 px-9 border-bottom">
                <div class="fw-bold fs-6 text-gray-800 w-200px">Name</div>
                <div class="flex-grow-1 text-gray-700 fs-6 fw-bold"><?= htmlspecialchars($user['name']) ?></div>
                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_update_profile">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </div>

            <!-- AVAILABILITY ROW -->
            <div class="d-flex align-items-center py-5 px-9 border-bottom">
                <div class="fw-bold fs-6 text-gray-800 w-200px">Availability</div>
                <div class="flex-grow-1">
                    <span class="badge badge-light-success fw-bolder px-4 py-2"><?= htmlspecialchars($user['availability'] ?? 'Available now') ?></span>
                </div>
                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_update_profile">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </div>

            <!-- BIRTHDAY ROW -->
            <div class="d-flex align-items-center py-5 px-9 border-bottom">
                <div class="fw-bold fs-6 text-gray-800 w-200px">Birthday</div>
                <div class="flex-grow-1 text-gray-700 fs-6 fw-bold"><?= !empty($user['birthday']) ? date('d M Y', strtotime($user['birthday'])) : '<span class="text-muted">Not set</span>' ?></div>
                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_update_profile">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </div>

            <!-- GENDER ROW -->
            <div class="d-flex align-items-center py-5 px-9 border-bottom">
                <div class="fw-bold fs-6 text-gray-800 w-200px">Gender</div>
                <div class="flex-grow-1 text-gray-700 fs-6 fw-bold"><?= htmlspecialchars($user['gender'] ?? 'Not specified') ?></div>
                <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_update_profile">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </div>

            <!-- ADDRESS ROW -->
            <div class="d-flex align-items-center py-5 px-9 border-bottom">
                <div class="fw-bold fs-6 text-gray-800 w-200px">Address</div>
                <div class="flex-grow-1 <?= !empty($user['address']) ? 'text-gray-700 fw-bold' : 'text-muted' ?> fs-6">
                    <?= !empty($user['address']) ? htmlspecialchars($user['address']) : 'You have no address yet' ?>
                </div>
                <a href="#" class="btn btn-color-primary fw-bolder fs-6" data-bs-toggle="modal" data-bs-target="#kt_modal_update_profile">
                    <?= !empty($user['address']) ? 'Edit' : 'Add' ?>
                </a>
            </div>
        </div>
        <!--end::Info rows-->
    </div>
    <!--end::Card body-->
</div>

<!-- Unified Modal for updating profile info -->
<div class="modal fade" id="kt_modal_update_profile" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bolder">Update Personal Information</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <span class="svg-icon svg-icon-1">❌</span>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form method="POST" action="<?= BASE_URL ?><?= ($user['role'] ?? '') === 'admin' ? '/admin/profile/update' : '/profile/update' ?>">
                    <div class="fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Full Name</label>
                        <input type="text" name="name" class="form-control form-control-solid mb-3 mb-lg-0" value="<?= htmlspecialchars($user['name']) ?>" required />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="required fw-bold fs-6 mb-2">Email Address</label>
                        <input type="email" name="email" class="form-control form-control-solid mb-3 mb-lg-0" value="<?= htmlspecialchars($user['email']) ?>" required />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="fw-bold fs-6 mb-2">Availability Status</label>
                        <input type="text" name="availability" class="form-control form-control-solid mb-3 mb-lg-0" value="<?= htmlspecialchars($user['availability'] ?? '') ?>" placeholder="e.g. Available now" />
                    </div>
                    <div class="row mb-7">
                        <div class="col-md-6">
                            <label class="fw-bold fs-6 mb-2">Birthday</label>
                            <input type="date" name="birthday" class="form-control form-control-solid" value="<?= htmlspecialchars($user['birthday'] ?? '') ?>" />
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold fs-6 mb-2">Gender</label>
                            <select name="gender" class="form-select form-select-solid">
                                <option value="">Select gender</option>
                                <option value="Male" <?= ($user['gender'] ?? '') === 'Male' ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= ($user['gender'] ?? '') === 'Female' ? 'selected' : '' ?>>Female</option>
                                <option value="Other" <?= ($user['gender'] ?? '') === 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="fw-bold fs-6 mb-2">Residential Address</label>
                        <textarea name="address" class="form-control form-control-solid" rows="3"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                    </div>
                    
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Password Security Section -->
<div class="card shadow-sm">
    <div class="card-header border-0 cursor-pointer">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">Security Settings</h3>
        </div>
    </div>
    <div class="card-body border-top p-9">
        
        <?php if (!empty($pwdError)): ?>
        <div class="alert alert-danger mb-5"><?= htmlspecialchars($pwdError) ?></div>
        <?php endif; ?>
        <?php if (!empty($pwdSuccess)): ?>
        <div class="alert alert-success mb-5"><?= htmlspecialchars($pwdSuccess) ?></div>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>/profile/update-password">
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-bold fs-6">Current Password</label>
                <div class="col-lg-8 fv-row password-input-group">
                    <input type="password" name="current_password" class="form-control form-control-lg form-control-solid" required/>
                    <span class="password-toggle-btn">👁️‍🗨️</span>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-bold fs-6">New Password</label>
                <div class="col-lg-8 fv-row password-input-group">
                    <input type="password" name="new_password" class="form-control form-control-lg form-control-solid" required/>
                    <span class="password-toggle-btn">👁️‍🗨️</span>
                </div>
            </div>
            <div class="row mb-6">
                <label class="col-lg-4 col-form-label required fw-bold fs-6">Confirm New Password</label>
                <div class="col-lg-8 fv-row password-input-group">
                    <input type="password" name="confirm_password" class="form-control form-control-lg form-control-solid" required/>
                    <span class="password-toggle-btn">👁️‍🗨️</span>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-6">Update Password</button>
            </div>
        </form>
    </div>
</div>
