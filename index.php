<?php
// First include our class, we choose the direct file over an auto loader because we are
// Simply loading one file.

include './lib/template.php';
// I do this because I don't want to call Template\Template every time, so we just state it here.
use Template\Template;

// Create a new instance of Template
$template = new Template();

$template->assign('hello', 'Hej');
$template->assign('name', 'Lasse');

$template->parseFile('./_partials/template.html');