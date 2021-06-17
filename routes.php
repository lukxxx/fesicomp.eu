<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/router.php");

//---------------WEB PAGE ROUTES-----------------------

get('/', 'template/index.php');

get('/o-nas', 'src/new.php');

get('/kontakt', 'template/contact.php');

get('/prihlasenie', 'template/login.php');

get('/moj-ucet', 'template/myaccount.php');

get('/kosik', 'template/cart.php');

get('/addcart', 'add-cart.php');

get('/deletecart', 'delete-cart.php');

get('/updatecart', 'update-cart.php');

get('/vyhladavanie','template/search-results.php');

get('/handler','includes/handler.php');

get('/srengine','template/search-engine.php');

get('/skript', 'script.php');

//---------------ITEMS AND CATEGORIES ROUTES-----------------------

get('/$id', 'template/item.php');

get('/kategoria/$kategorka', 'template/category.php');

//---------------ASSETS ROUTES--------------------------

//---------------ADMIN ROUTES--------------------------

get('/dash', 'admin/index.php');

any('/404','404.php');
