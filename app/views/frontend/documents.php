<!--begin::Documents (from Metronic pages/profile/documents.html pattern)-->
<div class="card">
    <div class="card-header border-0 pt-6">
        <h3 class="card-title fw-bolder">Document Library</h3>
    </div>
    <div class="card-body">
        <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6 mb-8">
            <span class="me-4">📁</span>
            <div class="fw-bold">
                <h4 class="text-gray-900 fw-bolder">Document Access Enabled</h4>
                <div class="fs-6 text-gray-700">You have permission to access the document library.</div>
            </div>
        </div>
        <div class="row g-5">
            <?php
            $docs = [
                ['name' => 'Project Guidelines.pdf', 'size' => '2.4 MB', 'icon' => '📄', 'color' => '#f1416c'],
                ['name' => 'User Manual.docx',       'size' => '1.1 MB', 'icon' => '📝', 'color' => '#009ef7'],
                ['name' => 'Budget 2024.xlsx',       'size' => '854 KB', 'icon' => '📊', 'color' => '#50cd89'],
                ['name' => 'Meeting Notes.txt',      'size' => '12 KB',  'icon' => '📋', 'color' => '#ffc700'],
            ];
            foreach ($docs as $doc):
            ?>
            <div class="col-md-6">
                <div class="d-flex align-items-center border border-dashed border-gray-300 rounded p-5">
                    <div style="font-size:32px;margin-right:16px;"><?= $doc['icon'] ?></div>
                    <div class="flex-grow-1">
                        <div class="fw-bold fs-6"><?= $doc['name'] ?></div>
                        <div class="text-muted fs-7"><?= $doc['size'] ?></div>
                    </div>
                    <a href="#" class="btn btn-sm btn-light">Download</a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!--end::Documents-->
