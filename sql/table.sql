CREATE table IF NOT EXISTS categories(
    id INTEGER AUTO_INCREMENT,
    PRIMARY KEY (id),
    label varchar(255),
    created DATETIME DEFAULT CURRENT_TIMESTAMP
);

TRUNCATE TABLE categories;
INSERT INTO categories (label) VALUES ('LIFESTYLE');
INSERT INTO categories (label) VALUES ('TECHNOLOGY');
INSERT INTO categories (label) VALUES ('SPORTS');
INSERT INTO categories (label) VALUES ('BUSINESS');
INSERT INTO categories (label) VALUES ('HEALTH');


CREATE table IF NOT EXISTS members(
    id INTEGER AUTO_INCREMENT,
    PRIMARY KEY (id),
    username varchar(255),
    passname varchar(255),
    aboutme text DEFAULT NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE table IF NOT EXISTS blog(
    id INTEGER AUTO_INCREMENT,
    PRIMARY KEY (id),
    title varchar(255) NOT NULL,
    content text NOT NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP,
    published integer DEFAULT 0,
    categoryid integer NOT NULL,
    thumbnail varchar(255) DEFAULT NULL
);

CREATE table IF NOT EXISTS blog_claps(
    id INTEGER AUTO_INCREMENT,
    PRIMARY KEY (id),
    memberId integer,
    blogId integer,
    created DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS blog_comments(
    id INTEGER AUTO_INCREMENT,
    PRIMARY KEY(id),
    value text NOT NULL,
    blogId integer NOT NULL,
    memberId integer NOT NULL,
    created DATETIME DEFAULT CURRENT_TIMESTAMP
)
