create table users (
	`id` int(11) unsigned AUTO_INCREMENT NOT null PRIMARY KEY ,
    `name` varchar(100) not null,
    `email` varchar(100) UNIQUE not null,
    `password` varchar(100) not null,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP
);

create table tasks(
	`id` int(11) unsigned AUTO_INCREMENT not null PRIMARY KEY,
    `title` varchar(200) not null,
    `description` text not null,
    `status` ENUM ('pending','done') not null DEFAULT 'pending',
    `user_id` int(11) unsigned NOT null,
    `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp null DEFAULT null,
    CONSTRAINT fk_task_user FOREIGN KEY (user_id)
    REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);