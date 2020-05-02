# Roles and Abilities based ACL (Access Control List)

Using this starter template you will get ready to use ACL with Laravel's default ```can``` directives.

## Prerequisites

- PHP >= 7.2.5
- MySQL >= 5.7
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- GIT
- Composer

## How to install

- Do the git clone of the project

```bash
git clone https://github.com/bhushangaykawad/Roles-and-Abilities-based-ACL.git
```

- Navigate inside project directory

```bash
cd Roles-and-Abilities-based-ACL
```

- Install composer dependencies

```bash
composer install
```

- Create environment file by copying ```.env.example``` file to ```.env```

- Generate App Key for the project

```bash
php artisan key:generate
```

- Change following configurations from ```.env``` file
  - ```DB_DATABASE=```
  - ```DB_USERNAME=```
  - ```DB_PASSWORD=```

- Now create the database with the same name used in ```DB_DATABASE```

- Migrate database using below command

```bash
php artisan migrate
```

Installation part completes here.

## How to use

### Build the world

Lets suppose we have Posts CRUD and we need to have roles as admin, manager and writer.

Abilities

- create_post
- read_post
- update_post
- delete_post

Roles

- Admin - has all the permissions
- Manager - has create, read and update permissions
- Writer - has create and read permissions

#### Assign new role to a user

Both implementations will work

```php
$admin = Role::whereName('Admin')->firstOrFail();

$user->assignRole($admin);
$user->assignRole('Admin');
```

#### Grant given ability to a role

Both implementations will work

```php
$updatePost = Ability::whereName('update_post')->firstOrFail();

$admin->allowTo($updatePost);
$admin->allowTo('update_post');
```

Now, we have all the relations setup ready.

### Showing allowed things in views

You can use can directive in blade files like below example

Ex.

```blade
@can('update_post')
<a href="/post/post-slug/edit">Update Post</a>
@endcan
```

Link will only appear if the user has permission to update post.

### Blocking user from accessing routes

You can use middleware to block user from visiting unauthorised pages.

Ex.

```php
Route::patch('post/{slug}', 'PostsController@update')->middleware('can:update_post');
```

Thank you.
