# Project Setup

This document briefly describes the necessary steps required before you can successfully run the project for further development.

## PHP

You should have PHP installed first. I can't help much with that but I have found [this link](https://www.jeffgeerling.com/blog/2018/installing-php-7-and-composer-on-windows-10) which explains how to do it for Windows 10 step by step. For Mac, I've no idea but it shouldn't be as hard as it's UNIX based.

## Database Setup

This document presupposes that you already have the MySQL server up and running on your development system and have an administrative user set up. If that's yet to be done, please refer to [this link](https://dev.mysql.com/doc/mysql/en/windows-installation.html).

- Log in to your MySQL server.
- Once connected and in the shell type the following:

```
CREATE DATABASE sd_project;
CREATE USER 'sd_project'@'localhost' IDENTIFIED BY 'SimplePass18';
GRANT ALL PRIVILEGES ON sd_project . * TO 'sd_project'@'localhost';
FLUSH PRIVILEGES;
```

- You are now ready to load the schema for the project. 
- Change to the root directory for the project where the shema.sql file is located or get it straight from [here](https://github.com/smassy/sysdev/raw/master/schema.sql).
- Log in as user sd_project using the password SimplePass18
- Type:

```
source schema.sql;
```

- Hopefully, there were no errors. To confirm that all is well do:

```
SHOW TABLES;
DESCRIBE items;
```

## GIT

Project management will be done through git so you must create a git account; I believe there is a dedicated Windows client if you like, but you can also stick with the web interface. Please notify me once that is done and I will add you as collaborator to the repository.

In order to work on the project, you will need to clone it on your drive.

Some basic rules for working on the project:

- Create a branch bearing your name and push all your changes to it. 
- If you like, you can create more than one branch, just affix something to your name, for example, you might have a branch *Aswin_login* and another *Aswin_dashboard_validation*.
- Nothing stops you from collaborating on something in the same branch: for example, Aswin can start the login page but someone else could push changes to that branch as well.
- Once you think that something is ready to be part of the project and used by all, please tell me and I will merge it into *master*.
- Once your branch is merged, I suggest you delete it and start afresh to ensure you're always working with the latest code from *master*.
- **IMPORTANT** Do **NOT** push your changes into *master* and let me merge your branch. I've had nasty experiences in the past where commits got burried because of that.

