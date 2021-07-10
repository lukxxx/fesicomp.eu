<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

//---------------WEB PAGE ROUTES-----------------------

get('/', 'template/index.php');

get('/o-nas', 'src/new.php');

get('/kontakt', 'template/contact.php');

get('/prihlasenie', 'template/login.php');

get('/moj-ucet', 'template/myaccount.php');

get('/kosik', 'template/cart.php');

get('/kosik/dorucovacie-udaje', 'template/data.php');

post('/kosik/dorucovacie-udaje', 'template/data.php');

get('/kosik/doprava-platba', 'template/final.php');

post('/kosik/doprava-platba', 'template/final.php');

post('/suhrn-objednavky', 'template/success.php');

get('/addcart', 'add-cart.php');

get('/deletecart', 'delete-cart.php');

get('/updatecart', 'update-cart.php');

get('/vyhladavanie','template/search-results.php');

get('/handler','includes/handler.php');

get('/srengine','template/search-engine.php');

get('/skript', 'script.php');

//---------------ADMIN ROUTES--------------------------

get('/admin', 'admin/index.php');

post('/admin', 'admin/index.php');

get('/admin/dashboard', 'admin/dashboard/index.php');

//---------------ITEMS AND CATEGORIES ROUTES-----------------------



//---------------404 ROUTE--------------------------



get('/kategoria/$kategorka', 'template/category.php');
any('/404','404.php');
get('/$id', 'template/item.php');

