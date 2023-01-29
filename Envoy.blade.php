@servers(['web' => 'localhost'])

@task('telescope')
php artisan telescope:prune
@endtask

