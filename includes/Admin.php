<?php

namespace UserRegistration;

class Admin {
    public function __construct() {
        new Admin\Menu();
        new Admin\Ajax();
    }
}