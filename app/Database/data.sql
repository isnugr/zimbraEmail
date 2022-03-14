--
-- `#prefix#product_configuration`
--
CREATE TABLE IF NOT EXISTS `#prefix#product_configuration` (
    `id`                        INT(11)         NOT NULL AUTO_INCREMENT,
    `product_id`                INT(11)         NOT NULL,
    `setting`                   TEXT            NOT NULL,
    `value`                     TEXT            NULL,
    PRIMARY KEY (id)
    )   ENGINE=InnoDB           DEFAULT
        CHARSET=#charset#       DEFAULT     COLLATE #collation#;