<?php
if ($this->session->userdata['user']['id'] == "") {
    header("location: ".base_url()."login");
}

if (($this->session->userdata['user']['role'] != "SUPERADMIN") && ($this->session->userdata['user']['role'] != "ADMIN")) {
    header("location: ".base_url()."login");
}
?>
