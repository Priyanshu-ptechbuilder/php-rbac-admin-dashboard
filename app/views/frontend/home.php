<!--begin::Public Home Page-->
<div class="d-flex flex-column flex-root" style="min-height:100vh;background:linear-gradient(135deg,#1e1e2d 0%,#1b1b29 60%,#009ef7 100%);">
    <div class="d-flex flex-center flex-column flex-column-fluid" style="min-height:100vh;padding:40px;">

        <div class="text-center mb-12">
            <img alt="Logo" src="<?= BASE_URL ?>/assets/media/logos/logo-landing.svg" class="h-60px" />
            <p class="text-white opacity-75 fs-3 mt-4">Built with Core PHP MVC + Metronic Theme</p>
        </div>

        <div class="d-flex gap-4 flex-wrap justify-content-center mb-12">
            <a href="<?= BASE_URL ?>/login" class="btn btn-primary btn-lg px-10 py-4 fs-5 fw-bolder">
                🔐 Sign In
            </a>
            <a href="<?= BASE_URL ?>/register" class="btn btn-light btn-lg px-10 py-4 fs-5 fw-bolder">
                📝 Register
            </a>
        </div>

        <div class="row g-5 justify-content-center" style="max-width:900px;width:100%;">
            <div class="col-md-4">
                <div class="card text-center p-6" style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);">
                    <div style="font-size:40px;">🎨</div>
                    <h4 class="text-white mt-4">Metronic Theme</h4>
                    <p class="text-white opacity-50">Premium Bootstrap 5 admin template</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center p-6" style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);">
                    <div style="font-size:40px;">🏗️</div>
                    <h4 class="text-white mt-4">MVC Architecture</h4>
                    <p class="text-white opacity-50">Clean Core PHP OOP structure</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center p-6" style="background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.1);">
                    <div style="font-size:40px;">🔒</div>
                    <h4 class="text-white mt-4">Role-Based Access</h4>
                    <p class="text-white opacity-50">Admin & user panels separated</p>
                </div>
            </div>
        </div>

        <div class="mt-10 text-center">
            <p class="text-white opacity-40 fs-7">
                Admin panel at <code style="color:#00d4ff;">/admin</code> |
                Default admin: <code style="color:#00d4ff;">admin@admin.com</code>
            </p>
        </div>

    </div>
</div>
<!--end::Public Home Page-->
