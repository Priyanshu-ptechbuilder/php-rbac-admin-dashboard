<!--begin::Calendar-->
<div class="card">
    <div class="card-header border-0 pt-6">
        <h3 class="card-title fw-bolder">My Calendar</h3>
    </div>
    <div class="card-body">
        <div class="notice d-flex bg-light-success rounded border-success border border-dashed p-6 mb-6">
            <span class="me-4">📅</span>
            <div class="fw-bold">
                <h4 class="text-gray-900 fw-bolder">Calendar Access Enabled</h4>
                <div class="fs-6 text-gray-700">You can view and manage your calendar events.</div>
            </div>
        </div>
        <div class="row g-4">
            <?php
            $events = [
                ['date' => 'Mon, Dec 16', 'title' => 'Team Meeting',          'time' => '10:00 AM', 'color' => 'primary'],
                ['date' => 'Tue, Dec 17', 'title' => 'Project Review',        'time' => '2:00 PM',  'color' => 'success'],
                ['date' => 'Wed, Dec 18', 'title' => 'Client Call',           'time' => '11:30 AM', 'color' => 'warning'],
                ['date' => 'Thu, Dec 19', 'title' => 'Sprint Planning',       'time' => '9:00 AM',  'color' => 'danger'],
                ['date' => 'Fri, Dec 20', 'title' => 'End of Week Standup',   'time' => '4:00 PM',  'color' => 'info'],
            ];
            foreach ($events as $event):
            ?>
            <div class="col-md-6">
                <div class="d-flex align-items-center bg-light-<?= $event['color'] ?> rounded p-5">
                    <div class="bullet bullet-vertical h-40px bg-<?= $event['color'] ?> me-5"></div>
                    <div class="flex-grow-1">
                        <a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-6"><?= $event['title'] ?></a>
                        <span class="text-muted fw-bold d-block fs-7"><?= $event['date'] ?> · <?= $event['time'] ?></span>
                    </div>
                    <span class="badge badge-light-<?= $event['color'] ?>"><?= $event['time'] ?></span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!--end::Calendar-->
