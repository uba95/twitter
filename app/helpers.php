<?php

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

function current_user() {

    return auth()->user();
}

function localRoute($routeName)
{
    return LaravelLocalization::localizeURL($routeName);
}
