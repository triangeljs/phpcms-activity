create table if not exists `phpcms_activity` (
    `activity_id` integer not null auto_increment,
    `create_time` timestamp not null default current_timestamp comment '创建时间',
    `start_time` timestamp comment '开始时间',
    `end_time` timestamp comment '结束时间',
    `title` varchar(255) not null comment '活动名称',
    `description` text comment '活动说明',
    `default_style` varchar(255) not null comment '可选风格',
    `show_template` varchar(255) not null comment '活动模板',
    primary key (`activity_id`)
);

create table if not exists `phpcms_activity_award` (
    `award_id` integer not null auto_increment,
    `activity_id` integer not null,

    `name` varchar(255) not null comment '奖项名称',
    `prize` varchar(255) not null comment '奖品名称',
    `total` tinyint(3) not null comment '奖品总数量',
    `surplus` tinyint(3) not null comment '奖品剩余数量',
    `chance` tinyint(3) not null comment '中奖几率',
    primary key (`award_id`)
);

create table if not exists `phpcms_activity_user` (
    `user_id` integer not null auto_increment,
    `activity_id` integer not null,
    `award_id` integer not null,

    `create_time` timestamp not null default current_timestamp comment '中奖时间',
    `name` varchar(255) not null,
    `phone` varchar(255),
    primary key (`user_id`)
);