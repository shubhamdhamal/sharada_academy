<?php
namespace App\Controllers;
use App\Controllers\My_Controller;
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
class Autoscript extends My_Controller {
    function __construct() {
        parent::__construct();
    }
    public function index() {
        echo 'invalid requiest';
    }
    public function webhook($type='') {
        echo 'invalid requiest';
    }
}