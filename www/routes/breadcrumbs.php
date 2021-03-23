<?php


Breadcrumbs::for('welcome', function ($trail) {
    $trail->push('Welcome');
});

Breadcrumbs::for('login', function ($trail) {
    $trail->parent('welcome');
    $trail->push('Login', route('login'));
});

Breadcrumbs::for('home.admin.index', function ($trail) {
    $trail->parent('welcome');
    $trail->push('Admin Dashboard', route('home.admin.index'));
});
