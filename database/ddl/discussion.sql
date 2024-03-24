CREATE TABLE users{
    userId          INT IDENTITY
    firstName       VARCHAR(40),
    lastName        VARCHAR(40),
    email           VARCHAR(50),
    dob             DATE,
    username        VARCHAR(50),
    password        VARCHAR(30),
    profile_photo    VARBINARY(MAX)
   

}

CREATE TABLE 