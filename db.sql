CREATE TABLE SummerPractice2users (
    id int(10) unsigned NOT NULL AUTO_INCREMENT,
    name varchar(255) NOT NULL,
    login varchar(255) NOT NULL,
    email varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    role INT NOT NULL DEFAULT 0,
    PRIMARY KEY (id)
) ENGINE=InnoDB;

INSERT INTO SummerPractice2users (name, login, email, password) VALUES ('StereoZing', 'stereozing', 'stereozing@gmail.com', '123456');
INSERT INTO SummerPractice2users (name, login, email, password, role) VALUES ('Company', 'company', 'company@gmail.com', 'company', 1);
INSERT INTO SummerPractice2users (name, login, email, password, role) VALUES ('Admin', 'admin', 'admin@gmail.com', 'admin', 2);

CREATE TABLE SummerPractice2cards (
    id int(10) unsigned NOT NULL AUTO_INCREMENT,
    adress varchar(255) charset utf8mb4 NOT NULL,
    year int(10) unsigned NOT NULL,
    type varchar(255) charset utf8mb4 NOT NULL,
    size varchar(255) charset utf8mb4 NOT NULL,
    price int(10) unsigned NOT NULL,
    company varchar(255) charset utf8mb4 NOT NULL,
    worktime varchar(255) charset utf8mb4 NOT NULL,
    description varchar(255) charset utf8mb4,
    picture varchar(255) charset utf8mb4,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO SummerPractice2cards (adress, year, type, size, price, company, worktime, description, picture) VALUES ('Сормовская 4а', 2014, 'стадион', '120 × 75', 78000, 'ООО «Фокус»', 'вс - чт, 9:00 - 21:00', 'Вход через красные ворота', 'photo1.jpg');
INSERT INTO SummerPractice2cards (adress, year, type, size, price, company, worktime, description, picture) VALUES ('Просп. Чекистов, 27', 2017, 'стадион', '100 × 65', 12000, 'ООО «Антик»', 'без выходных, 11:00 - 1:00', 'Калитка находится с северной части поля', 'photo2.jpg');
INSERT INTO SummerPractice2cards (adress, year, type, size, price, company, worktime, description, picture) VALUES ('Янковского, 24', 2006, 'баскетбольная площадка', '30 × 8', 1900, 'ООО «Спорт без Преград»', 'вс - чт, 9:00 - 21:00', 'Зал номер 207', 'photo3.jpg');
INSERT INTO SummerPractice2cards (adress, year, type, size, price, company, worktime, description, picture) VALUES ('Кирова, 41', 2021, 'бассейн', '25 × 15', 7000, 'ООО «Аквадар»', 'вт - сб, 8:00 - 20:00', 'Зелёное здание слева от входа', 'photo4.jpg');


CREATE TABLE SummerPractice2bookings (
    id int(10) unsigned NOT NULL AUTO_INCREMENT,
    card_id int(10) unsigned NOT NULL,
    user_id int(10) unsigned NOT NULL,
    time TIME NOT NULL,
    date DATE NOT NULL,
    PRIMARY KEY (id)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;