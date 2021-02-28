CREATE TABLE faktury (
    id int(11) AUTO_INCREMENT,
    id_zakaznika int(11),
   	meno VARCHAR(255) NOT NULL,
    priezvisko VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefon VARCHAR(20) NOT NULL,
    zaplatene tinyint(1),
    vybavene tinyint(1),
	zlava int(11)
    )