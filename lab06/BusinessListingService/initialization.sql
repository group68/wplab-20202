CREATE TABLE Businesses(
	BusinessID INT AUTO_INCREMENT PRIMARY KEY,
    NAME varchar(30),
    Address varchar(30),
    City varchar(20),
    Telephone varchar(10),
    URL varchar(30)
);

CREATE TABLE Categories(
    CategoryID varchar(20) PRIMARY KEY,
    Title varchar(30),
    Description varchar(50)
);

CREATE TABLE Biz_Categories(
    BusinessID INT,
    CategoryID varchar(20),
    CONSTRAINT pk_biz PRIMARY KEY (BusinessID,CategoryID),
    CONSTRAINT fk_biz_busi FOREIGN KEY (BusinessID) REFERENCES Businesses(BusinessID),
    CONSTRAINT fk_biz_cat FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID)
);