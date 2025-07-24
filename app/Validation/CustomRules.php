<?php
namespace App\Validation;
use google\recaptcha;
class CustomRules{
  public function recaptchaValidation(string $response, string $field, array $data) {
    $details = app_setting('captcha_details');
    $details = json_decode($details);
    
    $recaptcha = new \ReCaptcha\ReCaptcha($details->secret);
    $resp = $recaptcha->verify($response, $_SERVER['REMOTE_ADDR']);
    if (!$resp->isSuccess()) {
      $validation = \Config\Services::validation();
      $validation->setError($field,translate('invalid_captcha'));
    }
    return true;
  }
  public function captchaValidation(string $response, string $field, array $data) {
    $session = session();
    $string = $session->get($field);
    if($response==$string){
      $session->remove($field);
    }else{
      $validation = \Config\Services::validation();
      $validation->setError($field,translate('invalid_captcha'));
    }
    return true;
  }
}