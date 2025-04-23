CREATE TABLE IF NOT EXISTS cardProjet(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    titre varchar(255) not null,
    description varchar(255) not null,
    lien_git varchar(255) not null default 'aucun',
    lien_web varchar(255) not null default 'aucun'
);
CREATE TABLE IF NOT EXISTS techno(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom varchar(255) not null,
    image varchar(255) not null,
    id_projet INTEGER ,
    CONSTRAINT  fk_projet
        FOREIGN KEY (id_projet)
            REFERENCES cardProjet (id)
            ON DELETE CASCADE
            ON UPDATE RESTRICT
);