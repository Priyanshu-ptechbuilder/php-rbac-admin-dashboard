<!--begin::Main-->
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
            <a href="<?= BASE_URL?>/" class="mb-12">
                <img alt="Logo" src="<?= BASE_URL?>/assets/media/logos/logo-1.svg" class="h-45px" />
            </a>

            <div class="w-lg-550px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
                <form class="form w-100" method="POST" action="<?= BASE_URL?>/register">
                    <div class="mb-10 text-center">
                        <h1 class="text-dark mb-3">Create an Account</h1>
                        <div class="text-gray-400 fw-bold fs-4">
                            Already have an account?
                            <a href="<?= BASE_URL?>/login" class="link-primary fw-bolder">Sign in here</a>
                        </div>
                    </div>

                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger d-flex align-items-center p-5 mb-8">
                        <span class="me-4">❌</span>
                        <div>
                            <?= htmlspecialchars($error)?>
                        </div>
                    </div>
                    <?php
endif; ?>

                    <?php if (!empty($success)): ?>
                    <div class="alert alert-success d-flex align-items-center p-5 mb-8">
                        <span class="me-4">✅</span>
                        <div>
                            <?= htmlspecialchars($success)?>
                            <a href="<?= BASE_URL?>/login" class="fw-bold">Click here to login</a>
                        </div>
                    </div>
                    <?php
endif; ?>

                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6">Full Name</label>
                        <input class="form-control form-control-lg form-control-solid" type="text" name="name"
                            placeholder="Your full name" value="<?= htmlspecialchars($_POST['name'] ?? '')?>"
                            required />
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6">Email</label>
                        <input class="form-control form-control-lg form-control-solid" type="email" name="email"
                            placeholder="email@example.com" value="<?= htmlspecialchars($_POST['email'] ?? '')?>"
                            required />
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6">Password</label>
                        <div class="password-input-group">
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="password" placeholder="Min. 6 characters" required />
                            <span class="password-toggle-btn">👁️‍🗨️</span>
                        </div>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="form-label fw-bolder text-dark fs-6">Confirm Password</label>
                        <div class="password-input-group">
                            <input class="form-control form-control-lg form-control-solid" type="password"
                                name="confirm_password" placeholder="Repeat password" required />
                            <span class="password-toggle-btn">👁️‍🗨️</span>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-lg btn-primary w-100 mb-5">
                            Create Account
                        </button>
                    </div>
                </form>
            </div>
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