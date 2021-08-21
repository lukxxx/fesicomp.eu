<?php

require_once("{$_SERVER['DOCUMENT_ROOT']}/fesicomp.eu/router.php");

//---------------WEB PAGE ROUTES-----------------------

get('/fesicomp.eu', 'template/index.php');

get('/fesicomp.eu/o-nas', 'template/about.php');

get('/fesicomp.eu/kontakt', 'template/contact.php');

post('/fesicomp.eu/kontakt', 'template/contact.php');

get('/fesicomp.eu/prihlasenie', 'template/login.php');

post('/fesicomp.eu/prihlasenie', 'template/login.php');

get('/fesicomp.eu/registracia', 'template/register.php');

post('/fesicomp.eu/registracia', 'template/register.php');

get('/fesicomp.eu/moj-ucet', 'template/myaccount.php');
post('/fesicomp.eu/moj-ucet', 'template/myaccount.php');

get('/fesicomp.eu/kosik', 'template/cart.php');

get('/fesicomp.eu/mobile', 'includes/like.php');

get('/fesicomp.eu/kosik/dorucovacie-udaje', 'template/data.php');

post('/fesicomp.eu/kosik/dorucovacie-udaje', 'template/data.php');

get('/fesicomp.eu/kosik/doprava-platba', 'template/final.php');

post('/fesicomp.eu/kosik/doprava-platba', 'template/final.php');

post('/fesicomp.eu/kosik/suhrn-objednavky', 'template/summary.php');

get('/fesicomp.eu/addcart', 'add-cart.php');
post('/fesicomp.eu/addcart', 'add-cart.php');

get('/fesicomp.eu/deletecart', 'delete-cart.php');
post('/fesicomp.eu/deletecart', 'delete-cart.php');

get('/fesicomp.eu/updatecart', 'update-cart.php');

get('/fesicomp.eu/vyhladavanie','template/search-results.php');
post('/fesicomp.eu/vyhladavanie','template/search-results.php');

get('/fesicomp.eu/handler','includes/handler.php');

get('/fesicomp.eu/srengine','template/search-engine.php');

get('/fesicomp.eu/skript', 'script.php');

get('/fesicomp.eu/echo', 'echo.php');

get('/fesicomp.eu/redirect', 'template/redirect.php');

post('/fesicomp.eu/redirect', 'template/redirect.php');

post('/fesicomp.eu/updateuser', 'template/user-info-update.php');

//---------------ADMIN ROUTES--------------------------

get('/fesicomp.eu/admin', 'admin/index.php');

post('/fesicomp.eu/admin', 'admin/index.php');

get('/fesicomp.eu/admin/dashboard', 'admin/dashboard/index.php');

//---------------ITEMS AND CATEGORIES ROUTES-----------------------



//---------------404 ROUTE--------------------------

get('/fesicomp.eu/kategoria/$kategorka', 'template/category.php');
get('/fesicomp.eu/produkt/$id', 'template/item.php');
any('/fesicomp.eu/404','404.php');



