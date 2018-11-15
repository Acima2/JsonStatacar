DROP USER IF EXISTS db_user@localhost;
GRANT ALL PRIVILEGES ON *.* TO 'db_user'@'localhost' IDENTIFIED BY 'db_password';
