CREATE TABLE IF NOT EXISTS cardProjet(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titre varchar(50) not null,
    description varchar(255) not null,
    lien_git varchar(50) default NULL,
    lien_web varchar(50) default NULL,
    nom_depot_git varchar(50)default NULL
);
CREATE TABLE IF NOT EXISTS techno(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom varchar(50) not null,
    image varchar(50) not null
);
CREATE TABLE IF NOT EXISTS cardProjet_techno(
    id_cardProjet INTEGER  ,
    id_techno INTEGER ,
    PRIMARY KEY (id_cardProjet, id_techno),
    CONSTRAINT  fk_projet
        FOREIGN KEY (id_cardProjet)
        REFERENCES cardProjet (id)
        ON DELETE CASCADE
        ON UPDATE RESTRICT,
    CONSTRAINT  fk_techno
        FOREIGN KEY (id_techno)
        REFERENCES techno (id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT
);
CREATE TABLE IF NOT EXISTS skills(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom varchar(50) not null,
    icon varchar(50) ,
    description varchar(255) not null,
    exemple varchar(255) ,
    skill varchar(50) not null
)