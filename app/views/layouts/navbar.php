<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="#"><?= config('app.name'); ?> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= request()->is(route('homePage')) ? 'active  border rounded' : '' ?>" aria-current="page" href="<?= route('homePage') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= request()->is(route('aboutPage')) ? 'active  border rounded' : '' ?>" aria-current="page" href="<?= route('aboutPage') ?>">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= request()->is(route('users.list') . '*') ? 'active  border rounded' : '' ?>" aria-current="page" href="<?= route('users.list') ?>">Users</a>
                </li>

            </ul>
        </div>
    </div>
</nav>