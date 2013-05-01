PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE "categories" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "name" TEXT NOT NULL
    );
CREATE TABLE "departments" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "name" TEXT NOT NULL,
    "establish_date" INTEGER,
    "obsolete_date" INTEGER
    );
CREATE TABLE "courses" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "name" TEXT NOT NULL,
    "establish_date" INTEGER,
    "obsolete_date" INTEGER,
    "attached_department_id" INTEGER NOT NULL
    );
CREATE TABLE "users" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "credentials" TEXT NOT NULL,
    "name" TEXT NOT NULL,
    "description" TEXT NOT NULL
    );
CREATE TABLE "schedules" (
    "id" INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    "category_id" INTEGER NOT NULL,
    "title" TEXT NOT NULL,
    "invoke_time" INTEGER NOT NULL,
    "time_span" INTEGER NOT NULL,
    "content" TEXT NOT NULL,
    "register_user_id" INTEGER NOT NULL,
    "assigned_user_id" INTEGER NOT NULL,
    "course_id" INTEGER NOT NULL,
    "grade" INTEGER NOT NULL
    );
COMMIT;
.mode tabs
.import users.tsv users
.import categories.tsv categories
.import departments.tsv departments
.import courses.tsv courses
.import schedules.tsv schedules
