<!--begin::Projects (from Metronic pages/projects/list.html pattern)-->
<div class="card">
    <div class="card-header border-0 pt-6">
        <h3 class="card-title fw-bolder">My Projects</h3>
    </div>
    <div class="card-body">
        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6 mb-8">
            <span class="me-4">📁</span>
            <div class="fw-bold">
                <h4 class="text-gray-900 fw-bolder">Projects Access Enabled</h4>
                <div class="fs-6 text-gray-700">View and manage your assigned projects below.</div>
            </div>
        </div>

        <div class="row g-6">
            <?php
            $projects = [
                ['name' => 'Website Redesign',     'progress' => 75, 'color' => 'primary',  'status' => 'In Progress', 'team' => 3],
                ['name' => 'Mobile App Dev',        'progress' => 40, 'color' => 'success',  'status' => 'On Track',    'team' => 5],
                ['name' => 'API Integration',       'progress' => 90, 'color' => 'warning',  'status' => 'Review',      'team' => 2],
                ['name' => 'Database Migration',    'progress' => 20, 'color' => 'danger',   'status' => 'Planning',    'team' => 4],
                ['name' => 'UI Component Library',  'progress' => 60, 'color' => 'info',     'status' => 'In Progress', 'team' => 2],
                ['name' => 'Security Audit',        'progress' => 100,'color' => 'success',  'status' => 'Completed',   'team' => 1],
            ];
            foreach ($projects as $project):
            ?>
            <div class="col-md-6 col-xl-4">
                <div class="card border border-dashed border-gray-300 h-100">
                    <div class="card-body p-6">
                        <div class="d-flex align-items-start justify-content-between mb-5">
                            <div class="d-flex flex-column">
                                <a href="#" class="text-gray-800 text-hover-primary fs-4 fw-bolder">
                                    <?= $project['name'] ?>
                                </a>
                                <span class="badge badge-light-<?= $project['color'] ?> mt-2 w-fit">
                                    <?= $project['status'] ?>
                                </span>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap mb-5">
                            <div class="border border-gray-200 rounded py-2 px-3 me-4 mb-3">
                                <span class="text-muted fs-7">Team: </span>
                                <span class="fw-bold fs-7"><?= $project['team'] ?> members</span>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="d-flex flex-stack mb-2">
                                <span class="text-muted me-2 fs-7 fw-bold">Progress</span>
                                <span class="text-muted fs-7 fw-bold"><?= $project['progress'] ?>%</span>
                            </div>
                            <div class="progress h-8px">
                                <div class="progress-bar bg-<?= $project['color'] ?>"
                                     role="progressbar"
                                     style="width: <?= $project['progress'] ?>%"
                                     aria-valuenow="<?= $project['progress'] ?>"
                                     aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!--end::Projects-->
