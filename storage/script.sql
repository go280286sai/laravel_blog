create table laravel_blog.categories
(
    id         bigint unsigned auto_increment
        primary key,
    title      varchar(100) not null,
    slug       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table laravel_blog.comments
(
    id         bigint unsigned auto_increment
        primary key,
    text       text          not null,
    user_id    int           not null,
    post_id    int           not null,
    created_at timestamp     null,
    updated_at timestamp     null,
    deleted_at timestamp     null,
    status     int default 0 not null
)
    collate = utf8mb4_unicode_ci;

create table laravel_blog.failed_jobs
(
    id         bigint unsigned auto_increment
        primary key,
    uuid       varchar(255)                        not null,
    connection text                                not null,
    queue      text                                not null,
    payload    longtext                            not null,
    exception  longtext                            not null,
    failed_at  timestamp default CURRENT_TIMESTAMP not null,
    constraint failed_jobs_uuid_unique
        unique (uuid)
)
    collate = utf8mb4_unicode_ci;

create table laravel_blog.genders
(
    id   bigint unsigned auto_increment
        primary key,
    name varchar(255) not null
)
    collate = utf8mb4_unicode_ci;

create table laravel_blog.jobs
(
    id           bigint unsigned auto_increment
        primary key,
    queue        varchar(255)     not null,
    payload      longtext         not null,
    attempts     tinyint unsigned not null,
    reserved_at  int unsigned     null,
    available_at int unsigned     not null,
    created_at   int unsigned     not null
)
    collate = utf8mb4_unicode_ci;

create index jobs_queue_index
    on laravel_blog.jobs (queue);

create table laravel_blog.messages
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(100)  not null,
    title      varchar(255)  not null,
    email      varchar(255)  not null,
    content    text          not null,
    created_at timestamp     null,
    updated_at timestamp     null,
    status     int default 0 not null
)
    collate = utf8mb4_unicode_ci;

create table laravel_blog.migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

create table laravel_blog.password_resets
(
    email      varchar(255) not null,
    token      varchar(255) not null,
    created_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create index password_resets_email_index
    on laravel_blog.password_resets (email);

create table laravel_blog.personal_access_tokens
(
    id             bigint unsigned auto_increment
        primary key,
    tokenable_type varchar(255)    not null,
    tokenable_id   bigint unsigned not null,
    name           varchar(255)    not null,
    token          varchar(64)     not null,
    abilities      text            null,
    last_used_at   timestamp       null,
    expires_at     timestamp       null,
    created_at     timestamp       null,
    updated_at     timestamp       null,
    constraint personal_access_tokens_token_unique
        unique (token)
)
    collate = utf8mb4_unicode_ci;

create index personal_access_tokens_tokenable_type_tokenable_id_index
    on laravel_blog.personal_access_tokens (tokenable_type, tokenable_id);

create table laravel_blog.post_tags
(
    id         bigint unsigned auto_increment
        primary key,
    post_id    int       not null,
    tag_id     int       not null,
    created_at timestamp null,
    updated_at timestamp null
)
    collate = utf8mb4_unicode_ci;

create table laravel_blog.posts
(
    id          bigint unsigned auto_increment
        primary key,
    title       varchar(100)  not null,
    slug        varchar(255)  not null,
    image       varchar(20)   null,
    content     text          not null,
    category_id int           null,
    user_id     int           null,
    status      int default 0 not null,
    views       int default 0 not null,
    is_featured int default 0 not null,
    s_date      date          null,
    created_at  timestamp     null,
    updated_at  timestamp     null,
    deleted_at  timestamp     null,
    description text          not null,
    comment     varchar(250)  null
)
    collate = utf8mb4_unicode_ci;

create table laravel_blog.sessions
(
    id            varchar(255)    not null
        primary key,
    user_id       bigint unsigned null,
    ip_address    varchar(45)     null,
    user_agent    text            null,
    payload       longtext        not null,
    last_activity int             not null
)
    collate = utf8mb4_unicode_ci;

create index sessions_last_activity_index
    on laravel_blog.sessions (last_activity);

create index sessions_user_id_index
    on laravel_blog.sessions (user_id);

create table laravel_blog.subscriptions
(
    id         bigint unsigned auto_increment
        primary key,
    email      varchar(255) not null,
    token      varchar(255) null,
    deleted_at timestamp    null,
    created_at timestamp    null,
    updated_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table laravel_blog.tags
(
    id         bigint unsigned auto_increment
        primary key,
    title      varchar(100) not null,
    slug       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

create table laravel_blog.telescope_entries
(
    sequence                bigint unsigned auto_increment
        primary key,
    uuid                    char(36)             not null,
    batch_id                char(36)             not null,
    family_hash             varchar(255)         null,
    should_display_on_index tinyint(1) default 1 not null,
    type                    varchar(20)          not null,
    content                 longtext             not null,
    created_at              datetime             null,
    constraint telescope_entries_uuid_unique
        unique (uuid)
)
    collate = utf8mb4_unicode_ci;

create index telescope_entries_batch_id_index
    on laravel_blog.telescope_entries (batch_id);

create index telescope_entries_created_at_index
    on laravel_blog.telescope_entries (created_at);

create index telescope_entries_family_hash_index
    on laravel_blog.telescope_entries (family_hash);

create index telescope_entries_type_should_display_on_index_index
    on laravel_blog.telescope_entries (type, should_display_on_index);

create table laravel_blog.telescope_entries_tags
(
    entry_uuid char(36)     not null,
    tag        varchar(255) not null,
    constraint telescope_entries_tags_entry_uuid_foreign
        foreign key (entry_uuid) references laravel_blog.telescope_entries (uuid)
            on delete cascade
)
    collate = utf8mb4_unicode_ci;

create index telescope_entries_tags_entry_uuid_tag_index
    on laravel_blog.telescope_entries_tags (entry_uuid, tag);

create index telescope_entries_tags_tag_index
    on laravel_blog.telescope_entries_tags (tag);

create table laravel_blog.telescope_monitoring
(
    tag varchar(255) not null
)
    collate = utf8mb4_unicode_ci;

create table laravel_blog.users
(
    id                bigint unsigned auto_increment
        primary key,
    name              varchar(255)  not null,
    email             varchar(255)  not null,
    email_verified_at timestamp     null,
    password          varchar(255)  not null,
    remember_token    varchar(100)  null,
    created_at        timestamp     null,
    updated_at        timestamp     null,
    avatar            varchar(255)  null,
    gender_id         int           null,
    birthday          date          null,
    phone             int           null,
    comment           text          null,
    myself            text          null,
    fb_id             int           null,
    go_id             int           null,
    github_id         int           null,
    deleted_at        timestamp     null,
    is_admin          int default 0 not null,
    constraint users_email_unique
        unique (email)
)
    collate = utf8mb4_unicode_ci;


