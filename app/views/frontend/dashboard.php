<!--begin::User Dashboard (based on Metronic index.html stat cards + List Widget)-->

<!--begin::Welcome Banner-->
<div class="card bg-primary mb-8" style="background:linear-gradient(135deg,#009ef7,#0095e8) !important;">
    <div class="card-body d-flex align-items-center py-8">
        <div>
            <h2 class="text-white fw-bolder fs-1 mb-2">
                Welcome back, <?= htmlspecialchars($_SESSION['user_name'] ?? 'User') ?>! 👋
            </h2>
            <p class="text-white opacity-75 fs-5 mb-0">
                Here's what you have access to in your dashboard.
            </p>
        </div>
    </div>
</div>
<!--end::Welcome Banner-->

<?php if (empty($features)): ?>
<!--begin::No Features Notice-->
<div class="card">
    <div class="card-body py-15 text-center">
        <div style="font-size:64px;margin-bottom:16px;">🔒</div>
        <h3 class="fs-2 fw-bolder text-gray-800 mb-3">No Features Enabled</h3>
        <p class="text-muted fs-5 mb-6">
            Your admin has not enabled any features for your account yet.<br>
            Please contact your administrator to get access.
        </p>
        <div class="d-flex flex-center">
            <span class="badge badge-light-warning fs-6 py-3 px-5">
                ⏳ Waiting for admin to enable features
            </span>
        </div>
    </div>
</div>
<!--end::No Features Notice-->

<?php else: ?>
<!--begin::Features Grid (from Metronic Quick Links widget in index.html)-->
<div class="row g-5 g-xl-8 mb-8">
    <?php foreach ($features as $fKey => $feature): ?>
    <div class="col-xl-4 col-md-6">
        <a href="<?= BASE_URL . $feature['feature_route'] ?>" class="card card-flush h-md-100 hover-elevate-up">
            <div class="card-body d-flex flex-column justify-content-between p-8">
                <div class="d-flex align-items-center mb-6">
                    <?php
                    $iconMap = [
                        'dashboard'  => ['icon' => '🏠', 'color' => '#009ef7', 'bg' => '#f1faff'],
                        'reports'    => ['icon' => '📊', 'color' => '#50cd89', 'bg' => '#e8fff3'],
                        'profile'    => ['icon' => '👤', 'color' => '#7239ea', 'bg' => '#f8f5ff'],
                        'documents'  => ['icon' => '📄', 'color' => '#ffc700', 'bg' => '#fff8dd'],
                        'calendar'   => ['icon' => '📅', 'color' => '#f1416c', 'bg' => '#fff5f8'],
                        'projects'   => ['icon' => '📁', 'color' => '#00a3ff', 'bg' => '#f1faff'],
                    ];
                    $iconInfo = $iconMap[$fKey] ?? ['icon' => '⚙️', 'color' => '#009ef7', 'bg' => '#f1faff'];
                    ?>
                    <div style="width:56px;height:56px;background:<?= $iconInfo['bg'] ?>;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:28px;margin-right:16px;">
                        <?= $iconInfo['icon'] ?>
                    </div>
                    <div>
                        <h4 class="fw-bolder text-gray-800 mb-1"><?= htmlspecialchars($feature['feature_label']) ?></h4>
                        <span class="badge badge-light-success fs-8">Enabled</span>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <span class="text-primary fw-bold fs-7">Open →</span>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
</div>
<!--end::Features Grid-->

<!--begin::Activity Timeline (from Metronic List Widget 5 in index.html)-->
<div class="card">
    <div class="card-header border-0">
        <h3 class="card-title fw-bolder text-dark">Your Enabled Features</h3>
    </div>
    <div class="card-body pt-2">
        <div class="timeline-label">
            <?php foreach ($features as $fKey => $feature): ?>
            <div class="timeline-item">
                <div class="timeline-label fw-bolder text-gray-800 fs-6">✅</div>
                <div class="timeline-badge">
                    <i class="fa fa-genderless text-success fs-1"></i>
                </div>
                <div class="fw-mormal timeline-content text-gray-700 ps-3">
                    <strong><?= htmlspecialchars($feature['feature_label']) ?></strong> —
                    <a href="<?= BASE_URL . $feature['feature_route'] ?>" class="text-primary">
                        Click to access
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!--end::Activity Timeline-->
<?php endif; ?>
