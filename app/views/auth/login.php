<!--begin::Main (from Metronic authentication/flows/basic/sign-in.html)-->
<div class="d-flex flex-column flex-root">
    <div class="d-flex flex-column flex-column-fluid bgi-position-y-bottom position-x-center bgi-no-repeat bgi-size-contain bgi-attachment-fixed"
        style="background-color: #f5f8fa;">

        <style>
            .password-input-group {
                position: relative;
            }

            .password-input-group input {
                padding-right: 45px !important;
            }

            .password-toggle-btn {
                position: absolute;
                right: 0;
                top: 0;
                height: 100%;
                width: 45px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                z-index: 10;
                color: #a1a5b7;
                user-select: none;
                font-size: 1.2rem;
            }

            .password-toggle-btn:hover {
                color: #009ef7;
            }
        </style>
        <div class="d-flex flex-center flex-column flex-column-fluid p-10 pb-lg-20">

            <!-- Logo -->
            <a href="<?= BASE_URL?>/" class="mb-12">
                <img alt="Logo" src="<?= BASE_URL?>/assets/media/logos/logo-1.svg" class="h-45px" />
            </a>

            <!--begin::Wrapper-->
            <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">

                <!--begin::Form (from Metronic sign-in.html)-->
                <form class="form w-100" method="POST" action="<?= BASE_URL?>/login">

                    <!--begin::Heading-->
                    <div class="text-center mb-10">
                        <h1 class="text-dark mb-3">Sign In to Admin / App</h1>
                        <div class="text-gray-400 fw-bold fs-4">
                            New here?
                            <a href="<?= BASE_URL?>/register" class="link-primary fw-bolder">Create an Account</a>
                        </div>
                    </div>
                    <!--end::Heading-->

                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                        <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">❌</span>
                        <div class="d-flex flex-column">
                            <span>
                                <?= htmlspecialchars($error)?>
                            </span>
                        </div>
                    </div>
                    <?php
endif; ?>

                    <?php if (!empty($success)): ?>
                    <div class="alert alert-success d-flex align-items-center p-5 mb-10">
                        <span class="me-4">✅</span>
                        <div>
                            <?= htmlspecialchars($success)?>
                        </div>
                    </div>
                    <?php
endif; ?>

                    <!--begin::Input group (Email)-->
                    <div class="fv-row mb-10">
                        <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                        <input class="form-control form-control-lg form-control-solid" type="email" name="email"
                            autocomplete="off" value="<?= htmlspecialchars($_POST['email'] ?? '')?>"
                            placeholder="email@example.com" required />
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group (Password)-->
                    <div class="fv-row mb-10">
                        <div class="d-flex flex-stack mb-2">
                            <label class="form-label fw-bolder text-dark fs-6 mb-0">Password</label>
                        </div>
                        <div class="password-input-group">
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password" autocomplete="off" placeholder="••••••••" required />
                            <span class="password-toggle-btn">👁️‍🗨️</span>
                        </div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                            <span class="indicator-label">Sign In</span>
                        </button>
                    </div>
                    <!--end::Actions-->

                    <div class="text-center mt-4">
                        <div class="text-gray-500 fw-bold fs-6">
                            <strong>Admin:</strong> admin@admin.com / password<br>
                            <strong>User:</strong> Register a new account
                        </div>
                    </div>

                </form>
                <!--end::Form-->
            </div>
            <!--end::Wrapper-->
        </div>
    </div>
    <script>
        (function () {
            document.addEventListener('click', function (e) {
                const toggleBtn = e.target.closest('.password-toggle-btn');
                if (!toggleBtn) return;

                e.preventDefault();
                const inputGroup = toggleBtn.closest('.password-input-group');
                const input = inputGroup ? inputGroup.querySelector('input') : null;

                if (input) {
                    if (input.type === 'password') {
                        input.type = 'text';
                        toggleBtn.innerHTML = '👁️'; // Open eye
                    } else {
                        input.type = 'password';
                        toggleBtn.innerHTML = '👁️‍🗨️'; // Using glasses as 'hidden' fallback or mixed
                    }
                }
            });
        })();
    </script>
</div>
<!--end::Main-->