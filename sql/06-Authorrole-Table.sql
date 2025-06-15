CREATE TABLE authorrole (
authorid INT NOT NULL,
roleid VARCHAR(255) NOT NULL,
PRIMARY KEY (authorid, roleid)
) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB

role-based access control:Page 286