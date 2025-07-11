CREATE TABLE users(
	user_id INT AUTO_INCREMENT PRIMARY KEY, -- AUTO_INCREMENT to always define a id to each user.
	username VARCHAR(30) NOT NULL,
	email VARCHAR(30) NOT NULL UNIQUE, -- Unique to handle repeated emails.
	hashpswd VARCHAR(255) NOT NULL, -- Hash for storage the password hash version.
	type ENUM('user','admin') DEFAULT 'user', -- Defining the type of user. Admin users is not a other table because it's just a user with more privileges, and in login code errors may occur.
	created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Storing the acc creation date.
	user_img VARCHAR(255)
);

CREATE TABLE games(
	game_id INT AUTO_INCREMENT PRIMARY KEY, 
	title VARCHAR(50) NOT NULL,
	game_desc TEXT, -- Text data type for long descriptions.
	publi_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	cover VARCHAR(255),
	genre VARCHAR(100),
	game_file VARCHAR(255),
	posted_by INT NOT NULL,
	FOREIGN KEY(posted_by) REFERENCES users(user_id) ON DELETE CASCADE -- Setting wich user id posted the game.
);