# fesicomp.eu a.k.a compsnv.sk
E-commerce riešenie na mieru pre firmu FESI COMP s.r.o

# CONFIG FILE 
Config file je fixný ako pre localhost tak aj pre live verziu, čiže tieto dve súbory nespájať, nemeniť inak nebudú fungovať cesty
V config súbore sú dve nové globálne premenné $root_dir a $root_url.
Config file sa jedine includuje v súbore head.php, ktorý sa následne na každú stránku includuje nasledovne ->

# Includovanie súboru head.php
Vzhľadom na rozdiely medzi local a live verziou shopu musíme hned na začiatku rozhodnúť s akými súbormi pracujeme preto na každú jednu
podstránku potrebujeme implementovať tento kúsok kódu:
```
if($_SERVER['DOCUMENT_ROOT'] == "C:/xampp/htdocs"){
    include $_SERVER['DOCUMENT_ROOT']."/fesicomp.eu/includes/head.php";
} else {
    include $_SERVER['DOCUMENT_ROOT']."/includes/head.php";
}
```

# $root_dir
Táto globálna premenná sa používa všade kde includujeme nejaký súbor a syntax je nasledovný:

Príklad:

```
include $root_dir."/includes/header.php"; 
```

# $root_url 
Táto globálna premenná sa používa všade kde potrebujeme definovať nejaký odkaz alebo cestu k obrázku. Syntax je nasledovný: 
```
<a href="<?php echo $root_url ?>/kategoria/meno-kategorie">Meno kategórie</a>
```

# router.php a routes.php súbory
Tieto súbory sú takisto fixné pre local a live verziu. Na servery nemeniť za žiadnu cenu! Ak treba nejakú cestu vytvoriť kontaktuj admina
