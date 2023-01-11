classDiagram
direction BT
class categories {
   varchar(100) title
   varchar(255) slug
   timestamp created_at
   timestamp updated_at
   bigint unsigned id
}
class comments {
   text text
   int user_id
   int post_id
   timestamp created_at
   timestamp updated_at
   timestamp deleted_at
   int status
   bigint unsigned id
}
class failed_jobs {
   varchar(255) uuid
   text connection
   text queue
   longtext payload
   longtext exception
   timestamp failed_at
   bigint unsigned id
}
class genders {
   varchar(255) name
   bigint unsigned id
}
class jobs {
   varchar(255) queue
   longtext payload
   tinyint unsigned attempts
   int unsigned reserved_at
   int unsigned available_at
   int unsigned created_at
   bigint unsigned id
}
class messages {
   varchar(100) name
   varchar(255) title
   varchar(255) email
   text content
   timestamp created_at
   timestamp updated_at
   int status
   bigint unsigned id
}
class migrations {
   varchar(255) migration
   int batch
   int unsigned id
}
class password_resets {
   varchar(255) email
   varchar(255) token
   timestamp created_at
}
class personal_access_tokens {
   varchar(255) tokenable_type
   bigint unsigned tokenable_id
   varchar(255) name
   varchar(64) token
   text abilities
   timestamp last_used_at
   timestamp expires_at
   timestamp created_at
   timestamp updated_at
   bigint unsigned id
}
class post_tags {
   int post_id
   int tag_id
   timestamp created_at
   timestamp updated_at
   bigint unsigned id
}
class posts {
   varchar(100) title
   varchar(255) slug
   varchar(20) image
   text content
   int category_id
   int user_id
   int status
   int views
   int is_featured
   date s_date
   timestamp created_at
   timestamp updated_at
   timestamp deleted_at
   text description
   varchar(250) comment
   bigint unsigned id
}
class sessions {
   bigint unsigned user_id
   varchar(45) ip_address
   text user_agent
   longtext payload
   int last_activity
   varchar(255) id
}
class subscriptions {
   varchar(255) email
   varchar(255) token
   timestamp deleted_at
   timestamp created_at
   timestamp updated_at
   varchar(255) unset
   bigint unsigned id
}
class tags {
   varchar(100) title
   varchar(255) slug
   timestamp created_at
   timestamp updated_at
   bigint unsigned id
}
class telegrams {
   int update_id
   int message_id
   int from_id
   int chat_id
   varchar(255) first_name
   varchar(255) last_name
   varchar(255) username
   datetime send_date
   text text
   varchar(255) status
   timestamp created_at
   timestamp updated_at
   bigint unsigned id
}
class telegraph_bots {
   varchar(255) token
   varchar(255) name
   timestamp created_at
   timestamp updated_at
   bigint unsigned id
}
class telegraph_chats {
   varchar(255) chat_id
   varchar(255) name
   bigint unsigned telegraph_bot_id
   timestamp created_at
   timestamp updated_at
   bigint unsigned id
}
class telescope_entries {
   char(36) uuid
   char(36) batch_id
   varchar(255) family_hash
   tinyint(1) should_display_on_index
   varchar(20) type
   longtext content
   datetime created_at
   bigint unsigned sequence
}
class telescope_entries_tags {
   char(36) entry_uuid
   varchar(255) tag
}
class telescope_monitoring {
   varchar(255) tag
}
class users {
   varchar(255) name
   varchar(255) email
   timestamp email_verified_at
   varchar(255) password
   varchar(100) remember_token
   timestamp created_at
   timestamp updated_at
   varchar(255) avatar
   int gender_id
   date birthday
   int phone
   text comment
   text myself
   int fb_id
   int go_id
   int github_id
   timestamp deleted_at
   int is_admin
   int status
   bigint unsigned id
}

comments  -->  posts : post_id:id
comments  -->  users : user_id:id
post_tags  -->  posts : post_id:id
post_tags  -->  tags : tag_id:id
posts  -->  categories : category_id:id
posts  -->  users : user_id:id
sessions  -->  users : user_id:id
telegrams  -->  messages : message_id:id
telegraph_chats  -->  telegraph_bots : telegraph_bot_id:id
telescope_entries_tags  -->  telescope_entries : entry_uuid:uuid
users  -->  genders : gender_id:id
