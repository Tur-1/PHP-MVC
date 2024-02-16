<?php import('layouts.Header'); ?>
<main class=" mt-4 mb-2">
    <div class="container">

        <div class="row mb-3">
            <div class="d-flex align-items-center justify-content-between">
                <h1>Create</h1>
            </div>
        </div>

        <form class="row g-3" action="<?php echo route('usersStore') ?>" method="post">
            <?php echo csrf_token() ?>
            <div class="mb-2">
                <label for="FormControlInput1" class="form-label">Name</label>
                <input value="<?= old('name') ?>" type="text" class="form-control <?= errors()->has('name') ? 'is-invalid' : '' ?>" name="name" id="FormControlInput1" placeholder="name">
                <div id="FormControlInput1" class="invalid-feedback">
                    <?= errors()->first('name') ?>
                </div>
            </div>
            <div class="mb-2">
                <label for="formControlInput2" class="form-label">Email address</label>
                <input value="<?= old('email') ?>" type="email" class="form-control <?= errors()->has('email') ? 'is-invalid' : '' ?>" name="email" id="formControlInput2" placeholder="email">
                <div id="formControlInput2" class="invalid-feedback">
                    <?= errors()->first('email') ?>
                </div>

            </div>
            <div class="mb-2">
                <label for="formControlInputPassword2" class="form-label">Password</label>
                <input type="password" class="form-control <?= errors()->has('password') ? 'is-invalid' : '' ?>" name="password" id="formControlInputPassword2" />
                <div id="formControlInputPassword2" class="invalid-feedback">
                    <?= errors()->first('password') ?>
                </div>
            </div>

            <div class="mb-2">
                <label for="password_confirmation" class="form-label">password confirmation</label>
                <input type="password" class="form-control <?= errors()->has('password_confirmation') ? 'is-invalid' : '' ?>" name="password_confirmation" id="password_confirmation">
                <div id="password_confirmation" class="invalid-feedback">
                    <?= errors()->first('password_confirmation') ?>
                </div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Save </button>
            </div>
        </form>
    </div>
</main>

<?php import('layouts.Footer'); ?>