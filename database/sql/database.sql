-- convert Laravel migrations to raw SQL scripts --

-- migration:2014_10_12_000000_create_users_table --
create table `users` (
  `id` bigint unsigned not null auto_increment primary key, 
  `name` varchar(255) not null, 
  `email` varchar(255) not null, 
  `email_verified_at` timestamp null, 
  `password` varchar(255) not null, 
  `remember_token` varchar(100) null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `users` 
add 
  unique `users_email_unique`(`email`);

-- migration:2014_10_12_100000_create_password_resets_table --
create table `password_resets` (
  `email` varchar(255) not null, 
  `token` varchar(255) not null, 
  `created_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `password_resets` 
add 
  index `password_resets_email_index`(`email`);

-- migration:2019_08_19_000000_create_failed_jobs_table --
create table `failed_jobs` (
  `id` bigint unsigned not null auto_increment primary key, 
  `uuid` varchar(255) not null, 
  `connection` text not null, 
  `queue` text not null, 
  `payload` longtext not null, 
  `exception` longtext not null, 
  `failed_at` timestamp default CURRENT_TIMESTAMP not null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `failed_jobs` 
add 
  unique `failed_jobs_uuid_unique`(`uuid`);

-- migration:2019_12_14_000001_create_personal_access_tokens_table --
create table `personal_access_tokens` (
  `id` bigint unsigned not null auto_increment primary key, 
  `tokenable_type` varchar(255) not null, 
  `tokenable_id` bigint unsigned not null, 
  `name` varchar(255) not null, 
  `token` varchar(64) not null, 
  `abilities` text null, 
  `last_used_at` timestamp null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `personal_access_tokens` 
add 
  index `personal_access_tokens_tokenable_type_tokenable_id_index`(
    `tokenable_type`, `tokenable_id`
  );
alter table 
  `personal_access_tokens` 
add 
  unique `personal_access_tokens_token_unique`(`token`);

-- migration:2021_09_06_202031_create_projects_table --
create table `projects` (
  `id` bigint unsigned not null auto_increment primary key, 
  `name` varchar(255) null, 
  `start` timestamp null, 
  `end` timestamp null, 
  `sponsor` varchar(255) null, 
  `value` varchar(255) null, 
  `progress` varchar(255) null, 
  `description` varchar(255) null, 
  `status` varchar(255) null, 
  `user_id` bigint unsigned not null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `projects` 
add 
  constraint `projects_user_id_foreign` foreign key (`user_id`) references `users` (`id`);

-- migration:2021_10_23_154345_create_permission_tables --
create table `permissions` (
  `id` bigint unsigned not null auto_increment primary key, 
  `name` varchar(255) not null, 
  `guard_name` varchar(255) not null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `permissions` 
add 
  unique `permissions_name_guard_name_unique`(`name`, `guard_name`);
create table `roles` (
  `id` bigint unsigned not null auto_increment primary key, 
  `name` varchar(255) not null, 
  `guard_name` varchar(255) not null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `roles` 
add 
  unique `roles_name_guard_name_unique`(`name`, `guard_name`);
create table `model_has_permissions` (
  `permission_id` bigint unsigned not null, 
  `model_type` varchar(255) not null, 
  `model_id` bigint unsigned not null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `model_has_permissions` 
add 
  index `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`);
alter table 
  `model_has_permissions` 
add 
  constraint `model_has_permissions_permission_id_foreign` foreign key (`permission_id`) references `permissions` (`id`) on delete cascade;
alter table 
  `model_has_permissions` 
add 
  primary key `model_has_permissions_permission_model_type_primary`(
    `permission_id`, `model_id`, `model_type`
  );
create table `model_has_roles` (
  `role_id` bigint unsigned not null, 
  `model_type` varchar(255) not null, 
  `model_id` bigint unsigned not null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `model_has_roles` 
add 
  index `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`);
alter table 
  `model_has_roles` 
add 
  constraint `model_has_roles_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete cascade;
alter table 
  `model_has_roles` 
add 
  primary key `model_has_roles_role_model_type_primary`(
    `role_id`, `model_id`, `model_type`
  );
create table `role_has_permissions` (
  `permission_id` bigint unsigned not null, 
  `role_id` bigint unsigned not null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `role_has_permissions` 
add 
  constraint `role_has_permissions_permission_id_foreign` foreign key (`permission_id`) references `permissions` (`id`) on delete cascade;
alter table 
  `role_has_permissions` 
add 
  constraint `role_has_permissions_role_id_foreign` foreign key (`role_id`) references `roles` (`id`) on delete cascade;
alter table 
  `role_has_permissions` 
add 
  primary key `role_has_permissions_permission_id_role_id_primary`(`permission_id`, `role_id`);

-- migration:2021_10_23_161958_create_money_table --
create table `money` (
  `id` bigint unsigned not null auto_increment primary key, 
  `user_id` bigint unsigned not null, 
  `in` double null, `out` double null, 
  `of` timestamp not null default '2022-01-21 10:32:43', 
  `description` text null, `project_id` bigint unsigned not null, 
  `created_at` timestamp null, `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `money` 
add 
  constraint `money_user_id_foreign` foreign key (`user_id`) references `users` (`id`);
alter table 
  `money` 
add 
  constraint `money_project_id_foreign` foreign key (`project_id`) references `projects` (`id`);

-- migration:2021_11_07_201738_create_sub_contracts_table --
create table `sub_contracts` (
  `id` bigint unsigned not null auto_increment primary key, 
  `of` timestamp not null default '2022-01-21 10:32:43', 
  `project_id` bigint unsigned not null, 
  `construction_group` varchar(255) null, 
  `leader` varchar(255) null, 
  `payment` double not null default '0', 
  `user_id` bigint unsigned not null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `sub_contracts` 
add 
  constraint `sub_contracts_project_id_foreign` foreign key (`project_id`) references `projects` (`id`);
alter table 
  `sub_contracts` 
add 
  constraint `sub_contracts_user_id_foreign` foreign key (`user_id`) references `users` (`id`);

-- migration:2021_11_16_003941_create_labors_table --
create table `labors` (
  `id` bigint unsigned not null auto_increment primary key, 
  `of` timestamp null, 
  `project_id` bigint unsigned not null, 
  `daily_worker` int null, 
  `daily_foreman` int null, 
  `construction_group` varchar(255) null, 
  `group_leader` varchar(255) null, 
  `daily_labor_payment` double null, 
  `user_id` bigint unsigned not null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `labors` 
add 
  constraint `labors_project_id_foreign` foreign key (`project_id`) references `projects` (`id`);
alter table 
  `labors` 
add 
  constraint `labors_user_id_foreign` foreign key (`user_id`) references `users` (`id`);

-- migration:2021_11_16_051210_create_bills_table --
create table `bills` (
  `id` bigint unsigned not null auto_increment primary key, 
  `number` varchar(255) null, 
  `project_id` bigint unsigned not null, 
  `amount` double not null default '0', 
  `user_id` bigint unsigned not null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `bills` 
add 
  constraint `bills_project_id_foreign` foreign key (`project_id`) references `projects` (`id`);
alter table 
  `bills` 
add 
  constraint `bills_user_id_foreign` foreign key (`user_id`) references `users` (`id`);

-- migration:2021_11_16_053014_create_suppliers_table --
create table `suppliers` (
  `id` bigint unsigned not null auto_increment primary key, 
  `contact` varchar(255) null, 
  `company` varchar(255) null, 
  `mobile` varchar(255) null, 
  `email` varchar(255) null, 
  `product` text null, 
  `user_id` bigint unsigned not null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `suppliers` 
add 
  constraint `suppliers_user_id_foreign` foreign key (`user_id`) references `users` (`id`);

-- migration:2021_11_16_060839_create_materials_table --
create table `materials` (
  `id` bigint unsigned not null auto_increment primary key, 
  `of` timestamp null, 
  `project_id` bigint unsigned not null, 
  `material_name` varchar(255) null, 
  `quantity` double not null default '0', 
  `rate` double not null default '0', 
  `supplier_id` bigint unsigned null, 
  `transporation_cost` double not null default '0', 
  `labor_cost` double not null default '0', 
  `user_id` bigint unsigned not null, 
  `unit` varchar(255) null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `materials` 
add 
  constraint `materials_project_id_foreign` foreign key (`project_id`) references `projects` (`id`);
alter table 
  `materials` 
add 
  constraint `materials_supplier_id_foreign` foreign key (`supplier_id`) references `suppliers` (`id`);
alter table 
  `materials` 
add 
  constraint `materials_user_id_foreign` foreign key (`user_id`) references `users` (`id`);

-- migration:2021_11_22_170453_create_project_users_table --
create table `project_users` (
  `id` bigint unsigned not null auto_increment primary key, 
  `project_id` bigint unsigned not null, 
  `user_id` bigint unsigned not null, 
  `created_at` timestamp null, `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `project_users` 
add 
  constraint `project_users_project_id_foreign` foreign key (`project_id`) references `projects` (`id`);
alter table 
  `project_users` 
add 
  constraint `project_users_user_id_foreign` foreign key (`user_id`) references `users` (`id`);

-- migration:2021_11_25_133142_create_construction_groups_table --
create table `construction_groups` (
  `id` bigint unsigned not null auto_increment primary key, 
  `name` varchar(255) not null, 
  `description` text null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';

-- migration:2021_12_19_123056_create_project_tasks_table --
create table `project_tasks` (
  `id` bigint unsigned not null auto_increment primary key, 
  `of` timestamp null, 
  `name` varchar(255) not null, 
  `project_id` bigint unsigned not null, 
  `user_id` bigint unsigned not null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `project_tasks` 
add 
  constraint `project_tasks_project_id_foreign` foreign key (`project_id`) references `projects` (`id`);
alter table 
  `project_tasks` 
add 
  constraint `project_tasks_user_id_foreign` foreign key (`user_id`) references `users` (`id`);

-- migration:2022_01_09_134550_create_contracted_forms_table --
create table `contracted_forms` (
  `id` bigint unsigned not null auto_increment primary key, 
  `description` varchar(255) null, 
  `unit_of_works` varchar(255) null, 
  `quantity_of_work` varchar(255) null, 
  `unit_rate` double null, 
  `completed_quantity` double null, 
  `total_amount` double null, 
  `project_id` bigint unsigned not null, 
  `user_id` bigint unsigned not null, 
  `created_at` timestamp null, 
  `updated_at` timestamp null
) default character set utf8mb4 collate 'utf8mb4_unicode_ci';
alter table 
  `contracted_forms` 
add 
  constraint `contracted_forms_project_id_foreign` foreign key (`project_id`) references `projects` (`id`);
alter table 
  `contracted_forms` 
add 
  constraint `contracted_forms_user_id_foreign` foreign key (`user_id`) references `users` (`id`);

-- migration:2022_01_21_095008_add_bill_payment_balance_to_suppliers_table --
alter table 
  `suppliers` 
add 
  `bill` double null, 
add 
  `payment` double null, 
add 
  `balance` double null, 
add 
  `material_id` bigint unsigned not null;
alter table 
  `suppliers` 
add 
  constraint `suppliers_material_id_foreign` foreign key (`material_id`) references `materials` (`id`);
