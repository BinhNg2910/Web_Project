<?php
require_once('config.php');
require_once('dbhelper.php');
// connect dbc variable to myDataBase in sql
$dbc = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);


// create table for role

$sqlRoleTable = "CREATE TABLE IF NOT EXISTS  _Role(
        id INT AUTO_INCREMENT,
        role_name varchar(20) NOT NULL,
        PRIMARY KEY(id)
    )";

$sqlRoleTable = mysqli_query($dbc,$sqlRoleTable) or die("Bad Create: $sqlRoleTable");

// insert value into role
$queryRole = "SELECT * FROM _Role";
$res_check = mysqli_query($dbc, $queryRole) or die ("Error in query: $queryRole. " . mysqli_error($dbc));
$row = mysqli_num_rows($res_check);


if($row ==0)
{
    // insert value to product table
    $sqlInsert = "INSERT INTO _Role(id, role_name) VALUES 
    (1,'Admin'),
    (2,'User') ";
    execute($sqlInsert);

}


// create table for user

$sqlUserTable = "CREATE TABLE IF NOT EXISTS  _User(
    id INT AUTO_INCREMENT, 
    username VARCHAR(64),
    email VARCHAR(64),
    pass VARCHAR(64),
    phone VARCHAR(20),
    role_id int references _Role (id),
    deleted INT,
    created_at DATETIME,
    updated_at DATETIME,
    PRIMARY KEY(id)
    )";

$resultUserTable = mysqli_query($dbc,$sqlUserTable) or die("Bad Create: $sqlUserTable");

// create table for category
$sqlCateTable = "CREATE TABLE IF NOT EXISTS  _Category(
    id INT AUTO_INCREMENT, 
    name VARCHAR(64),
    PRIMARY KEY(id)
    )";

$resultCateTable = mysqli_query($dbc,$sqlCateTable) or die("Bad Create: $sqlCateTable");

// create table for tokens
$sqlTokenTable = "CREATE TABLE IF NOT EXISTS  _Tokens(
    user_id int references _User (id),
    token varchar(32) not null,
    created_at DATETIME,
    PRIMARY KEY(user_id,token)
    )";

$resultTokenTable = mysqli_query($dbc,$sqlTokenTable) or die("Bad Create: $sqlTokenTable");

// create table for products
$sqlProductTable = "CREATE TABLE IF NOT EXISTS  _Product(
    category_id INT,
    id INT AUTO_INCREMENT, 
    title VARCHAR(350),
    price INT,
    discount INT,
    thumbnail VARCHAR(500),
    description longtext,
    created_at datetime,
    updated_at datetime,
    deleted int,
    PRIMARY KEY(id)
    )";

$resultProductTable = mysqli_query($dbc,$sqlProductTable ) or die("Bad Create: $sqlProductTable");

// create table for feedback
$sqlFeedbackTable = "CREATE TABLE IF NOT EXISTS  _Feedback(
    id INT AUTO_INCREMENT, 
    firstname VARCHAR(30),
    lastname VARCHAR(30),
    email VARCHAR(150),
    phone_number VARCHAR(20),
    subject_name VARCHAR(200),
    note VARCHAR(500),
    created_at datetime,
    updated_at datetime,
    status int default 0,
    
    PRIMARY KEY(id)
    )";

$resultFeedbackTable = mysqli_query($dbc,$sqlFeedbackTable ) or die("Bad Create: $sqlFeedbackTable");

// create table for order
$sqlOrderTable = "CREATE TABLE IF NOT EXISTS  _Orders(
    id INT AUTO_INCREMENT, 
    user_id INT,
    fullname VARCHAR(50),
    email VARCHAR(150),
    phone_number VARCHAR(20),
    address VARCHAR(200),
    note VARCHAR(255),
    order_date datetime,
    status int default 0,
    total_money int,
    PRIMARY KEY(id)
)";

$resultOrderTable = mysqli_query($dbc,$sqlOrderTable ) or die("Bad Create: $sqlOrderTable");

// create table for order detail
$sqlOrderTable = "CREATE TABLE IF NOT EXISTS  _Order_Details(
    id INT AUTO_INCREMENT, 
    order_id INT,
    product_id INT,
    price INT,
    num INT,
    total_money INT,
    PRIMARY KEY(id)
)";

$resultOrderTable = mysqli_query($dbc,$sqlOrderTable ) or die("Bad Create: $sqlOrderTable");